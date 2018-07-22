<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ModelStorages Controller
 *
 * @property \App\Model\Table\ModelStoragesTable $ModelStorages
 *
 * @method \App\Model\Entity\ModelStorage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModelStoragesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Storages', 'Models']
        ];
        $modelStorages = $this->paginate($this->ModelStorages);

        $this->set(compact('modelStorages'));
    }

    /**
     * View method
     *
     * @param string|null $id Model Storage id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $modelStorage = $this->ModelStorages->get($id, [
            'contain' => ['Storages', 'Models']
        ]);

        $this->set('modelStorage', $modelStorage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $modelStorage = $this->ModelStorages->newEntity();
        if ($this->request->is('post')) {
            $modelStorage = $this->ModelStorages->patchEntity($modelStorage, $this->request->getData());
            if ($this->ModelStorages->save($modelStorage)) {
                $this->Flash->success(__('The model storage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The model storage could not be saved. Please, try again.'));
        }
        $storages = $this->ModelStorages->Storages->find('list', ['limit' => 200]);
        $models = $this->ModelStorages->Models->find('list', ['limit' => 200]);
        $this->set(compact('modelStorage', 'storages', 'models'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Model Storage id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $modelStorage = $this->ModelStorages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $modelStorage = $this->ModelStorages->patchEntity($modelStorage, $this->request->getData());
            if ($this->ModelStorages->save($modelStorage)) {
                $this->Flash->success(__('The model storage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The model storage could not be saved. Please, try again.'));
        }
        $storages = $this->ModelStorages->Storages->find('list', ['limit' => 200]);
        $models = $this->ModelStorages->Models->find('list', ['limit' => 200]);
        $this->set(compact('modelStorage', 'storages', 'models'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Model Storage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $modelStorage = $this->ModelStorages->get($id);
        if ($this->ModelStorages->delete($modelStorage)) {
            $this->Flash->success(__('The model storage has been deleted.'));
        } else {
            $this->Flash->error(__('The model storage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
