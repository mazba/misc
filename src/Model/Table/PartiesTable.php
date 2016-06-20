<?php
namespace App\Model\Table;

use App\Model\Entity\Party;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parties Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Applications
 */
class PartiesTable extends Table
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

        $this->table('parties');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Applications', [
            'foreignKey' => 'application_id',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('father_name', 'create')
            ->notEmpty('father_name');

        $validator
            ->allowEmpty('mother_name');

        $validator
            ->requirePresence('village', 'create')
            ->notEmpty('village');

        $validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->allowEmpty('phone');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->integer('type')
            ->allowEmpty('type');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->integer('create_time')
            ->allowEmpty('create_time');

        $validator
            ->integer('create_by')
            ->allowEmpty('create_by');

        $validator
            ->integer('update_time')
            ->allowEmpty('update_time');

        $validator
            ->integer('update_by')
            ->allowEmpty('update_by');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['application_id'], 'Applications'));
        return $rules;
    }
}
