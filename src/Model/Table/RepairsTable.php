<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Repairs Model
 *
 * @property \App\Model\Table\PhonesTable|\Cake\ORM\Association\BelongsTo $Phones
 *
 * @method \App\Model\Entity\Repair get($primaryKey, $options = [])
 * @method \App\Model\Entity\Repair newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Repair[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Repair|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Repair patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Repair[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Repair findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RepairsTable extends Table
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

        $this->setTable('repairs');
        $this->setDisplayField('status');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Phones', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
        ]);
        $this->addBehavior('AuditStash.AuditLog');
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

    /**
     * @param null $key
     * @return array|mixed array with just the field specified in $key or all default field values
     */
    public function getDefaultValues($key = null) {
        $values = [
            'status' => [
                ['value' => 'Repair created', 'text' => 'Repair created'],
                ['value' => 'In repair', 'text' => 'In repair'],
                ['value' => 'Repaired', 'text' => 'Repaired', 'data-subtext' => 'Inspection phase'],
                ['value' => 'Testing', 'text' => 'Testing', 'data-subtext' => 'Test thoroughly'],
                ['value' => 'Complete', 'text' => 'Complete', 'data-subtext' => 'Great!'],
                ['value' => 'Failed', 'text' => 'Failed', 'data-subtext' => "Don't worry!"
                                                               . "Just write some details below."],
                ['value' => 'Missing component', 'text' => 'Missing component', 'data-subtext' => "Out of Stock Replacement part"]
            ],
            'reason' => [
                ['value' => 'LCD', 'text' => 'LCD'],
                ['value' => 'Battery', 'text' => 'Battery'],
                ['value' => 'Audio', 'text' => 'Audio'],
                ['value' => 'Microphone', 'text' => 'Microphone'],
                ['value' => 'Flash', 'text' => 'Flash'],
                ['value' => 'Back Camera', 'text' => 'Back Camera'],
                ['value' => 'Front Camera', 'text' => 'Front Camera'],
                ['value' => 'Proximity Sensor', 'text' => 'Proximity Sensor'],
                ['value' => 'Home button', 'text' => 'Home Button'],
                ['value' => 'Power button', 'text' => 'Power Button'],
                ['value' => 'Volume buttons', 'text' => 'Volume Buttons'],
                ['value' => 'Charging port', 'text' => 'Charging port'],
                ['value' => 'GSM antenna', 'text' => 'GSM antenna', 'data-subtext' => 'No signal at all, or pat pat issue!'],
                ['value' => 'Other', 'text' => 'Other', 'data-subtext' => 'Wright some details in comments!'],
            ]
        ];
        if ($key)
            return $values[$key];

        return $values;
    }
}
