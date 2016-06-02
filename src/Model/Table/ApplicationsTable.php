<?php
namespace App\Model\Table;

use App\Model\Entity\Application;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentApplications
 * @property \Cake\ORM\Association\BelongsTo $Offices
 * @property \Cake\ORM\Association\BelongsTo $Divisions
 * @property \Cake\ORM\Association\BelongsTo $Districts
 * @property \Cake\ORM\Association\BelongsTo $Upazilas
 * @property \Cake\ORM\Association\BelongsTo $Moujas
 * @property \Cake\ORM\Association\HasMany $ApplicationFiles
 * @property \Cake\ORM\Association\HasMany $ChildApplications
 * @property \Cake\ORM\Association\HasMany $Hearings
 * @property \Cake\ORM\Association\HasMany $InspectionResultFiles
 * @property \Cake\ORM\Association\HasMany $InspectionResults
 * @property \Cake\ORM\Association\HasMany $Parties
 * @property \Cake\ORM\Association\HasMany $Payments
 */
class ApplicationsTable extends Table
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

        $this->table('applications');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('ParentApplications', [
            'className' => 'Applications',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Upazilas', [
            'foreignKey' => 'upazila_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Moujas', [
            'foreignKey' => 'mouja_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ApplicationFiles', [
            'foreignKey' => 'application_id'
        ]);
        $this->hasMany('ChildApplications', [
            'className' => 'Applications',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Hearings', [
            'foreignKey' => 'application_id'
        ]);
        $this->hasMany('InspectionResultFiles', [
            'foreignKey' => 'application_id'
        ]);
        $this->hasMany('InspectionResults', [
            'foreignKey' => 'application_id'
        ]);
        $this->hasMany('Appellants', [
            'className'=>'Parties',
            'foreignKey' => 'application_id',
            'conditions' => ['type' => 1],
        ]);
        $this->hasMany('Defendants', [
            'className'=>'Parties',
            'foreignKey' => 'application_id',
            'conditions' => ['type' => 2],
        ]);
        $this->hasMany('Lawyers', [
            'className'=>'Lawyers',
            'foreignKey' => 'application_id'
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'application_id'
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
            ->requirePresence('khatian_number', 'create')
            ->notEmpty('khatian_number');

        $validator
            ->allowEmpty('case_number');

        $validator
            ->integer('case_create_time')
            ->requirePresence('case_create_time', 'create')
            ->notEmpty('case_create_time');

        $validator
            ->integer('case_receive_time')
            ->allowEmpty('case_receive_time');

        $validator
            ->integer('case_receive_by')
            ->allowEmpty('case_receive_by');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->integer('create_time')
            ->requirePresence('create_time', 'create')
            ->notEmpty('create_time');

        $validator
            ->integer('create_by')
            ->requirePresence('create_by', 'create')
            ->notEmpty('create_by');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentApplications'));
        $rules->add($rules->existsIn(['office_id'], 'Offices'));
        $rules->add($rules->existsIn(['division_id'], 'Divisions'));
        $rules->add($rules->existsIn(['district_id'], 'Districts'));
        $rules->add($rules->existsIn(['upazila_id'], 'Upazilas'));
        $rules->add($rules->existsIn(['mouja_id'], 'Moujas'));
        return $rules;
    }
}
