<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Office Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \App\Model\Entity\ParentOffice $parent_office
 * @property string $code
 * @property string $name_bn
 * @property string $name_en
 * @property string $division_id
 * @property \App\Model\Entity\Division $division
 * @property string $district_id
 * @property \App\Model\Entity\District $district
 * @property int $upazila_id
 * @property \App\Model\Entity\Upazila $upazila
 * @property string $phone
 * @property string $mobile
 * @property string $fax
 * @property string $email
 * @property string $web_url
 * @property string $address
 * @property string $description
 * @property int $status
 * @property int $create_time
 * @property int $update_time
 * @property int $create_by
 * @property int $update_by
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\Designation[] $designations
 * @property \App\Model\Entity\Inspection[] $inspections
 * @property \App\Model\Entity\ChildOffice[] $child_offices
 * @property \App\Model\Entity\User[] $users
 */
class Office extends Entity
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
