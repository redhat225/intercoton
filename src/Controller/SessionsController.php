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
use Cake\Utility\Text;
use Cake\Cache\Cache;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class  SessionsController extends AppController
{
    public function initialize(){
        parent::initialize();    
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function all(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                if(isset($this->request->query['action'])){
                    $auditor_accounts = TableRegistry::get('AuditorAccounts');

                    if(isset($this->request->query['page'])){
                        $page = $this->request->query['page'];


                        $sessions = $this->Sessions->find()
                                                    ->contain(['Reports'])
                                                    ->limit(30)
                                                    ->page($page)
                                                    ->map(function($row) use ($auditor_accounts){
                                                        $account = $auditor_accounts->find()
                                                                                    ->contain(['Auditors'])
                                                                                    ->where(['AuditorAccounts.id'=>$row->created_by])
                                                                                    ->first();
                                                        $row->creator = $account->auditor->auditor_fullname;
                                                        return $row;
                                                    });
                    }else{
                        $sessions = $this->Sessions->find()
                                                    ->contain(['Reports'])
                                                    ->map(function($row) use ($auditor_accounts){
                                                        $account = $auditor_accounts->find()
                                                                                    ->contain(['Auditors'])
                                                                                    ->where(['AuditorAccounts.id'=>$row->created_by])
                                                                                    ->first();
                                                        $row->creator = $account->auditor->auditor_fullname;
                                                        return $row;
                                                    });
                    }


                    foreach ($sessions as $session) {
                        $count_reports = count($session->reports);
                        $session->count_reports = $count_reports;
                    }

                    $session_all = $this->Sessions->find()->count();
                    $session_pages = ceil($session_all/30);

                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('sessions','session_pages'));
                    $this->set('_serialize',['sessions','session_pages']);
                }
            }
        }
    }

    public function create(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data =$this->request->data;
                $data['action'] = 'create';
                $data['created_by'] = $this->request->session()->read('Auth.User.id');
                $session = $this->Sessions->newEntity($data);
                if($this->Sessions->save($session)){
                    $response = 'ok';
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('response'));
                    $this->set('_serialize',['response']);
                }else
                  throw new Exception\BadRequestException(__('error'));

            }
        }
    }

    public function get(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $query_data = $this->request->query;
                $session = $this->Sessions->get($query_data['id']);
                $this->RequestHandler->renderAs($this, 'json');
                $this->set(compact('session'));
                $this->set('_serialize',['session']);
            }
        }
    }

    public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('put')){
                $data = $this->request->data;

                $data['action'] = 'edit';
                $session = $this->Sessions->get($data['id']);
                $session = $this->Sessions->patchEntity($session,$data);
                if(!$session->errors())
                {
                    if($this->Sessions->save($session)){
                        $response = 'ok';
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('response'));
                        $this->set('_serialize',['response']);
                    }else
                       throw new Exception\BadRequestException(__('error'));
                }else
                    throw new Exception\BadRequestException(__('error'));

            }
        }
    }
}
