<?php
namespace App\Model\Table;

use App\Model\Entity\InspectionResultFile;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InspectionResultFiles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Applications
 * @property \Cake\ORM\Association\BelongsTo $InspectionResults
 */
class InspectionResultFilesTable extends Table
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

        $this->table('inspection_result_files');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Applications', [
            'foreignKey' => 'application_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('InspectionResults', [
            'foreignKey' => 'inspection_result_id',
            'joinType' => 'INNER'
        ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'file_location'=> [
                'path' => 'webroot{DS}files{DS}InspectionResults{DS}',
                'nameCallback'=>function($data,$settings){
                    return isset($data['name']) && $data['name'] ? time().'_'.$data['name']:'';
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
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('file_label', 'create')
            ->notEmpty('file_label');

        $validator
            ->requirePresence('file_location', 'create')
            ->notEmpty('file_location');

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
        $rules->add($rules->existsIn(['inspection_result_id'], 'InspectionResults'));
        return $rules;
    }
}
