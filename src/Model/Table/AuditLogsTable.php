<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AuditLogs Model
 *
 * @method \App\Model\Entity\AuditLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\AuditLog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AuditLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AuditLog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AuditLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AuditLog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AuditLog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AuditLogsTable extends Table
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

        $this->setTable('audit_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

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
            ->uuid('transaction')
            ->requirePresence('transaction', 'create')
            ->notEmpty('transaction');

        $validator
            ->scalar('type')
            ->maxLength('type', 7)
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('primary_key')
            ->allowEmpty('primary_key');

        $validator
            ->scalar('source')
            ->maxLength('source', 255)
            ->requirePresence('source', 'create')
            ->notEmpty('source');

        $validator
            ->scalar('parent_source')
            ->maxLength('parent_source', 255)
            ->allowEmpty('parent_source');

        $validator
            ->scalar('original')
            ->maxLength('original', 16777215)
            ->allowEmpty('original');

        $validator
            ->scalar('changed')
            ->maxLength('changed', 16777215)
            ->allowEmpty('changed');

        $validator
            ->scalar('meta')
            ->maxLength('meta', 16777215)
            ->allowEmpty('meta');

        return $validator;
    }
}
