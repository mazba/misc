<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Upazila Entity.
 *
 * @property int $id
 * @property string $dglr_code
 * @property string $upazila_id
 * @property string $upazila_bbs_code
 * @property string $district_id
 * @property \App\Model\Entity\District $district
 * @property string $district_bbs_code
 * @property int $division_id
 * @property \App\Model\Entity\Division $division
 * @property string $division_bbs_code
 * @property string $name_bd
 * @property string $name_en
 * @property string $district_name
 * @property int $status
 * @property \App\Model\Entity\Upazila[] $upazilas
 * @property \App\Model\Entity\Mouja[] $moujas
 * @property \App\Model\Entity\Office[] $offices
 */
class Upazila extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
