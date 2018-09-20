<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemReturnsTypes Controller
 *
 * @property \App\Model\Table\ItemReturnsTypesTable $ItemReturnsTypes
 *
 * @method \App\Model\Entity\ItemReturnsType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemReturnsTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ItemReturns', 'ItemReturnsTypeStatus']
        ];
        $itemReturnsTypes = $this->paginate($this->ItemReturnsTypes);

        $this->set(compact('itemReturnsTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Item Returns Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemReturnsType = $this->ItemReturnsTypes->get($id, [
            'contain' => ['ItemReturns', 'ItemReturnsTypeStatus']
        ]);

        $this->set('itemReturnsType', $itemReturnsType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemReturnsType = $this->ItemReturnsTypes->newEntity();
        if ($this->request->is('post')) {
            $itemReturnsType = $this->ItemReturnsTypes->patchEntity($itemReturnsType, $this->request->getData());
            if ($this->ItemReturnsTypes->save($itemReturnsType)) {
                $this->Flash->success(__('The item returns type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item returns type could not be saved. Please, try again.'));
        }
        $itemReturns = $this->ItemReturnsTypes->ItemReturns->find('list', ['limit' => 200]);
        $itemReturnsTypeStatus = $this->ItemReturnsTypes->ItemReturnsTypeStatus->find('list', ['limit' => 200]);
        $this->set(compact('itemReturnsType', 'itemReturns', 'itemReturnsTypeStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Returns Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemReturnsType = $this->ItemReturnsTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemReturnsType = $this->ItemReturnsTypes->patchEntity($itemReturnsType, $this->request->getData());
            if ($this->ItemReturnsTypes->save($itemReturnsType)) {
                $this->Flash->success(__('The item returns type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item returns type could not be saved. Please, try again.'));
        }
        $itemReturns = $this->ItemReturnsTypes->ItemReturns->find('list', ['limit' => 200]);
        $itemReturnsTypeStatus = $this->ItemReturnsTypes->ItemReturnsTypeStatus->find('list', ['limit' => 200]);
        $this->set(compact('itemReturnsType', 'itemReturns', 'itemReturnsTypeStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Returns Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemReturnsType = $this->ItemReturnsTypes->get($id);
        if ($this->ItemReturnsTypes->delete($itemReturnsType)) {
            $this->Flash->success(__('The item returns type has been deleted.'));
        } else {
            $this->Flash->error(__('The item returns type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
