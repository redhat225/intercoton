<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Network\Exception;
use \Exception as MainException;
use \Firebase\JWT\JWT;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class  AuditorsController extends AppController
{
    public function initialize(){
        parent::initialize();    
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function all(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){

            }

            if($this->request->is('get')){
                if(isset($this->request->query['action'])){
                    $auditors = $this->Auditors->find()
                                               ->contain(['AuditorAccounts.Roles']);
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('auditors','roles_all'));
                    $this->set('_serialize',['auditors','roles_all']); 
                }
            }
        }

    }

    public function create(){
        if($this->request->is('ajax')){
            if($this->request->is('post'))
            {   
                $data = $this->request->data;
                $data['action'] = 'created';
                $data['file']['action'] = 'created';
                $session = $this->request->session();
                $user = $session->read('Auth.User');
                $auditor = $this->Auditors->newEntity($data['file'], ['associated' => ['AuditorAccounts']]);
                $auditor->created_by = $user['id'];
                $auditor->auditor_accounts[0]->created_by=$user['id'];
                $auditor->auditor_accounts[0]->account_is_active = 1;
                $auditor->auditor_accounts[0]->account_avatar = 'default.png';
                $auditor->auditor_photo = 'yes';

                if(!$auditor->errors())
                {
                    $auditor->auditor_photo_candidate = $data['file']['auditor_photo_candidate'];
                    if(isset($data['file']['account']['account_avatar_candidate']))
                    $auditor->auditor_accounts[0]->account_avatar_candidate = $data['file']['account']['account_avatar_candidate'];
                    //save auditor
                    if($this->Auditors->save($auditor))
                    {
                        $response = 'ok';
                        $this->set(compact('response'));
                        $this->set('_serialize',['response']);
                    }else
                       throw new Exception\BadRequestException(__('error'));
                }
                else
                    throw new Exception\ForbiddenException(__('error'));

            }

            if($this->request->is('get')){
                $roles = TableRegistry::get('Roles');
                $roles_all = $roles->find();
                
                $this->set(compact('roles_all'));
                $this->set('_serialize',['roles_all']);
            }
        }
    }

    public function index(){

    }

    public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('put')){
                $data = $this->request->data;
                $auditor = $this->Auditors->get($data['account'], ['contain'=>'AuditorAccounts']);
                if($auditor){

                    switch($data['action'])
                    {
                        case 'turn_off':
                            $auditor->auditor_accounts[0]->account_is_active = false;
                            $auditor->dirty('auditor_accounts', true);
                            $query = $this->Auditors->save($auditor,['associated'=>['AuditorAccounts']]);
                        break;

                        case 'turn_on':
                            $auditor->auditor_accounts[0]->account_is_active = true;
                            $auditor->dirty('auditor_accounts', true);
                            $query = $this->Auditors->save($auditor,['associated'=>['AuditorAccounts']]);
                        break;

                        case 'soft_delete':
                            $auditor->auditor_accounts[0]->account_is_active = false;
                            $auditor->auditor_accounts[0]->deleted = new \DateTime('NOW');
                            $auditor->dirty('auditor_accounts', true);
                            $query = $this->Auditors->save($auditor,['associated'=>['AuditorAccounts']]);
                        break;

                        case 'reinitialisation':
                            $auditor->auditor_accounts[0]->account_password = 'Intercoton@2018';
                            $auditor->auditor_accounts[0]->account_is_active = true;
                            $auditor->auditor_accounts[0]->deleted = null;
                            $auditor->dirty('auditor_accounts', true);
                            $query = $this->Auditors->save($auditor,['associated'=>['AuditorAccounts']]);
                        break;
                    }

                    if($query){
                        $response = 'ok';
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('response'));
                        $this->set('_serialize',['response']);
                    }else
                        throw new Exception\BadRequestException(__('error2'));

                }else
                  throw new Exception\BadRequestException(__('error'));
            }
            if($this->request->is('post')){
                $data = $this->request->data;
                $data['file']['action'] = 'update-auditor';

                $temp_auditor = $this->Auditors->get($data['file']['id'],['contain'=>'AuditorAccounts']);
                $auditor = $this->Auditors->patchEntity($temp_auditor, $data['file'], ['associated'=> ['AuditorAccounts']]);
                $auditor->deleted = $temp_auditor->deleted;
                $auditor->auditor_accounts[0]->account_is_active = $temp_auditor->auditor_accounts[0]->account_is_active;
                $auditor->auditor_accounts[0]->deleted = $temp_auditor->auditor_accounts[0]->deleted;
                
                $auditor->dirty('auditor_accounts', true);

                if(isset($data['file']['auditor_photo_candidate']) && $data['file']['auditor_photo_candidate']!=null)
                $auditor->auditor_photo_candidate = $data['file']['auditor_photo_candidate'];

                if($this->Auditors->save($auditor))
                {
                    $response = 'ok';
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('response'));
                    $this->set('_serialize',['response']);
                }else
                  throw new Exception\BadRequestException(__('error'));
            }
            if($this->request->is('get')){
                $query_data = $this->request->query;
                if(isset($query_data['account']))
                {
                    $auditor = $this->Auditors->get($query_data['account'],['contain'=>'AuditorAccounts']);

                    $this->RequestHandler->renderAs($this, 'json');

                    $this->set(compact('auditor'));
                    $this->set('_serialize',['auditor']);
                }

            }
        }
    }

}
