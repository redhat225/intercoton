<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cooperative Entity
 *
 * @property int $id
 * @property string $cooperative_denomination
 * @property string $cooperative_sigle
 * @property string $cooperative_geoloc
 * @property int $cooperative_nbre_personnel
 * @property string $cooperative_localisation
 * @property string $cooperative_sub_prefecture
 * @property string $cooperative_assets
 * @property int $zone_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 * @property int $created_by
 *
 * @property \App\Model\Entity\Zone $zone
 * @property \App\Model\Entity\Report[] $reports
 */
class Cooperative extends Entity
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
        'cooperative_denomination' => true,
        'cooperative_sigle' => true,
        'cooperative_geoloc' => true,
        'main_photo_candidate' => true, 
        'cooperative_nbre_personnel' => true,
        'cooperative_localisation' => true,
        'cooperative_sub_prefecture' => true,
        'cooperative_assets' => true,
        'zone_id' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'created_by' => true,
        'zone' => true,
        'reports' => true
    ];
}
