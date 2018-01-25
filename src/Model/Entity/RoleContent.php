<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RoleContent Entity
 *
 * @property int $id
 * @property string $content_action
 * @property string $content_controller
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 * @property int $role_id
 *
 * @property \App\Model\Entity\Role $role
 */
class RoleContent extends Entity
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
        'id' => true,
        'content_action' => true,
        'content_controller' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'role_id' => true,
        'role' => true
    ];
}
