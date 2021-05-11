<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemReturnsTypeStatus Model
 *
 * @property \App\Model\Table\ItemReturnsTypesTable|\Cake\ORM\Association\BelongsTo $ItemReturnsTypes
 * @property \App\Model\Table\ItemReturnsTable|\Cake\ORM\Association\HasMany $ItemReturns
 *
 * @method \App\Model\Entity\ItemReturnsTypeStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemReturnsTypeStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemReturnsTypeStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemReturnsTypeStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemReturnsTypeStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemReturnsTypeStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemReturnsTypeStatus findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemReturnsTypeStatusTable extends Table
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

        $this->setTable('item_returns_type_status');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ItemReturnsTypes');
        $this->hasMany('ItemReturns');
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['item_returns_type_id'], 'ItemReturnsTypes'));

        return $rules;
    }
}
