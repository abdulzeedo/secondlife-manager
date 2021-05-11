<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemReturnsTypes Model
 *
 * @method \App\Model\Entity\ItemReturnsType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemReturnsType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemReturnsType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemReturnsType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemReturnsType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemReturnsType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemReturnsType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemReturnsTypesTable extends Table
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

        $this->setTable('item_returns_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ItemReturns');
        $this->hasMany('ItemReturnsTypeStatus');


        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmpty('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmpty('description');

        return $validator;
    }
}
