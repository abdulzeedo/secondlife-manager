<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Storage Entity
 *
 * @property int $id
 * @property string $storage
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ModelStorage[] $model_storages
 * @property \App\Model\Entity\Phone[] $phones
 */
class Storage extends Entity
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
        'storage' => true,
        'created' => true,
        'modified' => true,
        'model_storages' => true,
        'phones' => true
    ];
}
