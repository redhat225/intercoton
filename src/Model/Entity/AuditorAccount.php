<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * AuditorAccount Entity
 *
 * @property int $id
 * @property string $account_username
 * @property string $account_avatar
 * @property int $auditor_id
 * @property string $account_password
 * @property bool $account_is_active
 * @property int $role_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 * @property int $created_by
 *
 * @property \App\Model\Entity\Auditor $auditor
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Report[] $reports
 */
class AuditorAccount extends Entity
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

    public function _setAccountPassword($value){
            if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($value);
            }
    }

    protected $_accessible = [
        'account_username' => true,
        'account_avatar' => true,
        'auditor_id' => true,
        'account_password' => true,
        'account_is_active' => true,
        'account_avatar_candidate'=>true,
        'role_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'created_by' => true,
        'auditor' => true,
        'role' => true,
        'reports' => true
    ];
}
