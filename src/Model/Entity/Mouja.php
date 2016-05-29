<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mouja Entity.
 *
 * @property int $id
 * @property string $dglr_code
 * @property int $upazila_lisa_id
 * @property \App\Model\Entity\UpazilaLisa $upazila_lisa
 * @property int $upazila_id
 * @property \App\Model\Entity\Upazila $upazila
 * @property string $upazila_bbs_code
 * @property string $district_id
 * @property \App\Model\Entity\District $district
 * @property string $district_bbs_code
 * @property string $division_bbs_code
 * @property int $division_id
 * @property \App\Model\Entity\Division $division
 * @property string $division_name
 * @property string $name_bd
 * @property string $upazila_name
 * @property string $district_name
 * @property string $rsnum
 * @property string $kht_type
 * @property int $status
 * @property string $PrePosi
 * @property int $TotPltInd
 * @property int $TotBkhat
 * @property int $TotCKhat
 * @property int $TotKhat
 * @property \App\Model\Entity\Application[] $applications
 */
class Mouja extends Entity
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
