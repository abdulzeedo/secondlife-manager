<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemReturn Entity
 *
 * @property int $id
 * @property string $reason
 * @property string $status
 * @property string $refund
 * @property string $comments
 * @property int $item_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Phone $phone
 */
class ItemReturn extends Entity
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
        'reason' => true,
        'status' => true,
        'refund' => true,
        'comments' => true,
        'item_id' => true,
        'item_returns_type_id' => true,
        'item_returns_type' => true,
        'customer_return_tracking' => true,
        'customer_resent_tracking' => true,
        'exchanged_with_item' => true,
        'refund_amount' => true,
        'item_returns_type_status_id' => true,
        'item_returns_type_status' => true,
        'item_returns_status_id' => true,
        'item_returns_status' => true,
        'created' => true,
        'modified' => true,
        'phone' => true,
        'return_date' => true,
    ];
}
