<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Offices
 * @property \Cake\ORM\Association\BelongsTo $Designations
 * @property \Cake\ORM\Association\BelongsTo $UserGroups
 * @property \Cake\ORM\Association\HasMany $UserBasics
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('full_name_bn');
        $this->primaryKey('id');

        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id'
        ]);
        $this->belongsTo('Upazilas', [
            'foreignKey' => 'upazila_id'
        ]);
        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Designations', [
            'foreignKey' => 'designation_id'
        ]);
        $this->belongsTo('UserGroups', [
            'foreignKey' => 'user_group_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('UserBasics', [
            'foreignKey' => 'user_id'
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'picture'=> [
                'path' => 'webroot{DS}files{DS}Users{DS}{field}{DS}',
                'nameCallback'=>function($data,$settings){
                   return isset($data['name']) && $data['name'] ? time().'_'.md5($data['name']).'.'.substr($data['name'], strrpos($data['name'], '.') + 1):'';
                }
            ]

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
//        $validator->provider('upload', \Josegonzalez\Upload\Validation\ImageValidation::class);
        $validator->allowEmpty('picture','update')
            ->add('picture', 'file', ['rule' => ['extension',array('jpeg','jpg','png','gif')],'message' => 'File type is Not valid!']);
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('full_name_bn', 'create')
            ->notEmpty('full_name_bn');

        $validator
            ->requirePresence('full_name_en', 'create')
            ->notEmpty('full_name_en');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->allowEmpty('picture_alt');

        $validator
            ->allowEmpty('picture');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->integer('create_by')
            ->allowEmpty('create_by');

        $validator
            ->integer('create_date')
            ->allowEmpty('create_date');

        $validator
            ->integer('update_by')
            ->allowEmpty('update_by');

        $validator
            ->integer('update_date')
            ->allowEmpty('update_date');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['office_id'], 'Offices'));
        $rules->add($rules->existsIn(['designation_id'], 'Designations'));
        $rules->add($rules->existsIn(['user_group_id'], 'UserGroups'));
        return $rules;
    }
}
