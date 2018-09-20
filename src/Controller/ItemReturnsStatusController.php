<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemReturnsStatus Controller
 *
 * @property \App\Model\Table\ItemReturnsStatusTable $ItemReturnsStatus
 *
 * @method \App\Model\Entity\ItemReturnsStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemReturnsStatusController extends AppController
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
        $itemReturnsStatus = $this->paginate($this->ItemReturnsStatus);

        $this->set(compact('itemReturnsStatus'));
    }

    /**
     * View method
     *
     * @param string|null $id Item Returns Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemReturnsStatus = $this->ItemReturnsStatus->get($id, [
            'contain' => ['ItemReturns']
        ]);

        $this->set('itemReturnsStatus', $itemReturnsStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemReturnsStatus = $this->ItemReturnsStatus->newEntity();
        if ($this->request->is('post')) {
            $itemReturnsStatus = $this->ItemReturnsStatus->patchEntity($itemReturnsStatus, $this->request->getData());
            if ($this->ItemReturnsStatus->save($itemReturnsStatus)) {
                $this->Flash->success(__('The item returns status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item returns status could not be saved. Please, try again.'));
        }
        $itemReturns = $this->ItemReturnsStatus->ItemReturns->find('list', ['limit' => 200]);
        $this->set(compact('itemReturnsStatus', 'itemReturns'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Returns Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemReturnsStatus = $this->ItemReturnsStatus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemReturnsStatus = $this->ItemReturnsStatus->patchEntity($itemReturnsStatus, $this->request->getData());
            if ($this->ItemReturnsStatus->save($itemReturnsStatus)) {
                $this->Flash->success(__('The item returns status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item returns status could not be saved. Please, try again.'));
        }
        $itemReturns = $this->ItemReturnsStatus->ItemReturns->find('list', ['limit' => 200]);
        $this->set(compact('itemReturnsStatus', 'itemReturns'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Returns Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemReturnsStatus = $this->ItemReturnsStatus->get($id);
        if ($this->ItemReturnsStatus->delete($itemReturnsStatus)) {
            $this->Flash->success(__('The item returns status has been deleted.'));
        } else {
            $this->Flash->error(__('The item returns status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
