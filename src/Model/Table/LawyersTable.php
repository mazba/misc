<?php
namespace App\Model\Table;

use App\Model\Entity\Lawyer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lawyers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Applications
 */
class LawyersTable extends Table
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

        $this->table('lawyers');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Applications', [
            'foreignKey' => 'application_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'okalotnama_file'=> [
                'path' => 'webroot{DS}files{DS}LawyersFile{DS}',
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
        $validator->allowEmpty('okalotnama_file','update')
            ->add('okalotnama_file', 'file', ['rule' => ['extension',array('jpeg','jpg','png','gif')],'message' => 'File type is Not valid!']);

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('party_type')
            ->requirePresence('party_type', 'create')
            ->notEmpty('party_type');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->allowEmpty('phone');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('address');

        $validator
            ->requirePresence('okalotnama_file', 'create')
            ->notEmpty('okalotnama_file');

        $validator
            ->integer('create_by')
            ->allowEmpty('create_by');

        $validator
            ->integer('update_by')
            ->allowEmpty('update_by');

        $validator
            ->integer('create_time')
            ->allowEmpty('create_time');

        $validator
            ->integer('update_time')
            ->allowEmpty('update_time');

        $validator
            ->integer('status')
            ->allowEmpty('status');

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
      //  $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['application_id'], 'Applications'));
        return $rules;
    }
}
