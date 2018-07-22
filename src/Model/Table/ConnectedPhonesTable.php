<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConnectedPhones Model
 *
 * @property \App\Model\Table\PhonesTable|\Cake\ORM\Association\BelongsTo $Phones
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ConnectedPhone get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConnectedPhone newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConnectedPhone[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConnectedPhone|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConnectedPhone patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConnectedPhone[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConnectedPhone findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConnectedPhonesTable extends Table
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

        $this->setTable('connected_phones');
        $this->setDisplayField('udid');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Phones', [
            'foreignKey' => 'phone_id'
        ]);


        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->scalar('status')
            ->maxLength('status', 255)
            ->allowEmpty('status');

        $validator
            ->scalar('udid')
            ->maxLength('udid', 255)
            ->allowEmpty('udid');

        $validator
            ->scalar('isLocked')
            ->maxLength('isLocked', 255)
            ->allowEmpty('isLocked');

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
        $rules->add($rules->existsIn(['phone_id'], 'Phones'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
