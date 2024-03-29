<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Repair Entity
 *
 * @property int $id
 * @property string $reason
 * @property string $status
 * @property string $comments
 * @property int $item_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Phone $phone
 */
class Repair extends Entity
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
        'reason' => true,
        'status' => true,
        'comments' => true,
        'item_id' => true,
        'created' => true,
        'label' => true,
        'modified' => true,
        'phone' => true
    ];

    protected function _getLabel()
    {

        return $this->id . ': Reason (' . $this->reason . ') ' . $this->status . ' '
                . ' Comments: ' . $this->comments;
    }
}
