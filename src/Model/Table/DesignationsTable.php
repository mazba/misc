<?php
namespace App\Model\Table;

use App\Model\Entity\Designation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Designations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentDesignations
 * @property \Cake\ORM\Association\BelongsTo $Offices
 * @property \Cake\ORM\Association\HasMany $ChildDesignations
 * @property \Cake\ORM\Association\HasMany $Users
 */
class DesignationsTable extends Table
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

        $this->table('designations');
        $this->displayField('name_bn');
        $this->primaryKey('id');

        $this->belongsTo('ParentDesignations', [
            'className' => 'Designations',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ChildDesignations', [
            'className' => 'Designations',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'designation_id'
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
            ->requirePresence('name_en', 'create')
            ->notEmpty('name_en');

        $validator
            ->requirePresence('name_bn', 'create')
            ->notEmpty('name_bn');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->integer('create_by')
            ->requirePresence('create_by', 'create')
            ->notEmpty('create_by');

        $validator
            ->integer('create_date')
            ->requirePresence('create_date', 'create')
            ->notEmpty('create_date');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentDesignations'));
        $rules->add($rules->existsIn(['office_id'], 'Offices'));
        return $rules;
    }
}
