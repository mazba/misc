<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Application Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \App\Model\Entity\Application $parent_application
 * @property int $office_id
 * @property \App\Model\Entity\Office $office
 * @property int $division_id
 * @property \App\Model\Entity\Division $division
 * @property int $district_id
 * @property \App\Model\Entity\District $district
 * @property int $upazila_id
 * @property \App\Model\Entity\Upazila $upazila
 * @property int $mouja_id
 * @property \App\Model\Entity\Mouja $mouja
 * @property string $khatian_number
 * @property string $case_number
 * @property int $case_create_time
 * @property int $case_receive_time
 * @property int $case_receive_by
 * @property int $status
 * @property int $create_time
 * @property int $create_by
 * @property int $update_time
 * @property int $update_by
 * @property \App\Model\Entity\ApplicationFile[] $application_files
 * @property \App\Model\Entity\Application[] $child_applications
 * @property \App\Model\Entity\InspectionResultFile[] $inspection_result_files
 * @property \App\Model\Entity\InspectionResult[] $inspection_results
 * @property \App\Model\Entity\Payment[] $payments
 */
class Application extends Entity
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
