<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemReturns Model
 *
 * @property \App\Model\Table\PhonesTable|\Cake\ORM\Association\BelongsTo $Phones
 *
 * @method \App\Model\Entity\ItemReturn get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemReturn newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemReturn[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemReturn|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemReturn patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemReturn[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemReturn findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemReturnsTable extends Table
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

        $this->setTable('item_returns');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Phones', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
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
            ->scalar('reason')
            ->maxLength('reason', 255)
            ->requirePresence('reason', 'create')
            ->notEmpty('reason');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->scalar('refund')
            ->maxLength('refund', 255)
            ->requirePresence('refund', 'create')
            ->notEmpty('refund');

        $validator
            ->scalar('comments')
            ->allowEmpty('comments');

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
        $rules->add($rules->existsIn(['item_id'], 'Phones'));

        return $rules;
    }
}
