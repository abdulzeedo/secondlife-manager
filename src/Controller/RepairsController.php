<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Phone;
use Cake\Utility\Hash;

/**
 * Repairs Controller
 *
 * @property \App\Model\Table\RepairsTable $Repairs
 *
 * @method \App\Model\Entity\Repair[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RepairsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Phones']
        ];
        $repairs = $this->paginate($this->Repairs);

        $this->set(compact('repairs'));
    }

    /**
     * View method
     *
     * @param string|null $id Repair id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $repair = $this->Repairs->get($id, [
            'contain' => ['Phones']
        ]);

        $this->set('repair', $repair);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout("bootstrap");
        $repair = $this->Repairs->newEntity();
        if ($this->request->is('post')) {
            $repair = $this->Repairs->patchEntity($repair, $this->request->getData());
            if ($this->Repairs->save($repair)) {
                $this->Flash->success(__('The repair has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The repair could not be saved. Please, try again.'));
        }



        $phones = $this->Repairs->Phones->find('all')->toArray();

        $phonesList = [];
        foreach($phones as $phone) {
            $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        }

        $this->set(compact('repair', 'phonesList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Repair id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout("bootstrap");
        $repair = $this->Repairs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $repair = $this->Repairs->patchEntity($repair, $this->request->getData());
            if ($this->Repairs->save($repair)) {
                $this->Flash->success(__('The repair has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The repair could not be saved. Please, try again.'));
        }

        $phones = $this->Repairs->Phones->find('all')->toArray();

        $phonesList = [];
        foreach($phones as $phone) {
            $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        }

        $this->set(compact('repair', 'phonesList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Repair id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $repair = $this->Repairs->get($id);
        if ($this->Repairs->delete($repair)) {
            if (!$this->request->is('ajax'))
                $this->Flash->success(__('The repair has been deleted.'));
        } else {
            if (!$this->request->is('ajax'))
                $this->Flash->error(__('The repair could not be deleted. Please, try again.'));
        }

        if (!$this->request->is('ajax'))
            return $this->redirect(['action' => 'index']);
        else
            return $this->response = $this->response->withStringBody('s');
    }
}
