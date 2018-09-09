<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AuditLog Entity
 *
 * @property int $id
 * @property string $transaction
 * @property string $type
 * @property int $primary_key
 * @property string $source
 * @property string $parent_source
 * @property string $original
 * @property string $changed
 * @property string $meta
 * @property \Cake\I18n\FrozenTime $created
 */
class AuditLog extends Entity
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
        'transaction' => true,
        'type' => true,
        'primary_key' => true,
        'source' => true,
        'parent_source' => true,
        'original' => true,
        'changed' => true,
        'meta' => true,
        'created' => true
    ];
}
