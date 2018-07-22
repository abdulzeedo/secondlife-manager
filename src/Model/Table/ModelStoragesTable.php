<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ModelStorages Model
 *
 * @property \App\Model\Table\StoragesTable|\Cake\ORM\Association\BelongsTo $Storages
 * @property \App\Model\Table\ModelsTable|\Cake\ORM\Association\BelongsTo $Models
 *
 * @method \App\Model\Entity\ModelStorage get($primaryKey, $options = [])
 * @method \App\Model\Entity\ModelStorage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ModelStorage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ModelStorage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ModelStorage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ModelStorage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ModelStorage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ModelStoragesTable extends Table
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

        $this->setTable('model_storages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Storages', [
            'foreignKey' => 'storage_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Models', [
            'foreignKey' => 'model_id',
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
        $rules->add($rules->existsIn(['storage_id'], 'Storages'));
        $rules->add($rules->existsIn(['model_id'], 'Models'));

        return $rules;
    }
}
