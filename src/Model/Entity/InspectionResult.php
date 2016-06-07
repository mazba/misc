<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InspectionResult Entity.
 *
 * @property int $id
 * @property int $office_id
 * @property \App\Model\Entity\Office $office
 * @property int $application_id
 * @property \App\Model\Entity\Application $application
 * @property int $inspection_id
 * @property \App\Model\Entity\Inspection $inspection
 * @property int $actual_inspection_date
 * @property string $inspection_summary
 * @property int $have_file
 * @property int $create_by
 * @property int $create_time
 * @property int $update_by
 * @property int $update_time
 * @property \App\Model\Entity\InspectionResultFile[] $inspection_result_files
 */
class InspectionResult extends Entity
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
