<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
use Cake\Utility\Text;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Auditors Model
 *
 * @property \App\Model\Table\AuditorAccountsTable|\Cake\ORM\Association\HasMany $AuditorAccounts
 *
 * @method \App\Model\Entity\Auditor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Auditor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Auditor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Auditor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Auditor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Auditor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Auditor findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AuditorsTable extends Table
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

        $this->setTable('auditors');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AuditorAccounts', [
            'foreignKey' => 'auditor_id'
        ]);
    }


    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        if(isset($data['action'])){
            switch($data['action'])
            {
                case 'created':
                    $data['auditor_accounts'] = [
                        $data['account']
                    ];
                    $data['auditor_fullname'] = strtoupper($data['auditor_fullname']);
                break;

                case 'update-auditor':
                    if(isset($data['auditor_accounts'][0]['account_password_old']) && $data['auditor_accounts'][0]['account_password_old']!=='')
                    {
                        //checking old password
                        $hasher = new DefaultPasswordHasher();
                        if($hasher->check($data['auditor_accounts'][0]['account_password_old'],$data['auditor_accounts'][0]['account_password']))
                               $data['auditor_accounts'][0]['account_password'] = $data['auditor_accounts'][0]['account_password_new'];
                    }

                    $data['auditor_fullname'] = strtoupper($data['auditor_fullname']);

                break;
            }

        }

        return $data;
    }

    public function beforeSave($event, $entity, $options){
        if($entity->isNew())
        {
            //save profile photo
            $target = Text::uuid().'.'.strtolower(pathinfo($entity->auditor_photo_candidate['name'],PATHINFO_EXTENSION));
            if(move_uploaded_file($entity->auditor_photo_candidate['tmp_name'], WWW_ROOT.'img/assets/admins/photo/'.$target))
            {
                //assign right value to auditor_photo
                $entity->auditor_photo = $target;
            }else
              return false;
        }else
        {
            if(isset($entity->auditor_photo_candidate) && $entity->auditor_photo_candidate!=='null')
            {
                  //replace photo
                $old_path_photo = WWW_ROOT.'img/assets/admins/photo/'.$entity->auditor_photo;
                  if(file_exists($old_path_photo))
                       unlink($old_path_photo);
                   $target = Text::uuid().'.'.strtolower(pathinfo($entity->auditor_photo_candidate['name'],PATHINFO_EXTENSION));
                    if(move_uploaded_file($entity->auditor_photo_candidate['tmp_name'], WWW_ROOT.'img/assets/admins/photo/'.$target))
                    {
                        //assign right value to auditor_photo
                        $entity->auditor_photo = $target;
                    }else
                      return false;
            }
        }
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
            ->scalar('auditor_fullname')
            ->maxLength('auditor_fullname', 300)
            ->requirePresence('auditor_fullname', 'create')
            ->notEmpty('auditor_fullname');

        $validator
            ->scalar('auditor_sexe')
            ->maxLength('auditor_sexe', 1)
            ->requirePresence('auditor_sexe', 'create')
            ->notEmpty('auditor_sexe');

        $validator
            ->scalar('auditor_contact')
            ->maxLength('auditor_contact', 8)
            ->requirePresence('auditor_contact', 'create')
            ->notEmpty('auditor_contact');

        $validator
            ->scalar('auditor_photo')
            ->maxLength('auditor_photo', 200)
            ->requirePresence('auditor_photo', 'create')
            ->notEmpty('auditor_photo');

        $validator
            ->scalar('auditor_email')
            ->maxLength('auditor_email', 100)
            ->requirePresence('auditor_email', 'create')
            ->notEmpty('auditor_email')
            ->add('auditor_email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        // Custom fields validation
        $validator
            ->requirePresence('auditor_photo_candidate', 'create')
            ->add('auditor_photo_candidate', 'file', [
                'rule' => ['mimeType', ['image/jpeg','image/jpg','image/png','image/bitmap','image/gif']],
                'on' => function($context) {
                    return !empty($context['auditor_photo_candidate']);
                }
            ])
            ->add('auditor_photo_candidate', 'fileSize',[
                'rule' => ['fileSize', '<', '3MB'],
                'on' => function($context) {
                    return !empty($context['auditor_photo_candidate']);
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
        $rules->add($rules->isUnique(['auditor_email']));

        return $rules;
    }
}
