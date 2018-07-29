<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Filesystem\File;
use Cake\I18n\FrozenTime;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

/**
 * Phones Controller
 *
 * @property \App\Model\Table\PhonesTable $Phones
 * * @property \App\Model\Table\RepairsTable $Repairs
 *
 * @method \App\Model\Entity\Phone[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PhonesController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index', 'export']
        ]);

    }

    public function imieiList($imiei = '') {
        $this->autoRender = false;
        $phones = $this->Phones->find('all', [
            'conditions' => ['imiei LIKE' => '%'.$imiei.'%']
        ])->toArray();

        $phonesList = [];
        foreach($phones as $phone) {

            $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        }
        $this->response = $this->response->withStringBody(json_encode($phonesList));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function debug() {
        $this->autoRender = false;
        debug($this->Phones->find()->contain(['Repairs']));
    }

    public function getPhoneDetails($id = null) {

        if ($id != null && $this->request->is(['ajax', 'post', 'get'])) {
            $phone = $this->Phones->find('all')
                ->where(['Phones.id' => $id])
                ->contain(['Repairs', 'SupplierOrders.Suppliers', 'ItemReturns', 'Transactions.Customers']);

            FrozenTime::setJsonEncodeFormat('dd-MM-yyyy HH:mm:ss');
            FrozenTime::setDefaultLocale('it-IT');
            $this->viewBuilder()->setClassName('Json');
            $phone = $phone->first();

            $this->set(compact(['phone']));
            $this->set('_serialize', ['phone']);

        }
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('bootstrap');
        $query = $this->Phones
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            ->find('search', ['search' => $this->request->getQueryParams()])
            ->contain(['Repairs', 'ItemReturns', 'SupplierOrders.Suppliers'])->distinct();

        $query->contain(
            ['Storages', 'Models', 'Colours', 'Users']
        );

        $storages = $this->Phones->Storages->find('list', ['limit' => 200]);
        $users = $this->Phones->Users->find('list', ['limit' => 200]);
        $models = $this->Phones->Models->find('list', ['limit' => 200]);
        $colours = $this->Phones->Colours->find('list', ['limit' => 200]);
        $suppliers = $this->Phones->SupplierOrders->Suppliers->find('list', ['limit' => '200']);

        $repairs = $this->getRepairDefaultValues()['status'];
        $repairs[] = [
            'text' => 'All repairs: any status',
            'value' => 'any'
        ];

        $this->set('phones', $query->all());
        $this->set(compact('storages', 'models', 'colours', 'users', 'suppliers', 'repairs'));
    }

    /**
     * Used to generate a CSV file of the current table
     */
    public function export()
    {
        $query = $this->Phones
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            ->find('search', ['search' => $this->request->getQueryParams()])
            ->contain(['Repairs', 'ItemReturns', 'SupplierOrders.Suppliers'])
            ->distinct()->all();

        $_serialize = 'query';
        $_header = ['Internal ID', 'IMIEI', 'Serial N', 'Status', 'Description', 'Comments',
                    'Battery Cycles', 'Created', 'Supplier Name', 'Repair description'];
        $_extract = [
            'id',
            'imiei',
            'serial_number',
            'status',
            'label',
            'comments',
            'battery_cycles',
            'created',
            'supplier_order.supplier.name',
            function ($row) {
                $labelsList = '';
                foreach($row['repairs'] as $repair) {
                    $labelsList .= $repair['id']. ': Reason (' . $repair['reason']. ') '
                        . ' Comments: ' . $repair['comments'];
                }
                return $labelsList;
            }
        ];

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('query', '_serialize', '_header', '_extract'));
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
            'contain' => ['Storages', 'Models', 'Colours', 'Repairs', 'ItemReturns', 'Transactions.Customers', 'SupplierOrders.Suppliers']
        ]);

        $this->set('phone', $phone);
        $this->set('customer', $this->Phones->Customers->find('all')->last());
    }

    private function getRepairDefaultValues() {
        $values = [
            'status' => [
                ['value' => 'Repair created', 'text' => 'Repair created'],
                ['value' => 'In repair', 'text' => 'In repair'],
                ['value' => 'Repaired', 'text' => 'Repaired', 'data-subtext' => 'Inspection phase'],
                ['value' => 'Testing', 'text' => 'Testing', 'data-subtext' => 'Test thoroughly'],
                ['value' => 'Complete', 'text' => 'Complete', 'data-subtext' => 'Great!']
            ],
            'reason' => [
                ['value' => 'LCD', 'text' => 'LCD'],
                ['value' => 'Battery', 'text' => 'Battery'],
                ['value' => 'Audio', 'text' => 'Audio'],
                ['value' => 'Flash', 'text' => 'Flash'],
                ['value' => 'Back Camera', 'text' => 'Back Camera'],
                ['value' => 'Front Camera', 'text' => 'Front Camera'],
                ['value' => 'Proximity Sensor', 'text' => 'Proximity Sensor'],
                ['value' => 'Other', 'text' => 'Other', 'data-subtext' => 'Wright some details in comments!'],
            ]
        ];
        return $values;
    }

    private function getReturnDefaultValues() {
        $values = [
            'status' => [
                ['value' => 'Return created', 'text' => 'Return created'],
                ['value' => 'Return shipped', 'text' => 'Return shipped'],
                ['value' => 'Return received', 'text' => 'Return received'],
                ['value' => 'Return Inspected', 'text' => 'Return Inspected', 'data-subtext' => 'Add comments if needed'],
                ['value' => 'On wait', 'text' => 'On wait', 'data-subtext' => 'In repair, out of stock etc.'],
                ['value' => 'Resent', 'text' => 'Resent', 'data-subtext' => 'Hurray! Nice one!']
            ],
            'reason' => [
                ['value' => 'Changed mind', 'text' => 'Changed mind', 'data-subtext' => 'recesso'],
                ['value' => 'Too dirty', 'text' => 'Too dirty', 'data-subtext' => 'grade not satisfying'],
                ['value' => 'Battery', 'text' => 'Battery'],
                ['value' => 'Audio', 'text' => 'Audio'],
                ['value' => 'LCD', 'text' => 'LCD'],
                ['value' => 'Other', 'text' => 'Other', 'data-subtext' => 'Wright some details in comments!'],
            ]
        ];
        return $values;
    }
    public function editRepairModal ($id = null) {
        $this->viewBuilder()->setLayout(false);
        $repair = $this->Phones->Repairs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $repair = $this->Phones->Repairs->patchEntity($repair, $this->request->getData());
            if (!$this->Phones->Repairs->save($repair)) {
                $this->response = $this->response->withStatus(400);
            }

        }

        $phones = $this->Phones->find('all')->toArray();

        $phonesList = [];
        foreach($phones as $phone) {
            $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        }
        $values = $this->getRepairDefaultValues();
        $this->set(compact('repair', 'phonesList', 'values'));
    }

    public function editReturnModal ($id = null) {
        $this->viewBuilder()->setLayout(false);
        $return = $this->Phones->ItemReturns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $return = $this->Phones->ItemReturns->patchEntity($return, $this->request->getData());
            if (!$this->Phones->ItemReturns->save($return)) {
                $this->response = $this->response->withStatus(400);
            }

        }



        $phones = $this->Phones->find('all')->toArray();

        $phonesList = [];
        foreach($phones as $phone) {
            $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        }
        $values = $this->getReturnDefaultValues();

        $this->set(compact('return', 'phonesList', 'values'));
    }

    /**
     * @param null $id
     */
    public function addRepairModal ($id = null) {
        $this->viewBuilder()->setLayout(false);
        $repair = $this->Phones->Repairs->newEntity();

        if ($id)
            $repair->item_id = $id;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $repair = $this->Phones->Repairs->patchEntity($repair, $this->request->getData());
            if (!$this->Phones->Repairs->save($repair)) {
                $this->response = $this->response->withStatus(400);
            }

        }

        $phones = $this->Phones->find('all')->toArray();

        $phonesList = [];
        foreach($phones as $phone) {

            $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        }
        $values = $this->getRepairDefaultValues();
        $this->set(compact('repair', 'phonesList', 'values'));
        $this->viewBuilder()->setTemplate('edit_repair_modal');

    }

    public function addReturnModal ($id = null) {
        $this->viewBuilder()->setLayout(false);
        $return = $this->Phones->ItemReturns->newEntity();

        if ($id)
            $return->item_id = $id;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $return = $this->Phones->ItemReturns->patchEntity($return, $this->request->getData());
            if (!$this->Phones->ItemReturns->save($return)) {
                $this->response = $this->response->withStatus(400);
            }

        }


        $phones = $this->Phones->find('all')->toArray();

        $phonesList = [];
        foreach($phones as $phone) {

            $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        }

        $values = $this->getReturnDefaultValues();

        $this->set(compact('return', 'phonesList', 'values'));
        $this->viewBuilder()->setTemplate('edit_return_modal');

    }

    public function addTransactionsModal() {
        $this->viewBuilder()->setLayout(false);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Phones->Customers->get($this->request->getData('customer_id'),
                [ 'associated' => ['Phones']]);

            $customer = $this->Phones->Customers->patchEntity($customer, $this->request->getData(),
                ['associated' => ['Phones']]);
            if (!$this->Phones->Customers->save($customer)) {
                $this->response = $this->response->withStatus(400);
            }
        }

        $customersList = $this->Phones->Customers->find('list', ['limit' => '200']);

        $this->set(compact('customersList'));
    }

    public function addSupplierItemsModal() {
        $this->viewBuilder()->setLayout(false);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $imieiString = $this->request->getData("phones_list");
            $imieiList = explode("\n", $imieiString);


            foreach($imieiList as $imiei) {
                // Try to retrieve the object from database, if it doesn't exist
                // create a new entity
                $phone = $this->Phones->find('all', [
                    'conditions' => ['imiei' => trim($imiei)]
                ]);

                debug($phone->isEmpty());


                if ($phone->isEmpty()) {
                    $phone = $this->Phones->newEntity($this->request->getData());
                    $phone->imiei = $imiei;
                    // Set serial_number the same as imiei to maintain unique key
                    // and it might be used to check which iPhones have not yet tested.
                    $phone->serial_number = $imiei;
                }
                else {
                    // If it already exists update with data from the form such as
                    // supplier order id
                    $phone = $this->Phones->patchEntity($phone->first(), $this->request->getData());
                }

                /**
                 * ATTENTION: function returns as soon as there is a validation error
                 * TODO: add some validation error message here
                 **/
                if(!$this->Phones->save($phone)) {
                    $this->response = $this->response->withStatus(400);
                    return;
                }
            }
        }

        $suppliersList = $this->Phones->SupplierOrders->Suppliers->find('list', ['limit' => '200']);
        $this->set(compact('suppliersList'));
    }

    public function repairsTable($id = null) {
        $this->viewBuilder()->setLayout(false);
        if ($this->request->is('ajax')) {

            $phone = $this->Phones->get($id, [
                'contain' => ['Storages', 'Models', 'Colours', 'Repairs', 'ItemReturns']
            ]);
            $this->set('phone', $phone);

        }
        $this->viewBuilder()->setTemplate('/Element/Common/repairs');
    }
    public function returnsTable($id = null) {
        $this->viewBuilder()->setLayout(false);
        if ($this->request->is('ajax')) {

            $phone = $this->Phones->get($id, [
                'contain' => ['Storages', 'Models', 'Colours', 'Repairs', 'ItemReturns']
            ]);
            $this->set('phone', $phone);

        }
        $this->viewBuilder()->setTemplate('/Element/Common/returns');
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
            'contain' => ['Storages', 'Models', 'Colours', 'Repairs', 'ItemReturns']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $phone = $this->Phones->patchEntity($phone, $this->request->getData());
            if ($this->Phones->save($phone)) {
                $this->Flash->success(__('The phone has been saved.'));

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
        $this->viewBuilder()->setLayout('bootstrap');

    }


    // Used to download software for diagnosis
    public function download(){

        $this->autoRender= false;
        //  Write the config ini file
        $file = new File( WWW_ROOT.DS.'files'.DS.'IPhoneDiagnostics'.DS.'config.ini');

        $user = $this->Auth->user();



        $file->write(
                "[DEFAULT] \n"
                . 'email = ' . $user["email"] . "\n"
                . 'api_key = ' . $user["api_key_plain"] . "\n"
                . 'server_address = ' . 'http://' .$this->request->host() . "\n"
        );

        $file->close(); // Be sure to close the file when you're done

        $this->compressFolder();

        $file_path = WWW_ROOT.DS.'files'.DS.'iPhoneDiagnostics.zip';

        return $this->response->withFile($file_path, [
            'download' => true,
            'name' => 'iPhoneDiagnosis.zip',
        ]);
    }

    protected function compressFolder() {
        // Get real path for our folder
        // The folder must not be a symbolic link
        $rootPath =  realpath(WWW_ROOT.DS.'files'.DS.'IPhoneDiagnostics');

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open('files/iPhoneDiagnostics.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $stat = stat($filePath);
                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
                $zip->setExternalAttributesName($relativePath, ZipArchive::OPSYS_UNIX, $stat["mode"]);
            }
        }
        // Zip archive will be created only after closing object
        $zip->close();
    }
}
