<?php
/**
 * Created by PhpStorm.
 * User: tesina
 * Date: 03/09/2018
 * Time: 23:21
 */

namespace App\Controller\Phones;

use Cake\Network\Exception\ForbiddenException;
use Cake\I18n\FrozenTime;
/**
 * Trait PhoneAjaxTrait
 * @package App\Controller\Phones
 */
trait PhoneAjaxTrait
{
    public function imieiList($imiei = '') {
        // abort request if not ajax
        if (!$this->request->is(['ajax', 'get']))
            throw new ForbiddenException();

        $phones = [];
        $phonesList = [];

        if ($imiei !== '') {
            $phones = $this->Phones->find('all', [
                'conditions' => ['imiei LIKE' => '%'.$imiei.'%']
            ])->toArray();
            foreach($phones as $phone) {

                $phonesList[] = ['value' => $phone->id, 'text' => $phone->imiei, 'data-subtext' => $phone->label];
            }
        }
        $this->viewBuilder()->setClassName('Json');
        $this->set(compact(['phonesList']));
        $this->set('_serialize', ['phonesList']);
    }

    public function getPhoneDetails($id = null) {
        if ($id === null && !$this->request->is(['ajax'])) {
            throw new ForbiddenException();
        }
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