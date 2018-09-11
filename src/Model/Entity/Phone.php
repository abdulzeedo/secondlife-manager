<?php
namespace App\Model\Entity;

use Cake\Collection\Collection;
use Cake\Error\Debugger;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
/**
 * Phone Entity
 *
 * @property int $id
 * @property string $imiei
 * @property string $serial_number
 * @property string $grade
 * @property string $status
 * @property string $label
 * @property int $storage_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $comments
 * @property int $model_id
 * @property int $colour_id
 * @property float $battery_health
 * @property string $sim_lock_status
 * @property string $icloud_status
 * @property string $touch_id_status
 * @property string $is_phone_available
 * @property int $battery_cycles
 * @property string $os_version
 * @property string $region_code
 * @property string $product_type_specific
 * @property string $model_number
 * @property string $supplier_order
 * @property string $customers
 * @property string $transaction
 *
 * @property \App\Model\Entity\Storage $storage
 * @property \App\Model\Entity\Model $model
 * @property \App\Model\Entity\Colour $colour
 */
class Phone extends Entity
{

    protected $_virtual = ['label', 'touch_id_status_label', 'icloud_status_label', 'is_phone_available',
                            'audit_trail'];
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'imiei' => true,
        'serial_number' => true,
        'grade' => true,
        'status' => true,
        'storage_id' => true,
        'created' => true,
        'modified' => true,
        'comments' => true,
        'model_id' => true,
        'colour_id' => true,
        'battery_health' => true,
        'sim_lock_status' => true,
        'icloud_status' => true,
        'touch_id_status' => true,
        'battery_cycles' => true,
        'os_version' => true,
        'region_code' => true,
        'model_number' => true,
        'is_phone_available' => true,
        'storage' => true,
        'model' => true,
        'colour' => true,
        'user_id' => true,
        'supplier_order_id' => true,
        'supplier_order' => true,
        'customers' => true,
        'repairs' => true,
        'itemReturns' => true,
        'transaction' => true,
        'connected_phones' => true,
    ];

    protected function _getLabel()
    {
        $colour = TableRegistry::get('Colours')->findById($this->colour_id)->first();
        $model = TableRegistry::get('Models')->findById($this->model_id)->first();
        $storage = TableRegistry::get('Storages')->findById($this->storage_id)->first();

        return ($model ? $model->name : '') . ' ' . ($storage ? $storage->storage : '') . ' GB '
               . ($colour ? $colour->colour_name : '')
               . ' ' . (isset($this->_properties['grade']) ? $this->_properties['grade'] : '');
    }
    protected function _getIcloudStatusLabel() {
        if (!isset($this->_properties['icloud_status']))
            return '';
        return $this->getIcloudStatusLabel($this->_properties['icloud_status']);
    }
    protected function getIcloudStatusLabel($icloud_status) {
        if ($icloud_status == '0')
            return "unlocked";
        else
            return "locked";
    }
    protected function _getTouchIdStatusLabel() {
        if (!isset($this->_properties['touch_id_status']))
            return '';
        return $this->getTouchIdStatusLabel($this->_properties['touch_id_status']);
    }

    protected function getTouchIdStatusLabel($touch_id_status) {
        if ($touch_id_status == '0')
            return "working";
        else
            return "not working";
    }


    /**
     * Return if a phone is available by comparing the number of times
     * it was sold and the number of returns that have been registered.
     * Returns cannot exceed the sold quantity.
     * @return bool true if available, false if not available
     */
    protected function _getIsPhoneAvailable() {
        if (!isset($this->_properties['id']))
            return '';
        $returnsCount = TableRegistry::get('ItemReturns')->find('all')
            ->where(['item_id' => $this->_properties['id']])->count();
        $transactionsCount = TableRegistry::get('Transactions')->find('all')
            ->where(['item_id' => $this->_properties['id']])->count();
        if ($transactionsCount > $returnsCount)
            return false;
        else if ($transactionsCount == $returnsCount)
            return true;

//        debug("Hey it was wrong");
//        debug($returnsCount);
//        debug($transactionsCount);
        // If any of the above is false, then something is wrong.
        return false;
    }

    /**
     * Get the returns containing the current phone's id and count it.
     * @return int Return the number of item returns.
     */
    public function getReturnsCount() {
        if (!isset($this->_properties['id']))
            return '';
        $returnsCount = TableRegistry::get('ItemReturns')->find('all')
            ->where(['item_id' => $this->_properties['id']])->count();

        return $returnsCount;
    }

    /**
     * Get the repairs containing the current phone's id and count it.
     * @return int Return the number of repairs.
     */
    public function getRepairsCount() {
        if (!isset($this->_properties['id']))
            return '';
        $repairsCount = TableRegistry::get('Repairs')->find('all')
            ->where(['item_id' => $this->_properties['id']])->count();

        return $repairsCount;
    }

    /**
     * Generate a verbose for all the audit trails of this phone entity
     *
     * @return array|string An array of verbalised audit trails of the phone entity
     */
    protected function _getAuditTrail() {
        if (!isset($this->_properties['id']))
            return '';
        $AuditLog = TableRegistry::get('audit_logs');
        // Get phones audit
        $phoneLogs = $AuditLog->find('all')
            ->where(['source' => 'phones'])
            ->andWhere(['primary_key' => $this->_properties['id']]);
        $verbalizedLogs = new Collection([]);
        $verbalizedLogs = $verbalizedLogs->append($this->verbalisePhoneAuditTrails($phoneLogs->all()));

        $returns = TableRegistry::get('ItemReturns')->find('all', ['withDeleted'])
            ->where(['item_id' => $this->_properties['id']])
            ->select('id')->extract('id');
        // Get returns audit
        if (!$returns->isEmpty()) {
            $returnsLogs = $AuditLog->find('all')
                ->where(['source' => 'item_returns'])
                ->andWhere(['primary_key IN' => $returns->toList()]);
            $verbalizedLogs = $verbalizedLogs->append($this->verbalisePhoneAuditTrails($returnsLogs->all()));
        }
        $repairs = TableRegistry::get('Repairs')->find('all', ['withDeleted'])
            ->where(['item_id' => $this->_properties['id']])->extract('id');
        // Get repairs audits
        if (!$repairs->isEmpty()) {
            $repairLogs = $AuditLog->find('all')
                ->where(['source' => 'repairs'])
                ->andWhere(['primary_key IN' => $repairs->toList()]);
            $verbalizedLogs = $verbalizedLogs->append($this->verbalisePhoneAuditTrails($repairLogs->all()));
        }

        $transactions = TableRegistry::get('Transactions')->find('all', ['withDeleted'])
            ->where(['item_id' => $this->_properties['id']])->extract('id');
        // Get transaction audits
        if (!$transactions->isEmpty()) {
            $transactionLogs = $AuditLog->find('all')
                ->where(['source' => 'transactions'])
                ->andWhere(['primary_key IN' => $transactions->toList()]);
            $verbalizedLogs = $verbalizedLogs->append($this->verbalisePhoneAuditTrails($transactionLogs->all()));
        }
        $verbalizedLogs = $verbalizedLogs->sortBy('date');
        return $verbalizedLogs->toList();
    }

    /**
     * Verbalise every entry of the audit trail
     *
     * @param $phoneLogs
     * @return array An array of verbalised phone audit trails
     */
    protected function verbalisePhoneAuditTrails($phoneLogs) {
        $User = TableRegistry::get('Users');

        $verbalized = [];
        foreach ($phoneLogs as $logs) {
            $entity = str_ireplace('_', ' ', substr($logs->source, 0, -1));
            $meta = json_decode($logs->meta);
            $user = $User->get($meta->user);
            if ($logs->type === 'create' || $logs->type === 'update') {
                $original = json_decode($logs->original, true);
                $changed = json_decode($logs->changed, true);
                $changesVerbalized = [];
                foreach ($original as $origProperty => $origValue) {
                    if (substr($origProperty, -3) == '_id') {
                        $probableTableName = substr($origProperty, 0, -3). 's';
                        if(TableRegistry::exists(ucfirst($probableTableName))) {
                            $Table = TableRegistry::get($probableTableName);
                            $displayField = $Table->getDisplayField();
                            if ($origValue !== null)
                                $origValue = $Table->get($origValue)->get($displayField);
                            $changed[$origProperty] = $Table->get($changed[$origProperty])->get($displayField);
                        }
                    }
                    else if ($this->get($origProperty . '_label')) {
                        $functionName =
                                    str_ireplace(' ', '',
                                        ucwords(str_ireplace('_', ' ', $origProperty . '_label')));
                        $functionName = 'get' . $functionName;

                        $origValue = $this->$functionName($origValue);
                        $changed[$origProperty] = $this->$functionName($changed[$origProperty]);
                    }
                    if ($changed[$origProperty] !== '' && $origValue !== '')
                    $changesVerbalized[] = [
                        'original' => $origValue,
                        'changed' => $changed[$origProperty],
                        'property' => substr($origProperty, -3) == '_id'
                                        ? str_ireplace('_', ' ', substr($origProperty, 0, -3))
                                        : str_ireplace('_', ' ', $origProperty),
                    ];
                }
                $verbalized[] = [
                    'source' => $entity,
                    'user' => $user->email,
                    'id' => $logs->primary_key,
                    'message' => "$user->email has {$logs->type}d $entity entries.",
                    'updates' => $changesVerbalized,
                    'type' => $logs->type.'d',
                    "date" => $logs->created,
                ];
            }
            else if ($logs->type === 'delete') {
                $verbalized[] = [
                    'source' => $entity,
                    'user' => $user->email,
                    'id' => $logs->primary_key,
                    'message' => "$user->email has deleted this $entity.",
                    'updates' => [],
                    'type' => 'deleted',
                    "date" => $logs->created,
                ];
            }

        }
        return $verbalized;
    }
}
