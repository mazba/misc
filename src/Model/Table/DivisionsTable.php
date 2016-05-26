<?php
namespace App\Model\Table;

use App\Model\Entity\Division;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Divisions Model
 *
 * @property \Cake\ORM\Association\HasMany $Districts
 * @property \Cake\ORM\Association\HasMany $Moujas
 * @property \Cake\ORM\Association\HasMany $Offices
 * @property \Cake\ORM\Association\HasMany $Upazilas
 */
class DivisionsTable extends Table
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

        $this->table('divisions');
        $this->displayField('name_bn');
        $this->primaryKey('id');

        $this->hasMany('Districts', [
            'foreignKey' => 'division_id'
        ]);
        $this->hasMany('Moujas', [
            'foreignKey' => 'division_id'
        ]);
        $this->hasMany('Offices', [
            'foreignKey' => 'division_id'
        ]);
        $this->hasMany('Upazilas', [
            'foreignKey' => 'division_id'
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
            ->requirePresence('division_bbs_code', 'create')
            ->notEmpty('division_bbs_code');

        $validator
            ->requirePresence('dglr_code', 'create')
            ->notEmpty('dglr_code');

        $validator
            ->allowEmpty('name_bn');

        $validator
            ->requirePresence('name_en', 'create')
            ->notEmpty('name_en');

        $validator
            ->allowEmpty('RSNum');

        $validator
            ->integer('KhtType')
            ->allowEmpty('KhtType');

        $validator
            ->allowEmpty('AreaType');

        return $validator;
    }
}
