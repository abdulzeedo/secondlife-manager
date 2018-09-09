<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Colour Entity
 *
 * @property int $id
 * @property string $colour_name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ModelColour[] $model_colours
 * @property \App\Model\Entity\Phone[] $phones
 */
class Colour extends Entity
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
        'colour_name' => true,
        'created' => true,
        'modified' => true,
        'model_colours' => true,
        'phones' => true
    ];

    protected function _getColourName($colourName) {
        return ucwords($colourName);
    }
}
