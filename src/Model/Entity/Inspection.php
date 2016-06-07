<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inspection Entity.
 *
 * @property int $id
 * @property int $application_id
 * @property \App\Model\Entity\Appication $appication
 * @property int $office_id
 * @property \App\Model\Entity\Office $office
 * @property int $inspection_date
 * @property int $status
 * @property int $create_by
 * @property int $create_time
 * @property int $update_by
 * @property int $update_time
 * @property \App\Model\Entity\InspectionResult[] $inspection_results
 */
class Inspection extends Entity
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
    protected function _getFormattedInspectionDate()
    {
        return $this->inspection_date ? date('d-m-Y',$this->inspection_date).' <i class="fa fa-clock-o "></i>      '.date('h:i:s A',$this->inspection_date) : '';
    }
}
