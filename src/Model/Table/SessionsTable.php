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
use Cake\Utility\Text;

/**
 * Sessions Model
 *
 * @property \App\Model\Table\ReportsTable|\Cake\ORM\Association\HasMany $Reports
 *
 * @method \App\Model\Entity\Session get($primaryKey, $options = [])
 * @method \App\Model\Entity\Session newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Session[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Session|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Session patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Session[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Session findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SessionsTable extends Table
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

        $this->setTable('sessions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Reports', [
            'foreignKey' => 'session_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('session_denomination')
            ->maxLength('session_denomination', 300)
            ->requirePresence('session_denomination', 'create')
            ->notEmpty('session_denomination')
            ->add('session_denomination', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('session_code')
            ->maxLength('session_code', 100)
            ->requirePresence('session_code', 'create')
            ->notEmpty('session_code');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->date('session_begin_date')
            ->requirePresence('session_begin_date', 'create')
            ->notEmpty('session_begin_date');

        $validator
            ->date('session_end_date')
            ->requirePresence('session_end_date', 'create')
            ->notEmpty('session_end_date');

        return $validator;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        if(isset($data['action'])){
            switch($data['action']){
                case 'create':     
                        $data['session_denomination'] = strtoupper($data['session_denomination']);

                        try{
                                $now_date = new \DateTime('NOW');
                                $begin_date = new \DateTime($data['session_begin_date']);
                                $begin_format = $begin_date->format('Y-m-d');
                                $data['session_begin_date'] = $begin_format;
                                //end date
                                $end_date = new \DateTime($data['session_end_date']);
                                $end_format = $end_date->format('Y-m-d');
                                $data['session_end_date'] = $end_format;
                                $valid = true;
                        }catch(MainException $e){
                                $valid = false;
                        }

                        if($valid){

                               if(($begin_date) < ($now_date))
                               {
                                    throw new Exception\BadRequestException(__('error'));
                               }
                                else
                                {
                                    if($begin_date>$end_date)
                                        throw new Exception\BadRequestException(__('error'));
                                    else
                                    {
                                        // Session Code
                                        $session_code ='S-'.$now_date->format('Y-m-d').Text::uuid();
                                        $data['session_code'] = $session_code;
                                    } 
                                }
                            

                        }else
                            throw new Exception\BadRequestException(__('error'));
                break;

                case 'edit':
                        $data['session_denomination'] = strtoupper($data['session_denomination']);

                        try{
                                $now_date = new \DateTime('NOW');

                                $begin_date = new \DateTime($data['session_begin_date']);
                                $begin_format = $begin_date->format('Y-m-d');
                                $data['session_begin_date'] = $begin_format;
                                //end date
                                $end_date = new \DateTime($data['session_end_date']);
                                $end_format = $end_date->format('Y-m-d');
                                $data['session_end_date'] = $end_format;
                                $valid = true;
                        }catch(MainException $e){
                                $valid = false;
                        }

                        if($valid){
                                if($begin_date>$end_date)
                                   throw new Exception\BadRequestException(__('error'));
                        }else
                            throw new Exception\BadRequestException(__('error3'));
                break;

                default:

                break;
            }
        }
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
        $rules->add($rules->isUnique(['session_denomination']));

        return $rules;
    }
}
