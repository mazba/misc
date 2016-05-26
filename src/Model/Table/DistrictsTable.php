<?php
namespace App\Model\Table;

use App\Model\Entity\District;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Districts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Divisions
 * @property \Cake\ORM\Association\HasMany $Moujas
 * @property \Cake\ORM\Association\HasMany $Offices
 * @property \Cake\ORM\Association\HasMany $Upazilas
 */
class DistrictsTable extends Table
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

        $this->table('districts');
        $this->displayField('name_bn');
        $this->primaryKey('id');

        $this->belongsTo('Divisions', [
            'foreignKey' => 'division_id'
        ]);
        $this->hasMany('Moujas', [
            'foreignKey' => 'district_id'
        ]);
        $this->hasMany('Offices', [
            'foreignKey' => 'district_id'
        ]);
        $this->hasMany('Upazilas', [
            'foreignKey' => 'district_id'
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
            ->allowEmpty('district_bbs_code');

        $validator
            ->allowEmpty('division_bbs_code');

        $validator
            ->requirePresence('dglr_code', 'create')
            ->notEmpty('dglr_code');

        $validator
            ->allowEmpty('name_bn');

        $validator
            ->allowEmpty('name_en');

        $validator
            ->allowEmpty('RSNum');

        $validator
            ->integer('KhtType')
            ->allowEmpty('KhtType');

        $validator
            ->allowEmpty('AreaType');

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
        $rules->add($rules->existsIn(['division_id'], 'Divisions'));
        return $rules;
    }
}
