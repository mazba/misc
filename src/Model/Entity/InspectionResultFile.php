<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InspectionResultFile Entity.
 *
 * @property int $id
 * @property string $file_label
 * @property int $application_id
 * @property \App\Model\Entity\Application $application
 * @property int $inspection_result_id
 * @property \App\Model\Entity\InspectionResult $inspection_result
 * @property string $file_location
 */
class InspectionResultFile extends Entity
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
