<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @property \App\Model\Table\TransactionsTable|\Cake\ORM\Association\HasMany $Transactions
 *
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
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

        $this->setTable('customers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Transactions', [
            'foreignKey' => 'customer_id'
        ]);
        $this->belongsToMany('Phones', [
            'through' => 'Transactions',
            'foreignKey' => 'customer_id',
            'targetForeignKey' => 'item_id',
            'saveStrategy' => 'append'
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
            ->allowEmpty('name');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->scalar('location')
            ->maxLength('location', 255)
            ->allowEmpty('location');


        return $validator;
    }
    public function buildRules(RulesChecker $rules)
    {
        $returns = TableRegistry::get('ItemReturns');
        $transactions = TableRegistry::get('Transactions');
        $ids = [];
        $rules->add(function($entity, $options) use ($returns, $transactions) {
            /** @var \App\Model\Entity\Phone $phone */
            $flag = false;
            foreach($entity->phones as $phone) {
                // Get returns count for the current item
                $returnsCount = $returns->find('all')
                    ->where(['item_id' => $phone->id])->count();
                // Get transactions count for the current item
                $transactionsCount = $transactions->find('all')
                    ->where(['item_id' => $phone->id])->count();
                if (!($transactionsCount <= $returnsCount)) {
                    $flag = true;
                    $error = [
                        "id" => $phone->id,
                        "message" => "The phone has already been set as sold. Add a return or edit it from its view/edit page. Or simply delete it."
                    ];
                    $phone->setError('phone',
                          $error);
                }
            }
            if ($flag)
                return false;
            return true;

        }, 'id',
            [
                'errorField' => 'phones',
                'message' => 'This item has already been sold and no returns have been added.'
                    .'Add a return first to set it as sold again.'
            ]);
        return $rules;
    }
}
