<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SupplierOrders Model
 *
 * @property \App\Model\Table\SuppliersTable|\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \App\Model\Table\PhonesTable|\Cake\ORM\Association\HasMany $Phones
 *
 * @method \App\Model\Entity\SupplierOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\SupplierOrder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SupplierOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SupplierOrder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SupplierOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SupplierOrder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SupplierOrder findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SupplierOrdersTable extends Table
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

        $this->setTable('supplier_orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id'
        ]);
        $this->hasMany('Phones', [
            'foreignKey' => 'supplier_order_id'
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
            ->scalar('invoice_number')
            ->maxLength('invoice_number', 255)
            ->allowEmpty('invoice_number');

        $validator
            ->dateTime('invoice_date')
            ->allowEmpty('invoice_date');

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
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));

        return $rules;
    }
}
