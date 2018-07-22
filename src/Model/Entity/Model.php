<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Model Entity
 *
 * @property int $id
 * @property string $name
 * @property int $manufacturer_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $model_code
 *
 * @property \App\Model\Entity\Manufacturer $manufacturer
 * @property \App\Model\Entity\ModelColour[] $model_colours
 * @property \App\Model\Entity\ModelStorage[] $model_storages
 * @property \App\Model\Entity\Phone[] $phones
 */
class Model extends Entity
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
        'manufacturer_id' => true,
        'created' => true,
        'modified' => true,
        'model_code' => true,
        'manufacturer' => true,
        'model_colours' => true,
        'model_storages' => true,
        'phones' => true
    ];
}
