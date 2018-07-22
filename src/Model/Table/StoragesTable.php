<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Storages Model
 *
 * @property \App\Model\Table\ModelStoragesTable|\Cake\ORM\Association\HasMany $ModelStorages
 * @property \App\Model\Table\PhonesTable|\Cake\ORM\Association\HasMany $Phones
 *
 * @method \App\Model\Entity\Storage get($primaryKey, $options = [])
 * @method \App\Model\Entity\Storage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Storage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Storage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Storage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Storage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Storage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StoragesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('storages');
        $this->setDisplayField('storage');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ModelStorages', [
            'foreignKey' => 'storage_id'
        ]);
        $this->hasMany('Phones', [
            'foreignKey' => 'storage_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('storage')
            ->maxLength('storage', 255)
            ->requirePresence('storage', 'create')
            ->notEmpty('storage');

        return $validator;
    }
}
