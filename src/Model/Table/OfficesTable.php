<?php
namespace App\Model\Table;

use App\Model\Entity\Office;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Offices Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentOffices
 * @property \Cake\ORM\Association\BelongsTo $Divisions
 * @property \Cake\ORM\Association\BelongsTo $Districts
 * @property \Cake\ORM\Association\BelongsTo $Upazilas
 * @property \Cake\ORM\Association\HasMany $Applications
 * @property \Cake\ORM\Association\HasMany $Designations
 * @property \Cake\ORM\Association\HasMany $Inspections
 * @property \Cake\ORM\Association\HasMany $ChildOffices
 * @property \Cake\ORM\Association\HasMany $Users
 */
class OfficesTable extends Table
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

        $this->table('offices');
        $this->displayField('name_bn');
        $this->primaryKey('id');

        $this->belongsTo('ParentOffices', [
            'className' => 'Offices',
            'foreignKey' => 'parent_id'
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
            'foreignKey' => 'upazila_id'
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'office_id'
        ]);
        $this->hasMany('Designations', [
            'foreignKey' => 'office_id'
        ]);
        $this->hasMany('Inspections', [
            'foreignKey' => 'office_id'
        ]);
        $this->hasMany('ChildOffices', [
            'className' => 'Offices',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'office_id'
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
            ->allowEmpty('code');

        $validator
            ->requirePresence('name_bn', 'create')
            ->notEmpty('name_bn');

        $validator
            ->requirePresence('name_en', 'create')
            ->notEmpty('name_en');

        $validator
            ->allowEmpty('phone');

        $validator
            ->allowEmpty('mobile');

        $validator
            ->allowEmpty('fax');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('web_url');

        $validator
            ->allowEmpty('address');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->integer('create_time')
            ->allowEmpty('create_time');

        $validator
            ->integer('update_time')
            ->allowEmpty('update_time');

        $validator
            ->integer('create_by')
            ->allowEmpty('create_by');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentOffices'));
        $rules->add($rules->existsIn(['division_id'], 'Divisions'));
        $rules->add($rules->existsIn(['district_id'], 'Districts'));
        $rules->add($rules->existsIn(['upazila_id'], 'Upazilas'));
        return $rules;
    }
}
