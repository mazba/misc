<?php
namespace App\Model\Table;

use App\Model\Entity\Inspection;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inspections Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Appications
 * @property \Cake\ORM\Association\BelongsTo $Offices
 * @property \Cake\ORM\Association\HasMany $InspectionResults
 */
class InspectionsTable extends Table
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

        $this->table('inspections');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Applications', [
            'foreignKey' => 'application_id'
        ]);
        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id'
        ]);
        $this->hasMany('InspectionResults', [
            'foreignKey' => 'inspection_id',
            'joinType'=>'LEFT'
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
            ->integer('inspection_date')
            ->allowEmpty('inspection_date');

        $validator
            ->integer('status')
            ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['application_id'], 'Applications'));
        $rules->add($rules->existsIn(['office_id'], 'Offices'));
        return $rules;
    }
}
