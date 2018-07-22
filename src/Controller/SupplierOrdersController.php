<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SupplierOrders Controller
 *
 * @property \App\Model\Table\SupplierOrdersTable $SupplierOrders
 *
 * @method \App\Model\Entity\SupplierOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SupplierOrdersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Suppliers']
        ];
        $supplierOrders = $this->paginate($this->SupplierOrders);

        $this->set(compact('supplierOrders'));
    }

    /**
     * View method
     *
     * @param string|null $id Supplier Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $supplierOrder = $this->SupplierOrders->get($id, [
            'contain' => ['Suppliers', 'Phones']
        ]);

        $this->set('supplierOrder', $supplierOrder);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $supplierOrder = $this->SupplierOrders->newEntity();
        if ($this->request->is('post')) {
            $supplierOrder = $this->SupplierOrders->patchEntity($supplierOrder, $this->request->getData());
            if ($this->SupplierOrders->save($supplierOrder)) {
                $this->Flash->success(__('The supplier order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The supplier order could not be saved. Please, try again.'));
        }
        $suppliers = $this->SupplierOrders->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('supplierOrder', 'suppliers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Supplier Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $supplierOrder = $this->SupplierOrders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $supplierOrder = $this->SupplierOrders->patchEntity($supplierOrder, $this->request->getData());
            if ($this->SupplierOrders->save($supplierOrder)) {
                $this->Flash->success(__('The supplier order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The supplier order could not be saved. Please, try again.'));
        }
        $suppliers = $this->SupplierOrders->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('supplierOrder', 'suppliers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Supplier Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $supplierOrder = $this->SupplierOrders->get($id);
        if ($this->SupplierOrders->delete($supplierOrder)) {
            $this->Flash->success(__('The supplier order has been deleted.'));
        } else {
            $this->Flash->error(__('The supplier order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getSupplierOrders($id = null) {
        $this->autoRender = false;

        // Get all supplier orders
        $supplierOrders = $this->SupplierOrders->find('all', [
            'conditions' => ['supplier_id' => $id]
            ]
        )->all();

        $supplierOrdersList = [];
        foreach($supplierOrders as $supplierOrder) {

            $supplierOrdersList[] = ['value' => $supplierOrder->id, 'text' => $supplierOrder->invoice_number, 'data-subtext' => $supplierOrder->invoice_date . ' - Comments: ' . $supplierOrder->comments];
        }

        if ($this->request->is(['patch', 'post', 'put', 'get'])) {
            $this->response = $this->response->withStringBody(json_encode($supplierOrdersList));
        }
    }
}
