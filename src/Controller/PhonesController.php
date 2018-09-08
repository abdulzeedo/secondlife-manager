<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;


/**
 * Phones Controller
 *
 * @property \App\Model\Table\PhonesTable $Phones
 * @property \App\Model\Table\RepairsTable $Repairs
 *
 * @method \App\Model\Entity\Phone[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PhonesController extends AppController
{
    use Phones\PhoneModalTrait;
    use Phones\AdditionalOptionsTrait;
    use Phones\PhoneAjaxTrait;

    public function initialize()
    {
        $this->viewBuilder()->setLayout('bootstrap');
        parent::initialize();

        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index', 'export']
        ]);
        $this->loadComponent('Modal');

        Configure::write('CakePdf', [
            'engine' => 'CakePdf.Mpdf',
            'margin' => [
                'bottom' => 15,
                'left' => 50,
                'right' => 30,
                'top' => 45
            ],
            'orientation' => 'landscape'
        ]);

    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */




    /**
     * Generate key-value array type of query for all filters based on one main query
     * @param $query
     * @param $keyField
     * @param $valueField
     * @param $joinTable
     * @return mixed Query
     */
    protected function getQueryWithCount(Query $query, $keyField, $valueField, $joinTable, $getId) {
        $newQuery = $query->cleanCopy()
            ->find('list', [
                'keyField' => function($entity) use($getId) {
                    return $getId($entity);
                },
                'valueField' => 'countedValue'
            ]);

        return $newQuery->innerJoinWith($joinTable)
            ->group([$keyField])
            ->select(['SupplierOrders.supplier_id', 'countedValue' => $newQuery->func()->concat([
                $valueField => 'literal',
                ' (',
                'COUNT('.$keyField.')' => 'literal',
                ')'
            ])
            ])
            ->enableAutoFields(true);

    }

    public function index()
    {
//        debug($this->request->getQueryParams());
        $this->viewBuilder()->setLayout('bootstrap');
        $query = $this->Phones
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            ->find('search', ['search' => $this->request->getQueryParams()])
            ->contain(['Repairs', 'ItemReturns', 'SupplierOrders.Suppliers'])->distinct();

        $query->contain(
            ['Storages', 'Models', 'Colours', 'Users']
        );
        $storages = $this->getQueryWithCount($query, 'storage_id', 'Storages.storage',
                                             'Storages', function($entity){return $entity->get('storage_id');});

        $users = $this->getQueryWithCount($query, 'user_id', 'Users.email',
        'Users', function($entity){return $entity->get('user_id');});
//        $users = $this->Phones->Users->find('list', ['limit' => 200]);
        $models = $this->getQueryWithCount($query, 'model_id', 'Models.name',
            'Models', function($entity){return $entity->get('model_id');});

//        $models = $this->Phones->Models->find('list', ['limit' => 200]);
        $colours = $this->getQueryWithCount($query, 'colour_id', 'Colours.colour_name',
            'Colours', function($entity){return $entity->get('colour_id');});
//        $colours = $this->Phones->Colours->find('list', ['limit' => 200]);
        $suppliers = $this->getQueryWithCount($query, 'SupplierOrders.supplier_id', 'Suppliers.name',
            'SupplierOrders.Suppliers', function($entity){return $entity->supplier_order->supplier_id;});
//        debug($suppliers->toArray());
//        $suppliers = $this->Phones->SupplierOrders->Suppliers->find('list', ['limit' => '200']);
//        $customers = $this->getQueryWithCount($query, 'Customers.id', 'Customers.name',
//            'Customers', function($entity){return $entity->customers->id;});
        $customers = $this->Phones->Customers->find('list');
        $repairs = $this->Phones->Repairs->getDefaultValues('status');
        $repairs[] = [
            'text' => 'All repairs: any status',
            'value' => 'any'
        ];

        $repairsReason = $this->Phones->Repairs->getDefaultValues('reason');

        $this->set('phones', $query);
        $this->set(compact('storages', 'models', 'colours', 'users', 'suppliers', 'repairs', 'repairsReason', 'customers'));
    }


    /**
     * View method
     *
     * @param string|null $id Phone id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout("bootstrap");
        $phone = $this->Phones->get($id, [
            'contain' => ['Storages', 'Models', 'Colours', 'Repairs', 'ItemReturns', 'Customers', 'SupplierOrders.Suppliers']
        ]);

        $this->set('phone', $phone);
        $this->set('customer', $this->Phones->Customers->find('all')->last());
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $phone = $this->Phones->newEntity();
        if ($this->request->is('post')) {
            $phone->user_id = $this->Auth->user('id');
            $phone = $this->Phones->patchEntity($phone, $this->request->getData());
            if ($this->Phones->save($phone)) {
                $this->Flash->success(__('The phone has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The phone could not be saved. Please, try again.'));
        }
        $storages = $this->Phones->Storages->find('list', ['limit' => 200]);
        $models = $this->Phones->Models->find('list', ['limit' => 200]);
        $colours = $this->Phones->Colours->find('list', ['limit' => 200]);
        $this->set(compact('phone', 'storages', 'models', 'colours'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Phone id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $phone = $this->Phones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phone = $this->Phones->patchEntity($phone, $this->request->getData());
            if ($this->Phones->save($phone)) {
                $this->Flash->success(__('The phone has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The phone could not be saved. Please, try again.'));
        }
        $storages = $this->Phones->Storages->find('list', ['limit' => 200]);
        $models = $this->Phones->Models->find('list', ['limit' => 200]);
        $colours = $this->Phones->Colours->find('list', ['limit' => 200]);
        $this->set(compact('phone', 'storages', 'models', 'colours'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Phone id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $phone = $this->Phones->get($id);
        if ($this->Phones->delete($phone)) {
            $this->Flash->success(__('The phone has been deleted.'));
        } else {
            $this->Flash->error(__('The phone could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function connected($id = null) {

        $this->viewBuilder()->setLayout("bootstrap");
        $phone = $this->Phones->get($id, [
            'contain' => ['Storages', 'Models', 'Colours', 'Repairs', 'ItemReturns', 'Customers', 'SupplierOrders.Suppliers']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phone = $this->Phones->patchEntity($phone, $this->request->getData());
            if ($this->Phones->save($phone)) {
                $this->Flash->success(
                    '<p>The phone has been saved: '
                        .'<b>'.$phone->label . '</b> - '. $phone->imiei .'</p>'
                        .'<p><a href="/phones/connected/'.$phone->id.'" class="btn btn-primary btn-sm">Edit</a>'
                        .' <a href="/phones/view/'.$phone->id.'" class="btn btn-default btn-sm">View</a></p>',
                        ['escape' => false]
                );

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The phone could not be saved. Please, try again.'));
        }
        else {
            $values = [
                'sim_lock_status' => [
                    ['value' => 'unlocked', 'text' => 'Unlocked'],
                    ['value' => 'locked', 'text' => 'Locked']
                ],
                'grade' => [
                    ['value' => 'A+', 'text' => 'A+'],
                    ['value' => 'A', 'text' => 'A'],
                    ['value' => 'A/B', 'text' => 'A/B'],
                    ['value' => 'B', 'text' => 'B'],
                    ['value' => 'C', 'text' => 'C', 'data-subtext' => 'Solo danno grave'],
                ]
            ];
            if ($phone->sim_lock_status === '' || !$phone->sim_lock_status)
                $this->request = $this->request->withData('sim_lock_status', 'unlocked');

        }
        $storages = $this->Phones->Storages->find('list', ['limit' => 200]);
        $models = $this->Phones->Models->find('list', ['limit' => 200]);
        $colours = $this->Phones->Colours->find('list', ['limit' => 200]);
        $this->set(compact('phone', 'storages', 'models', 'colours', 'values'));
    }

    public function connection() {

    }
}
