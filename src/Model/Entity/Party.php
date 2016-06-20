<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Party Entity.
 *
 * @property int $id
 * @property int $application_id
 * @property \App\Model\Entity\Application $application
 * @property string $name
 * @property string $father_name
 * @property string $mother_name
 * @property string $village
 * @property string $mobile
 * @property string $phone
 * @property string $email
 * @property int $type
 * @property int $status
 * @property int $create_time
 * @property int $create_by
 * @property int $update_time
 * @property int $update_by
 */
class Party extends Entity
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
