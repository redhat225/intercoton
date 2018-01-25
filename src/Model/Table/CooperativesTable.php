<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception;
use \Exception as MainException;
/**
 * Cooperatives Model
 *
 * @property \App\Model\Table\ZonesTable|\Cake\ORM\Association\BelongsTo $Zones
 * @property \App\Model\Table\ReportsTable|\Cake\ORM\Association\HasMany $Reports
 *
 * @method \App\Model\Entity\Cooperative get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cooperative newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cooperative[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cooperative|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cooperative patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cooperative[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cooperative findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CooperativesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('cooperatives');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Zones', [
            'foreignKey' => 'zone_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Reports', [
            'foreignKey' => 'cooperative_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */


    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        switch($data['action'])
        {
            case 'create':  
                $geoloc = [
                    'latitude' => $data['cooperative_latitude'],
                    'longitude' => $data['cooperative_longitude']
                ];
                //convert some string to uppercase
                $data['cooperative_sigle'] = strtoupper($data['cooperative_sigle']);
                $data['cooperative_localisation'] = strtoupper($data['cooperative_localisation']);
                if(isset($data['cooperative_sub_prefecture']))
                            $data['cooperative_sub_prefecture'] = strtoupper($data['cooperative_sub_prefecture']);

                $data['cooperative_geoloc'] = json_encode($geoloc);
                //create a zone if not Exist
                if(isset($data['zone_unavailable']))
                {
                  if($data['zone_unavailable'])
                  {
                      $zones = TableRegistry::get('Zones');
                          $zone_data =['zone_denomination'=>strtoupper($data['zone_denomination']),'created_by'=>$data['created_by']];

                            try{
                                 $zone = $zones->newEntity($zone_data);

                                if($zones->save($zone))
                                  $data['zone_id'] = $zone->id;
                                else
                                  throw new Exception\BadRequestException(__('error'));

                            }catch(MainException $e){
                                throw new Exception\BadRequestException(__('error'));
                        }
                  }

                }
            break;

            case 'modify':

                $data['cooperative_denomination'] = strtoupper($data['cooperative_denomination']);
                $data['cooperative_sigle'] = strtoupper($data['cooperative_sigle']);
                $data['cooperative_localisation'] = strtoupper($data['cooperative_localisation']);

                if($data['cooperative_sub_prefecture']!='null')
                {
                    $data['cooperative_sub_prefecture'] = strtoupper($data['cooperative_sub_prefecture']);
                }


            break;
        }

        return $data;
    }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('cooperative_denomination')
            ->maxLength('cooperative_denomination', 300)
            ->requirePresence('cooperative_denomination', 'create')
            ->notEmpty('cooperative_denomination');

        $validator
            ->scalar('cooperative_sigle')
            ->maxLength('cooperative_sigle', 50)
            ->requirePresence('cooperative_sigle', 'create')
            ->notEmpty('cooperative_sigle');

        $validator
            ->scalar('cooperative_geoloc')
            ->requirePresence('cooperative_geoloc', 'create')
            ->notEmpty('cooperative_geoloc');

        $validator
            ->integer('cooperative_nbre_personnel')
            ->allowEmpty('cooperative_nbre_personnel');

        $validator
            ->scalar('cooperative_localisation')
            ->maxLength('cooperative_localisation', 300)
            ->requirePresence('cooperative_localisation', 'create')
            ->notEmpty('cooperative_localisation');

        $validator
            ->scalar('cooperative_sub_prefecture')
            ->maxLength('cooperative_sub_prefecture', 300)
            ->allowEmpty('cooperative_sub_prefecture');

        $validator
            ->scalar('cooperative_assets')
            ->allowEmpty('cooperative_assets');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->requirePresence('main_photo_candidate', 'create')
            ->add('main_photo_candidate', 'file', [
                'rule' => ['mimeType', ['image/jpeg','image/jpg','image/png','image/bitmap','image/gif']],
                'on' => function($context) {
                    return (!empty($context['data']['main_photo_candidate']) && $context['data']['main_photo_candidate']!='null');
                }
            ])
            ->add('main_photo_candidate', 'fileSize',[
                'rule' => ['fileSize', '<', '5MB'],
                'on' => function($context) {
                    return (!empty($context['data']['main_photo_candidate']) && $context['data']['main_photo_candidate']!='null');
                }
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['zone_id'], 'Zones'));

        return $rules;
    }
}
