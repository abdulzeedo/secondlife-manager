<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ModelColour Entity
 *
 * @property int $id
 * @property int $colour_id
 * @property int $model_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Colour $colour
 * @property \App\Model\Entity\Model $model
 */
class ModelColour extends Entity
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
        'colour_id' => true,
        'model_id' => true,
        'created' => true,
        'modified' => true,
        'colour' => true,
        'model' => true
    ];
}
