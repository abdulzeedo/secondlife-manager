<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Phones Model
 *
 * @property \App\Model\Table\StoragesTable|\Cake\ORM\Association\BelongsTo $Storages
 * @property \App\Model\Table\ModelsTable|\Cake\ORM\Association\BelongsTo $Models
 * @property \App\Model\Table\ColoursTable|\Cake\ORM\Association\BelongsTo $Colours
 *
 * @method \App\Model\Entity\Phone get($primaryKey, $options = [])
 * @method \App\Model\Entity\Phone newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Phone[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Phone|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Phone patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Phone[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Phone findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PhonesTable extends Table
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

        $this->setTable('phones');
        $this->setDisplayField('label');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Storages', [
            'foreignKey' => 'storage_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Models', [
            'foreignKey' => 'model_id'
        ]);
        $this->belongsTo('Colours', [
            'foreignKey' => 'colour_id'
        ]);

        $this->hasMany('Repairs', [
            'foreignKey' => 'item_id'
        ]);

        $this->hasMany('ConnectedPhones', [
            'foreignKey' => 'phone_id'
        ]);

        $this->hasMany('ItemReturns', [
            'foreignKey' => 'item_id'
        ]);

        // Add the behaviour to your table
        $this->addBehavior('Search.Search');


        $this->hasMany('Transactions', [
            'foreignKey' => 'item_id'
        ]);

        $this->belongsToMany('Customers', [
            'through' => 'Transactions',
            'foreignKey' => 'item_id',
            'targetForeignKey' => 'customer_id',
            'saveStrategy' => 'append'
        ]);

        $this->belongsTo('SupplierOrders', [
            'foreignKey' => 'supplier_order_id'
        ]);

        // Setup search filter using search manager
        $this->searchManager()
            ->value('storage_id')
            ->value('model_id')
            ->value('grade')
            ->value('colour_id')
            ->value('user_id')
            // Here we will alias the 'q' query param to search the `Articles.title`
            // field and the `Articles.content` field, using a LIKE match, with `%`
            // both before and after.
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['imiei', 'serial_number']
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
            ->scalar('imiei')
            ->maxLength('imiei', 255)
            ->requirePresence('imiei', 'create')
            ->notEmpty('imiei')
            ->add('imiei', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('serial_number')
            ->maxLength('serial_number', 255)
            ->requirePresence('serial_number', 'create')
            ->notEmpty('serial_number')
            ->add('serial_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('grade')
            ->maxLength('grade', 50)
            ->allowEmpty('grade');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->allowEmpty('status');

        $validator
            ->scalar('comments')
            ->maxLength('comments', 4294967295)
            ->allowEmpty('comments');

        $validator
            ->numeric('battery_health')
            ->allowEmpty('battery_health');

        $validator
            ->scalar('sim_lock_status')
            ->maxLength('sim_lock_status', 50)
            ->allowEmpty('sim_lock_status');

        $validator
            ->integer('battery_cycles')
            ->allowEmpty('battery_cycles');

        $validator
            ->scalar('os_version')
            ->maxLength('os_version', 255)
            ->allowEmpty('os_version');

        $validator
            ->scalar('region_code')
            ->maxLength('region_code', 255)
            ->allowEmpty('region_code');

        $validator
            ->scalar('product_type_specific')
            ->maxLength('product_type_specific', 255)
            ->allowEmpty('product_type_specific');

        $validator
            ->scalar('model_number')
            ->maxLength('model_number', 50)
            ->allowEmpty('model_number');

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
        $rules->add($rules->isUnique(['imiei']));
        $rules->add($rules->isUnique(['serial_number']));
        $rules->add($rules->existsIn(['storage_id'], 'Storages'));
        $rules->add($rules->existsIn(['model_id'], 'Models'));
        $rules->add($rules->existsIn(['colour_id'], 'Colours'));

        return $rules;
    }
}