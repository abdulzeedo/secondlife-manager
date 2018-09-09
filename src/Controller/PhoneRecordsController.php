<?php

namespace App\Controller;
use App\Controller\Component\ModalComponent;
use App\Controller\Phones\PhoneAjaxTrait;
use App\Model\Entity\PhoneRecord;
use App\Model\Table\PhoneRecordsTable;
use App\Model\Table\PhonesTable;
use Cake\ORM\TableRegistry;


/**
 * Set phones as still available
 *
 * @property PhonesTable $Phones
 * @property PhoneRecordsTable $PhoneRecords
 * @property ModalComponent $Modal
 * @package App\Controller
 */
class PhoneRecordsController extends AppController
{
    use PhoneAjaxTrait;

    /**
     * @var PhonesTable $Phones
     * @var PhoneRecordsTable $PhoneRecords
     */
    protected $Phones;
    protected $PhoneRecords;
    /**
     * Assign table registries to class instance properties
     */
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('bootstrap');
        $this->loadComponent('Modal');
        $this->Phones = TableRegistry::get('Phones');
        $this->PhoneRecords = TableRegistry::get('PhoneRecords');
        $this->Auth->allow(['addPhone']);
    }

    public function index() {

    }
    public function addReturnModal ($id = null) {
        $return = $this->Phones->ItemReturns->newEntity();

        if ($id)
            $return->item_id = $id;

        $this->Modal->editOrAdd($this->Phones->ItemReturns, $id, $return);

        $phone = $this->Phones->find('all')
            ->where(['Phones.id' => $return->item_id])
            ->first();

        $phonesFormatted[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        $values = $this->Phones->itemReturns->getDefaultValues();
        $this->viewBuilder()->setClassName('Json');
        $this->set(compact('return', 'phonesFormatted', 'values'));
        $this->set('returnErrors', $return->getErrors());
        $this->set('_serialize', ['returnErrors', 'return', 'phonesFormatted', 'values']);
    }

    public function viewAll() {
        if ($this->request->is(['get', 'ajax'])) {
            $this->viewBuilder()->setClassName('Json');

            $query = $this->PhoneRecords->find('all')
                ->where(['is_used' => '0'])
                ->contain(['Phones', 'Phones.Repairs', 'Phones.SupplierOrders.Suppliers',
                    'Phones.ItemReturns', 'Phones.Transactions.Customers']);

            $phoneRecords = $query->toArray();

            $this->set(compact('phoneRecords'));
            $this->set('_serialize', [
                'phoneRecords',
            ]);
        }
    }
    public function addPhone() {
        if ($this->request->is(['post', 'ajax', 'get'])) {
            $this->viewBuilder()->setClassName('Json');
            $phone = $this->Phones->newEntity();
            $phone = $this->Phones->patchEntity($phone, $this->request->getData());


            $response = [];
            $status = 200;
            if ($this->Phones->save($phone)){
                $response['success']['message'] = "Phone added successfully.";
                $response['success']['code'] = "200";
                $response['success']['phone'] = $phone;
                $status = $response['success']['code'];
            }
            else {
                $response['error']['message'] = "There is one or more validation errors.";
                $response['error']['code'] = "400";
                $response['error']['phone'] = $phone->getErrors();
                $status = $response['error']['code'];
            }
            $this->response = $this->response->withStatus($status);
            $this->set(compact('response'));
            $this->set('_serialize', ['response']);
        }
    }
    /**
     * Add Phone record
     */
    public function add() {
        if ($this->request->is(['post', 'ajax'])) {
            $this->viewBuilder()->setClassName('Json');
            $phoneRecord = $this->PhoneRecords->newEntity();
            $phoneRecord = $this->PhoneRecords->patchEntity($phoneRecord, $this->request->getData());

            $phoneRecord->is_used = 0;

            $exists = $this->PhoneRecords->exists([
                'item_id' => $phoneRecord->item_id,
                'is_used' => 0
            ]);
            $response = [];
            $status = 200;
            if (!$exists)
                if ($this->PhoneRecords->save($phoneRecord)){
                    $response['success']['message'] = "Phone added successfully.";
                    $response['success']['code'] = "200";
                    $response['success']['phoneRecord'] = $phoneRecord;
                    $status = $response['success']['code'];
                }
                else {
                    $response['error']['message'] = "There is one or more validation errors.";
                    $response['error']['code'] = "400";
                    $response['error']['phoneRecord'] = $phoneRecord->getErrors();
                    $status = $response['error']['code'];
                }
            else {
                $response['error']['message'] = "Phone record already exists.";
                $response['error']['code'] = "409";
                $status = $response['error']['code'];
            }
            $this->response = $this->response->withStatus($status);
            $this->set(compact('response'));
            $this->set('_serialize', ['response']);
        }
    }

    public function delete() {
        if ($this->request->is(['get','post', 'ajax'])) {
            $this->viewBuilder()->setClassName('Json');


            $id = $this->request->getData('id');
            $item_id = $this->request->getData('item_id');
            $phoneRecord = null;

            if ($id)
                $phoneRecord = $this->PhoneRecords->get($id);
            else {
                $phoneRecord = $this->PhoneRecords->find('all')
                    ->where(['item_id' => $item_id])
                    ->andWhere(['is_used' => 0])
                    ->first();
            }

            $status = "200";
            $response = [];
            if ($phoneRecord instanceof PhoneRecord) {
                if ($phoneRecord->is_used == '0') {
                    if ($this->PhoneRecords->delete($phoneRecord)) {
                        $response['success']['message'] = "Phone deleted successfully.";
                        $response['success']['code'] = "200";
                        $status = $response['success']['code'];
                    }
                    else {
                        $response['error']['message'] = "Could not delete phone record.";
                        $response['error']['code'] = "400";
                        $status = $response['error']['code'];
                    }
                }
                else {
                    $response['error']['message'] = "Phone record has already been used in another batch";
                    $response['error']['code'] = "400";
                    $status = $response['error']['code'];
                }
            }
            else {
                $response['error']['message'] = "Phone record does not exist";
                $response['error']['code'] = "400";
                $status = $response['error']['code'];
            }
            $this->response = $this->response->withStatus($status);
            $this->set(compact('response'));
            $this->set('_serialize', ['response']);
        }
    }
}
