<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\Event\Event;
use ArrayObject;
use Cake\Network\Exception;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\File;
/**
 * AuditorAccounts Model
 *
 * @property \App\Model\Table\AuditorsTable|\Cake\ORM\Association\BelongsTo $Auditors
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\ReportsTable|\Cake\ORM\Association\HasMany $Reports
 *
 * @method \App\Model\Entity\AuditorAccount get($primaryKey, $options = [])
 * @method \App\Model\Entity\AuditorAccount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AuditorAccount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AuditorAccount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AuditorAccount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AuditorAccount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AuditorAccount findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AuditorAccountsTable extends Table
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

        $this->setTable('auditor_accounts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Auditors', [
            'foreignKey' => 'auditor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Reports', [
            'foreignKey' => 'auditor_account_id'
        ]);
    }


    public function beforeSave($event, $entity, $options){
        if($entity->isNew())
        {
            if(isset($entity->account_avatar_candidate))
            {
                $target = Text::uuid().'.'.strtolower(pathinfo($entity->account_avatar_candidate['name'],PATHINFO_EXTENSION));
                if(move_uploaded_file($entity->account_avatar_candidate['tmp_name'], WWW_ROOT.'img/assets/admins/avatar/'.$target))
                {
                    //assign right value to avatar
                    $entity->account_avatar = $target;
                }else
                  return false;
            }
        }else
           {
                if(isset($entity->account_avatar_candidate))
                {
                    $target = Text::uuid().'.'.strtolower(pathinfo($entity->account_avatar_candidate['name'],PATHINFO_EXTENSION));

                    //remove old image
                    if($entity->account_avatar!='default.png')
                    {
                       if($path->path==null)
                        unlink(WWW_ROOT.'img/assets/admins/avatar/'.$entity->account_avatar);
                    }


                    if(move_uploaded_file($entity->account_avatar_candidate['tmp_name'], WWW_ROOT.'img/assets/admins/avatar/'.$target))
                    {
                        //assign right value to avatar
                        $entity->account_avatar = $target;
                    }else
                      return false;
                }
           }
    }

     public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options){
        // debug($data);
        // die();
        if(isset($data['action'])){
            switch($data['action']){
                case "update-profile-self":
                    //replace password if set(verifying before lol)
                    if(isset($data['old_password'])){
                        $hasher = new DefaultPasswordHasher();
                        if($hasher->check($data['old_password'],$data['account_password']))
                            $data['account_password'] = $data['new_password'];
                        else
                              throw new Exception\ForbiddenException(__('forbidden'));
                    }

                            if($data['account_is_active'] == 'true')
                                $data['account_is_active'] = true;
                            else
                                $data['account_is_active'] = false;
                      

                break;

                default:

                break;
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
            ->scalar('account_username')
            ->maxLength('account_username', 100)
            ->requirePresence('account_username', 'create')
            ->notEmpty('account_username')
            ->add('account_username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('account_avatar')
            ->maxLength('account_avatar', 200)
            ->requirePresence('account_avatar', 'create')
            ->notEmpty('account_avatar');

        $validator
            ->scalar('account_password')
            ->requirePresence('account_password', 'create')
            ->notEmpty('account_password');

        $validator
            ->boolean('account_is_active')
            ->requirePresence('account_is_active', 'create')
            ->notEmpty('account_is_active');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        //custom fields validation
        $validator
            ->add('account_avatar_candidate', 'file', [
                'rule' => ['mimeType', ['image/jpeg','image/jpg','image/png','image/bitmap','image/gif']],
                'on' => function($context){
                    return (!empty($context['account_avatar_candidate']));
                }
            ])->add('account_avatar_candidate', 'fileSize',[
                'rule' => ['fileSize', '<', '3MB'],
                'on' => function($context){
                    return (!empty($context['account_avatar_candidate']));

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
        $rules->add($rules->isUnique(['account_username']));
        $rules->add($rules->existsIn(['auditor_id'], 'Auditors'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
    public function findAuth(Query $query, array $options){
        $query->select(['id','account_username','account_password','role_id'])
              ->contain(['Roles.RoleContents'])
              ->autoFields(true)
              ->where(['account_is_active' => 1]);
        return $query;
    }


}
