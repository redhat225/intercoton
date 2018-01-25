<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Session Entity
 *
 * @property int $id
 * @property string $session_denomination
 * @property string $session_code
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 * @property int $created_by
 * @property \Cake\I18n\FrozenDate $session_begin_date
 * @property \Cake\I18n\FrozenDate $session_end_date
 *
 * @property \App\Model\Entity\Report[] $reports
 */
class Session extends Entity
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
        'session_denomination' => true,
        'session_code' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'created_by' => true,
        'session_begin_date' => true,
        'session_end_date' => true,
        'reports' => true
    ];
}
