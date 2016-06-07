<?php
namespace App\Model\Table;

use App\Model\Entity\ApplicationFile;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicationFiles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Applications
 */
class ApplicationFilesTable extends Table
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

        $this->table('application_files');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Applications', [
            'foreignKey' => 'application_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'file_location'=> [
                'path' => 'webroot{DS}files{DS}ApplicationFiles{DS}',
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
        $validator->allowEmpty('file_location','update')
            ->add('file_location', 'file', ['rule' => ['extension',array('jpeg','jpg','png','gif')],'message' => 'File type is Not valid!']);

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('type')
            ->allowEmpty('type');

        $validator
            ->allowEmpty('title');

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
        return $rules;
    }
}
