<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Division Entity.
 *
 * @property int $id
 * @property string $division_bbs_code
 * @property string $dglr_code
 * @property string $name_bn
 * @property string $name_en
 * @property string $RSNum
 * @property int $KhtType
 * @property string $AreaType
 * @property \App\Model\Entity\District[] $districts
 * @property \App\Model\Entity\Mouja[] $moujas
 * @property \App\Model\Entity\Office[] $offices
 * @property \App\Model\Entity\Upazila[] $upazilas
 */
class Division extends Entity
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
