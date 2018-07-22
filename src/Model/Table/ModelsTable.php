<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Models Model
 *
 * @property \App\Model\Table\ManufacturersTable|\Cake\ORM\Association\BelongsTo $Manufacturers
 * @property \App\Model\Table\ModelColoursTable|\Cake\ORM\Association\HasMany $ModelColours
 * @property \App\Model\Table\ModelStoragesTable|\Cake\ORM\Association\HasMany $ModelStorages
 * @property \App\Model\Table\PhonesTable|\Cake\ORM\Association\HasMany $Phones
 *
 * @method \App\Model\Entity\Model get($primaryKey, $options = [])
 * @method \App\Model\Entity\Model newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Model[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Model|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Model patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Model[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Model findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ModelsTable extends Table
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

        $this->setTable('models');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Manufacturers', [
            'foreignKey' => 'manufacturer_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ModelColours', [
            'foreignKey' => 'model_id'
        ]);
        $this->hasMany('ModelStorages', [
            'foreignKey' => 'model_id'
        ]);
        $this->hasMany('Phones', [
            'foreignKey' => 'model_id'
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('model_code')
            ->maxLength('model_code', 255)
            ->allowEmpty('model_code');

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
        $rules->add($rules->existsIn(['manufacturer_id'], 'Manufacturers'));

        return $rules;
    }
}
