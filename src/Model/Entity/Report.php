<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Report Entity
 *
 * @property int $id
 * @property string $report_code
 * @property string $report_content
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 * @property int $auditor_account_id
 * @property int $cooperative_id
 * @property int $session_id
 *
 * @property \App\Model\Entity\AuditorAccount $auditor_account
 * @property \App\Model\Entity\Cooperative $cooperative
 * @property \App\Model\Entity\Session $session
 */
class Report extends Entity
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
        'report_code' => true,
        'report_content' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'auditor_account_id' => true,
        'cooperative_id' => true,
        'session_id' => true,
        'auditor_account' => true,
        'cooperative' => true,
        'session' => true
    ];
}
