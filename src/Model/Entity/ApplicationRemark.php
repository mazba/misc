<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicationRemark Entity.
 *
 * @property int $id
 * @property int $application_id
 * @property \App\Model\Entity\Application $application
 * @property string $remarks
 * @property int $application_status
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $create_time
 */
class ApplicationRemark extends Entity
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
