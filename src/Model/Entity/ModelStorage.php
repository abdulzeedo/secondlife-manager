<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ModelStorage Entity
 *
 * @property int $id
 * @property int $storage_id
 * @property int $model_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Storage $storage
 * @property \App\Model\Entity\Model $model
 */
class ModelStorage extends Entity
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
        'storage_id' => true,
        'model_id' => true,
        'created' => true,
        'modified' => true,
        'storage' => true,
        'model' => true
    ];
}
