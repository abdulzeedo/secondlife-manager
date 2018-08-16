<?php
/**
 * Created by PhpStorm.
 * User: tesina
 * Date: 10/08/2018
 * Time: 16:14
 */

namespace App\Controller\Phones;


use Cake\I18n\Time;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

trait PhoneModalTrait
{
    public function editRepairModal ($id = null) {
        $repair = $this->Phones->Repairs->get($id, [
            'contain' => []
        ]);
        $this->Modal->editOrAdd($this->Phones->Repairs, $id, $repair);

        $phone = $this->Phones->find('all')
            ->where(['id' => $repair->item_id])
            ->first();

        $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        $values = $this->Phones->Repairs->getDefaultValues();
        $this->set(compact('repair', 'phonesList', 'values'));
    }

    public function editReturnModal ($id = null) {
        $return = $this->Phones->ItemReturns->get($id, [
            'contain' => []
        ]);

        $this->Modal->editOrAdd($this->Phones->ItemReturns, $id, $return);

        $phone = $this->Phones->find('all')
            ->where(['Phones.id' => $return->item_id])
            ->first();

        $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        $values = $this->Phones->ItemReturns->getDefaultValues();
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

        $this->Modal->editOrAdd($this->Phones->Repairs, $id, $repair);

        $phone = $this->Phones->find('all')
            ->where(['Phones.id' => $repair->item_id])
            ->first();

        $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];

        $values = $this->Phones->Repairs->getDefaultValues();
        $this->set(compact('repair', 'phonesList', 'values'));
        $this->viewBuilder()->setTemplate('edit_repair_modal');

    }

    public function addReturnModal ($id = null) {
        $return = $this->Phones->ItemReturns->newEntity();

        if ($id)
            $return->item_id = $id;

        $this->Modal->editOrAdd($this->Phones->ItemReturns, $id, $return);

        $phone = $this->Phones->find('all')
            ->where(['Phones.id' => $return->item_id])
            ->first();

        $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
        $values = $this->Phones->itemReturns->getDefaultValues();
        $this->set(compact('return', 'phonesList', 'values'));
        $this->viewBuilder()->setTemplate('edit_return_modal');
    }


    /**
     * Set a list of phones as sold to a specific customer
     */
    public function addTransactionsModal() {
        $customersTable = TableRegistry::get('Customers');
        $this->viewBuilder()->setLayout(false);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = TableRegistry::get('Customers')->find('all')
                ->where(['Customers.id' => $this->request->getData('customer_id')])
                ->contain(['Phones'])
                ->first();
            $customer = $customersTable->patchEntity($customer, $this->request->getData(),
                ['associated' => ['Phones._joinData']]);

            foreach($customer->phones as $phone) {
                $date = new Time($this->request->getData('date'), 'Europe/Rome');
                $date = $date->timezone('UTC');
                $phone->_joinData->date = $date;

            }
            if (!$customersTable->save($customer))
            {
                $phoneErrors = [];
                foreach($customer->phones as $phone) {
                    if ($phone->getErrors())
                        $phoneErrors["phones"][] = $phone->getErrors();
                }
                $errors = $phoneErrors;

                $this->response = $this->response->withStatus(400);
                $this->viewBuilder()->setClassName('Json');

                $this->set(compact(['errors']));
                $this->set('_serialize', ['errors']);
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


            foreach($imieiList as $imieiWithSpaces) {
                // Try to retrieve the object from database, if it doesn't exist
                // create a new entity

                $imiei = trim($imieiWithSpaces);

                $phone = $this->Phones->find('all', [
                    'conditions' => ['imiei' => $imiei]
                ]);

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
}