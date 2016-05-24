<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 *
 * @property int $id
 * @property int $office_id
 * @property \App\Model\Entity\Office $office
 * @property int $user_group_id
 * @property \App\Model\Entity\UserGroup $user_group
 * @property string $full_name_bn
 * @property string $full_name_en
 * @property string $username
 * @property string $password
 * @property string $picture_alt
 * @property string $picture_name
 * @property int $notifiacation
 * @property int $status
 * @property int $create_by
 * @property int $create_date
 * @property int $update_by
 * @property int $update_date
 * @property \App\Model\Entity\UserBasic[] $user_basics
 * @property \App\Model\Entity\UserDesignation[] $user_designations
 */
class User extends Entity
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

    protected function _setPassword($password)
    {
        if (strlen($password) > 0)
        {
            return (new DefaultPasswordHasher)->hash($password);
        }

    }
}
