<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
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
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ConnectedPhones', [
            'foreignKey' => 'phone_id'
        ]);

        $this->hasMany('ItemReturns', [
            'foreignKey' => 'item_id',
            'propertyName' => 'phones',
        ]);
        $this->hasMany('exchanged_with_item', [
            'className' => 'ItemReturns',
            'foreignKey' => 'exchanged_with_item_id',
            'propertyName' => 'exchanged_with_item'
        ]);

        $this->hasMany('PhoneRecords', [
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
        $this->addBehavior('AuditStash.AuditLog');
        // Setup search filter using search manager
        $this->searchManager()
            ->value('storage_id', ['multiValue' => true])
            ->value('model_id', ['multiValue' => true])
            ->value('grade')
            ->value('colour_id', ['multiValue' => true])
            ->value('user_id', ['multiValue' => true])
            ->value('supplier_order_id', ['multiValue' => true])
            ->value('icloud_status')
            ->value('touch_id_status')
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
            ])
            ->add('supplier_id', 'Search.Callback', [
                'callback' => function (Query $query, $args, $filter) {
                    $query
                        ->where(['Suppliers.id IN' => $args['supplier_id']]);
                }
            ])
            ->add('is_phone_available', 'Search.Callback', [
                'callback' => function(Query $query, $args, $filter) {
                    $phones = TableRegistry::get('Phones');
                    $query->find('availablePhones', ['available' => true]);
                }
            ])
            ->add('customer_id', 'Search.Callback', [
                'callback' => function (Query $query, $args, $filter) {
                    $query
                        ->innerJoinWith('Customers', function ($q) use ($args) {
                            return $q->where(['Customers.id IN' => $args['customer_id']]);
                        });
                }
            ])
            ->add('Repairs.status', 'Search.Callback', [
                'callback' => function (Query $query, $args, $filter) {
                    // If not any
                    if (!in_array("any", $args['Repairs.status'])) {
                        $query
                            ->innerJoinWith('Repairs', function ($q) use ($args) {
                                return $q->where(['Repairs.status IN' => $args['Repairs.status']]);
                        });
                    }
                    else {
                        $query->innerJoinWith('Repairs');
                    }
                }
            ])
            ->add('Repairs.reason', 'Search.Callback', [
                'callback' => function (Query $query, $args, $filter) {
                    $query
                        ->innerJoinWith('Repairs', function ($q) use ($args) {
                            return $q->where(['Repairs.reason IN' => $args['Repairs.reason']]);
                        });
                }
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

    public function findAvailablePhones(Query $query, array $options) {
        if ($options["available"])
            $available = $options["available"];
        else
            $available = true;
        $array= [];
        $phones = $this->find()->enableAutoFields(true)->all();
        foreach ($phones as $phone)
            if ($phone->is_phone_available)
                $array[] = $phone->id;
        if ($available)
            $query
                ->where(['Phones.id IN' => $array]);
        else
            $query
                ->where(['Phones.id NOT IN' => $array]);

        return $query;
    }
}
