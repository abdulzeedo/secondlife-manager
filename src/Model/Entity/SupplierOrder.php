<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SupplierOrder Entity
 *
 * @property int $id
 * @property string $invoice_number
 * @property \Cake\I18n\FrozenTime $invoice_date
 * @property string $comments
 * @property int $supplier_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\Phone[] $phones
 */
class SupplierOrder extends Entity
{

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
        'invoice_number' => true,
        'invoice_date' => true,
        'comments' => true,
        'supplier_id' => true,
        'created' => true,
        'modified' => true,
        'supplier' => true,
        'phones' => true
    ];
}
