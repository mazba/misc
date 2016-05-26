<?php
namespace App\Model\Table;

use App\Model\Entity\Upazila;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Upazilas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Upazilas
 * @property \Cake\ORM\Association\BelongsTo $Districts
 * @property \Cake\ORM\Association\BelongsTo $Divisions
 * @property \Cake\ORM\Association\HasMany $Moujas
 * @property \Cake\ORM\Association\HasMany $Offices
 */
class UpazilasTable extends Table
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

        $this->table('upazilas');
        $this->displayField('name_bd');
        $this->primaryKey('id');

        $this->belongsTo('Upazilas', [
            'foreignKey' => 'upazila_id'
        ]);
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Moujas', [
            'foreignKey' => 'upazila_id'
        ]);
        $this->hasMany('Offices', [
            'foreignKey' => 'upazila_id'
        ]);
        $this->hasMany('Upazilas', [
            'foreignKey' => 'upazila_id'
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
            ->requirePresence('dglr_code', 'create')
            ->notEmpty('dglr_code')
            ->add('dglr_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('upazila_bbs_code');

        $validator
            ->requirePresence('district_bbs_code', 'create')
            ->notEmpty('district_bbs_code');

        $validator
            ->requirePresence('division_bbs_code', 'create')
            ->notEmpty('division_bbs_code');

        $validator
            ->requirePresence('name_bd', 'create')
            ->notEmpty('name_bd');

        $validator
            ->allowEmpty('name_en');

        $validator
            ->requirePresence('district_name', 'create')
            ->notEmpty('district_name');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->isUnique(['dglr_code']));
        $rules->add($rules->existsIn(['upazila_id'], 'Upazilas'));
        $rules->add($rules->existsIn(['district_id'], 'Districts'));
        $rules->add($rules->existsIn(['division_id'], 'Divisions'));
        return $rules;
    }
}
