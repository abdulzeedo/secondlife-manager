<?php
/**
 * Created by PhpStorm.
 * User: tesina
 * Date: 26/06/2018
 * Time: 18:44
 */

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\PhonesTable;
use DateTime;

/**
 * Phones Controller
 *
 * @property \App\Model\Table\ColoursTable $Colours
 * @property \App\Model\Table\ConnectedPhonesTable $ConnectedPhones
 * @property \App\Model\Table\ModelsTable $Models
 * @property \App\Model\Table\StoragesTable $Storages
 * @property \App\Model\Table\PhonesTable $Phones
 * * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\Phone[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class PhonesApiController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');

        $this->Auth->setConfig('authenticate', [
            'Basic' => [
                'fields' => [
                    'username' => 'email',
                    'password' => 'api_key'
                ],
            ],
        ]);

        $this->Auth->allow(['stream']);
        $this->Auth->setConfig('storage', 'Memory');
        $this->Auth->setConfig('unauthorizedRedirect', 'false');
    }

    public function isAuthorized($user)
    {
        // By default grant access.
        return true;
    }

    public function setStatus() {
        $message = null;
        $this->autoRender = false;
        if (!$this->request->getSession()->started())
            $this->request->getSession()->start();


        $this->request->getSession()->write("message", $this->request->getData());

        $this->response = $this->response->withStringBody(json_encode(array(
            'message' => 'session created'
        )));

    }

    public function stream($id = null) {

        $this->viewBuilder()->setLayout(false);

        $this->loadModel('ConnectedPhones');
        $this->loadModel('Phones');

        $connected = $this->ConnectedPhones->find('all')
            ->where(['ConnectedPhones.status' => 'connected'])
            ->contain(['Phones', "Users"]);
        // Get as few disconnected records as possible to limit the load
        $disconnected = $this->ConnectedPhones->find('all', [
            'conditions' => [
                'ConnectedPhones.modified >' => new DateTime('-1 days'),
                'ConnectedPhones.status' => 'disconnected'
            ],
            'contain' => ['Phones', "Users"]
        ]);

        if ($id != null) {
            $connected->where(['ConnectedPhones.user_id' => $id]);
            $disconnected->where(['ConnectedPhones.user_id' => $id]);
        }


        $result = [
            'connected' => $connected,
            'disconnected' => $disconnected
        ];


        $resp = $this->response;
        $resp = $resp->withHeader('Content-Type', 'text/event-stream');
        $resp = $resp->withHeader('Cach-Control', 'no-cache');
        $resp = $resp->withStringBody("event: status\n"
                ."data: ".json_encode($result)."\n\n");

//        $resp = $resp->withStringBody("event: status\ndata: [{\"imiei\":\"12312122sas122\",\"status\":\"Ok\",\"description\":\"iPhone 6 Rose gold\",\"udid\":\"1231231\"}]\n\n");



        $this->response = $resp;
        return $resp;
    }

    public function setConnectedPhoneStatus()
    {

        $this->viewBuilder()->setLayout(false);
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);

        }

        $this->viewBuilder()->setLayout(false);
        $this->loadModel('ConnectedPhones');
        $result = [];

        $connPhones = $this->ConnectedPhones->newEntities($this->request->getData());

        // Check whether at this point the udid has already been added or not: TODO
        foreach ($connPhones as $connPhone) {
            $connPhone->status = 'connected';
            $connPhone->user_id = $this->Auth->user('id');


            // Make all currently connected udid's disconnected
            $connCurrPhones = $this->ConnectedPhones->findByUdidAndStatus(
                $connPhone->udid,
                'connected'
            )->all();
            foreach($connCurrPhones as $connCurrPhone) {
                $connCurrPhone->status = 'disconnected';

                if (!$this->ConnectedPhones->save($connCurrPhone)) {
                    $result['error'] = 'Could not change status of udid '.$connCurrPhone->udid;
                }
            }

            if ($this->ConnectedPhones->save($connPhone)) {
                $result = array (
                    "message" => 'saved'
                );
                $this->set(compact('result'));

                $this->set('_serialize', ['result']);
            } else {
                $result = array(
                    'message' =>  'error',
                    'phone' => $connPhones->getErrors()
                );
                $this->set('result', $result);
                $this->set('_jsonOptions', JSON_FORCE_OBJECT);
                $this->response = $this->response->withStatus(400);
            }

        }

        $this->set('_serialize', ['result']);
        $this->viewBuilder()->setTemplate('add');
    }

    public function removeConnectedPhoneStatus()
    {

        $this->viewBuilder()->setLayout(false);
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);

        }

        $this->viewBuilder()->setLayout(false);
        $this->loadModel('ConnectedPhones');

        $connPhones = $this->ConnectedPhones->newEntities($this->request->getData());


        foreach ($connPhones as $connPhone) {
            $connPhone = $this->ConnectedPhones->findByUdidAndStatus(
                $connPhone->udid,
                'connected'
            )->first();
            $connPhone->status = 'disconnected';

            if ($this->ConnectedPhones->save($connPhone)) {
                $result = array (
                    "message" => 'saved'
                );
                $this->set(compact('result'));

                $this->set('_serialize', ['result']);
            } else {
                $result = array(
                    'message' =>  'error',
                    'phone' => $connPhones->getErrors()
                );
                $this->set('result', $result);
                $this->set('_jsonOptions', JSON_FORCE_OBJECT);

                $this->response = $this->response->withStatus(400);
            }

        }

        $this->set('_serialize', ['result']);
        $this->viewBuilder()->setTemplate('add');
    }

    public function disconnectAllConnectedPhones()
    {

        $this->viewBuilder()->setLayout(false);
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);

        }

        $this->viewBuilder()->setLayout(false);
        $this->loadModel('ConnectedPhones');

        $connPhones = $this->ConnectedPhones->findByStatus('connected')->all();

        // Check whether at this point the udid has already been added or not: TODO
        foreach ($connPhones as $connPhone) {

            $connPhone->status = 'disconnected';

            if ($this->ConnectedPhones->save($connPhone)) {
                $result = array (
                    "message" => 'saved'
                );
                $this->set(compact('result'));

                $this->set('_serialize', ['result']);
            } else {
                $result = array(
                    'message' =>  'error',
                    'phone' => $connPhones->getErrors()
                );
                $this->set('result', $result);
                $this->set('_jsonOptions', JSON_FORCE_OBJECT);

                $this->response = $this->response->withStatus(400);
            }

        }

        $this->set('_serialize', ['result']);
        $this->viewBuilder()->setTemplate('add');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function add()
    {


        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);

        }
        else
            echo $user;
        $this->viewBuilder()->setLayout(false);
        $this->loadModel('Phones');
        $this->loadModel('Models');
        $this->loadModel('Storages');
        $this->loadModel('Colours');
        $this->loadModel('ConnectedPhones');

        $storage = $this->Storages->findByStorage($this->request->getData("storage"))->first();
        $model = $this->Models->findByModelCode($this->request->getData("model"))->first();
        $colour = $this->Colours->findByColourName($this->request->getData("colour"))->first();

        $phone = null;

        // If it already exists update its information, otherwise create new and save either one
        // true: if exists
        // false: if doesn't exist
        if ($this->Phones->exists(["imiei" => $this->request->getData("imiei")])) {
            $phone = $this->Phones->findByImiei($this->request->getData("imiei"))->first();

            // Update only the fields that have been modified and then save

            $this->Phones->patchEntity($phone, $this->request->getData());

            // Update these fields manually
            $phone->storage = $storage;
            $phone->model = $model;
            $phone->colour = $colour;
        }
        else {

            // Create new entity
            $phone = $this->Phones->newEntity($this->request->getData());

            $phone->user_id = $this->Auth->user('id');

            $phone->storage = $storage;
            $phone->model = $model;
            $phone->colour = $colour;
        }


        // Try to save the phone (updated or new field)
        if ($this->Phones->save($phone)) {
            $result = array (
                "id" => $phone->id,
                "message" => 'saved'
            );
            if ($this->request->getData("udid") != null) {
                $phoneCurrConnected = $this->ConnectedPhones
                    ->findByUdidAndStatus($this->request->getData("udid"), 'connected')->first();
                $phoneCurrConnected->phone = $phone;
                if(!$this->ConnectedPhones->save($phoneCurrConnected))
                    $result["message"] = 'Imiei saved but could link the udid';
            }

            $this->set(compact('result'));

            $this->set('_serialize', ['result']);
        } else {
            $result = array(
                'message' =>  'error',
                'phone' => $phone->getErrors()
            );
            $this->set('result', $result);
            $this->set('_jsonOptions', JSON_FORCE_OBJECT);

            $this->response = $this->response->withStatus(400);
        }

        $this->set('_serialize', ['result']);


    }

}