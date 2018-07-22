<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ModelColours Controller
 *
 * @property \App\Model\Table\ModelColoursTable $ModelColours
 *
 * @method \App\Model\Entity\ModelColour[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModelColoursController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Colours', 'Models']
        ];
        $modelColours = $this->paginate($this->ModelColours);

        $this->set(compact('modelColours'));
    }

    /**
     * View method
     *
     * @param string|null $id Model Colour id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $modelColour = $this->ModelColours->get($id, [
            'contain' => ['Colours', 'Models']
        ]);

        $this->set('modelColour', $modelColour);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $modelColour = $this->ModelColours->newEntity();
        if ($this->request->is('post')) {
            $modelColour = $this->ModelColours->patchEntity($modelColour, $this->request->getData());
            if ($this->ModelColours->save($modelColour)) {
                $this->Flash->success(__('The model colour has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The model colour could not be saved. Please, try again.'));
        }
        $colours = $this->ModelColours->Colours->find('list', ['limit' => 200]);
        $models = $this->ModelColours->Models->find('list', ['limit' => 200]);
        $this->set(compact('modelColour', 'colours', 'models'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Model Colour id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $modelColour = $this->ModelColours->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $modelColour = $this->ModelColours->patchEntity($modelColour, $this->request->getData());
            if ($this->ModelColours->save($modelColour)) {
                $this->Flash->success(__('The model colour has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The model colour could not be saved. Please, try again.'));
        }
        $colours = $this->ModelColours->Colours->find('list', ['limit' => 200]);
        $models = $this->ModelColours->Models->find('list', ['limit' => 200]);
        $this->set(compact('modelColour', 'colours', 'models'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Model Colour id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $modelColour = $this->ModelColours->get($id);
        if ($this->ModelColours->delete($modelColour)) {
            $this->Flash->success(__('The model colour has been deleted.'));
        } else {
            $this->Flash->error(__('The model colour could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
