<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
/**
 * Phone Entity
 *
 * @property int $id
 * @property string $imiei
 * @property string $serial_number
 * @property string $grade
 * @property string $status
 * @property int $storage_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $comments
 * @property int $model_id
 * @property int $colour_id
 * @property float $battery_health
 * @property string $sim_lock_status
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

    protected $_virtual = ['label'];
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
        'battery_cycles' => true,
        'os_version' => true,
        'region_code' => true,
        'model_number' => true,
        'storage' => true,
        'model' => true,
        'colour' => true,
        'user_id' => true,
        'supplier_order_id' => true,
        'supplier_order' => true,
        'customers' => true,
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
               . ' ' . ($this->grade ? $this->grade : '');
    }
}
