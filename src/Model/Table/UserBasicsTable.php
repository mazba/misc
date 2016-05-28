<?php
namespace App\Model\Table;

use App\Model\Entity\UserBasic;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserBasics Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class UserBasicsTable extends Table
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

        $this->table('user_basics');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->requirePresence('father_name_bn', 'create')
            ->notEmpty('father_name_bn');

        $validator
            ->allowEmpty('father_name_en');

        $validator
            ->requirePresence('mother_name_bn', 'create')
            ->notEmpty('mother_name_bn');

        $validator
            ->allowEmpty('mother_name_en');

        $validator
            ->allowEmpty('nid');

        $validator
            ->allowEmpty('bin_brn');

        $validator
            ->integer('date_of_birth')
            ->requirePresence('date_of_birth', 'create')
            ->notEmpty('date_of_birth');

        $validator
            ->allowEmpty('place_of_birth');

        $validator
            ->allowEmpty('nationality');

        $validator
            ->integer('is_ethnic')
            ->allowEmpty('is_ethnic');

        $validator
            ->integer('is_disable')
            ->allowEmpty('is_disable');

        $validator
            ->integer('is_married')
            ->allowEmpty('is_married');

        $validator
            ->allowEmpty('spouse_name_bn');

        $validator
            ->allowEmpty('spouse_name_en');

        $validator
            ->integer('gender')
            ->allowEmpty('gender');

        $validator
            ->integer('religion')
            ->allowEmpty('religion');

        $validator
            ->allowEmpty('home_phone');

        $validator
            ->allowEmpty('cell_phone');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('passport_number');

        $validator
            ->allowEmpty('driving_license_number');

        $validator
            ->allowEmpty('tin_number');

        $validator
            ->allowEmpty('present_address');

        $validator
            ->allowEmpty('permanent_address');

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
       // $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
