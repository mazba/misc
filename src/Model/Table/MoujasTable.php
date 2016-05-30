<?php
namespace App\Model\Table;

use App\Model\Entity\Mouja;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Moujas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $UpazilaLisas
 * @property \Cake\ORM\Association\BelongsTo $Upazilas
 * @property \Cake\ORM\Association\BelongsTo $Districts
 * @property \Cake\ORM\Association\BelongsTo $Divisions
 * @property \Cake\ORM\Association\HasMany $Applications
 */
class MoujasTable extends Table
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

        $this->table('moujas');
        $this->displayField('name_bd');
        $this->primaryKey('id');

        $this->belongsTo('UpazilaLisas', [
            'foreignKey' => 'upazila_lisa_id'
        ]);
        $this->belongsTo('Upazilas', [
            'foreignKey' => 'upazila_id'
        ]);
        $this->belongsTo('Districts', [
            'foreignKey' => 'district_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id'
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'mouja_id'
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
            ->notEmpty('dglr_code');

        $validator
            ->allowEmpty('upazila_bbs_code');

        $validator
            ->requirePresence('district_bbs_code', 'create')
            ->notEmpty('district_bbs_code');

        $validator
            ->requirePresence('division_bbs_code', 'create')
            ->notEmpty('division_bbs_code');

        $validator
            ->allowEmpty('division_name');

        $validator
            ->requirePresence('name_bd', 'create')
            ->notEmpty('name_bd');

        $validator
            ->requirePresence('upazila_name', 'create')
            ->notEmpty('upazila_name');

        $validator
            ->requirePresence('district_name', 'create')
            ->notEmpty('district_name');

        $validator
            ->allowEmpty('rsnum');

        $validator
            ->allowEmpty('kht_type');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('PrePosi');

        $validator
            ->integer('TotPltInd')
            ->allowEmpty('TotPltInd');

        $validator
            ->integer('TotBkhat')
            ->allowEmpty('TotBkhat');

        $validator
            ->integer('TotCKhat')
            ->allowEmpty('TotCKhat');

        $validator
            ->integer('TotKhat')
            ->allowEmpty('TotKhat');

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
        $rules->add($rules->existsIn(['upazila_lisa_id'], 'UpazilaLisas'));
        $rules->add($rules->existsIn(['upazila_id'], 'Upazilas'));
        $rules->add($rules->existsIn(['district_id'], 'Districts'));
        $rules->add($rules->existsIn(['division_id'], 'Divisions'));
        return $rules;
    }
}
