<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemReturnsTypeStatus Controller
 *
 * @property \App\Model\Table\ItemReturnsTypeStatusTable $ItemReturnsTypeStatus
 *
 * @method \App\Model\Entity\ItemReturnsTypeStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemReturnsTypeStatusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ItemReturns']
        ];
        $itemReturnsTypeStatus = $this->paginate($this->ItemReturnsTypeStatus);

        $this->set(compact('itemReturnsTypeStatus'));
    }

    /**
     * View method
     *
     * @param string|null $id Item Returns Type Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemReturnsTypeStatus = $this->ItemReturnsTypeStatus->get($id, [
            'contain' => ['ItemReturns', 'ItemReturnsTypes']
        ]);

        $this->set('itemReturnsTypeStatus', $itemReturnsTypeStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemReturnsTypeStatus = $this->ItemReturnsTypeStatus->newEntity();
        if ($this->request->is('post')) {
            $itemReturnsTypeStatus = $this->ItemReturnsTypeStatus->patchEntity($itemReturnsTypeStatus, $this->request->getData());
            if ($this->ItemReturnsTypeStatus->save($itemReturnsTypeStatus)) {
                $this->Flash->success(__('The item returns type status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item returns type status could not be saved. Please, try again.'));
        }
        $itemReturns = $this->ItemReturnsTypeStatus->ItemReturnsTypes->find('list', ['limit' => 200]);
        $this->set(compact('itemReturnsTypeStatus', 'itemReturns'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Returns Type Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemReturnsTypeStatus = $this->ItemReturnsTypeStatus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemReturnsTypeStatus = $this->ItemReturnsTypeStatus->patchEntity($itemReturnsTypeStatus, $this->request->getData());
            if ($this->ItemReturnsTypeStatus->save($itemReturnsTypeStatus)) {
                $this->Flash->success(__('The item returns type status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item returns type status could not be saved. Please, try again.'));
        }
        $itemReturns = $this->ItemReturnsTypeStatus->ItemReturns->find('list', ['limit' => 200]);
        $this->set(compact('itemReturnsTypeStatus', 'itemReturns'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Returns Type Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemReturnsTypeStatus = $this->ItemReturnsTypeStatus->get($id);
        if ($this->ItemReturnsTypeStatus->delete($itemReturnsTypeStatus)) {
            $this->Flash->success(__('The item returns type status has been deleted.'));
        } else {
            $this->Flash->error(__('The item returns type status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
