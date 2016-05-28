<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserBasic Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $father_name_bn
 * @property string $father_name_en
 * @property string $mother_name_bn
 * @property string $mother_name_en
 * @property string $nid
 * @property string $bin_brn
 * @property int $date_of_birth
 * @property string $place_of_birth
 * @property string $nationality
 * @property int $is_ethnic
 * @property int $is_disable
 * @property int $is_married
 * @property string $spouse_name_bn
 * @property string $spouse_name_en
 * @property int $gender
 * @property int $religion
 * @property string $home_phone
 * @property string $cell_phone
 * @property string $email
 * @property string $passport_number
 * @property string $driving_license_number
 * @property string $tin_number
 * @property string $present_address
 * @property string $permanent_address
 * @property int $status
 * @property int $create_time
 * @property int $create_by
 * @property int $update_time
 * @property int $update_by
 */
class UserBasic extends Entity
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
