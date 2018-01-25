<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Auditor Entity
 *
 * @property int $id
 * @property string $auditor_fullname
 * @property string $auditor_sexe
 * @property string $auditor_contact
 * @property string $auditor_photo
 * @property string $auditor_email
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 * @property int $created_by
 *
 * @property \App\Model\Entity\AuditorAccount[] $auditor_accounts
 * @property \App\Model\Entity\Role[] $roles
 */
class Auditor extends Entity
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
        'auditor_fullname' => true,
        'auditor_sexe' => true,
        'auditor_contact' => true,
        'auditor_photo' => true,
        'auditor_email' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'created_by' => true,
        'auditor_accounts' => true,
        'roles' => true
    ];
}
