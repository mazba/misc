<?php
namespace App\Model\Table;

use App\Model\Entity\InspectionResult;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InspectionResults Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Offices
 * @property \Cake\ORM\Association\BelongsTo $Applications
 * @property \Cake\ORM\Association\BelongsTo $Inspections
 * @property \Cake\ORM\Association\HasMany $InspectionResultFiles
 */
class InspectionResultsTable extends Table
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

        $this->table('inspection_results');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Applications', [
            'foreignKey' => 'application_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Inspections', [
            'foreignKey' => 'inspection_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('InspectionResultFiles', [
            'foreignKey' => 'inspection_result_id'
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
            ->integer('actual_inspection_date')
            ->requirePresence('actual_inspection_date', 'create')
            ->notEmpty('actual_inspection_date');

        $validator
            ->requirePresence('inspection_summary', 'create')
            ->notEmpty('inspection_summary');

        $validator
            ->integer('have_file')
            ->allowEmpty('have_file');

        $validator
            ->integer('create_by')
            ->allowEmpty('create_by');

        $validator
            ->integer('create_time')
            ->allowEmpty('create_time');

        $validator
            ->integer('update_by')
            ->allowEmpty('update_by');

        $validator
            ->integer('update_time')
            ->allowEmpty('update_time');

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
        $rules->add($rules->existsIn(['office_id'], 'Offices'));
        $rules->add($rules->existsIn(['application_id'], 'Applications'));
        $rules->add($rules->existsIn(['inspection_id'], 'Inspections'));
        return $rules;
    }
}
