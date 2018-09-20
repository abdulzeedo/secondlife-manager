<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemReturnsTypeStatus Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $item_returns_type_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ItemReturnsType $item_returns_type
 * @property \App\Model\Entity\ItemReturn[] $item_returns
 */
class ItemReturnsTypeStatus extends Entity
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
        'name' => true,
        'description' => true,
        'item_returns_type_id' => true,
        'created' => true,
        'modified' => true,
        'item_returns_type' => true,
        'item_returns' => true
    ];
}
