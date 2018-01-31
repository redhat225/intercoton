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
class  AdminsController extends AppController
{
    public function initialize(){
        parent::initialize();


        $this->Auth->allow(['forgot','logout','login','welcome']);
        if($this->request->session()->read('Auth')){
            if($this->request->is('ajax')){

            }else
            {

                if($this->request->params['_matchedRoute']!=="/admins/logout"){

                     $this->request->params['action'] = 'index';
                     $this->request->params['controller'] = 'Admins';
                }
            }
        }else{
            if($this->request->is('get')){
                if(!$this->Cookie->check('WelcomePca')){
                    $this->Cookie->configKey('WelcomePca','expires','1 month');
                    $this->Cookie->write('WelcomePca','yes Man!!!');
                    return $this->redirect(['controller'=>'Admins','action'=>'welcome']);
                }
            }
        }
    }

    public function welcome(){
        $this->viewBuilder()->layout("welcome");
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function beforeRender(Event $event){
        parent::beforeRender($event); 
    }

    public function index(){

    }

    public function home(){
        $role_denomination = $this->request->session()->read('Auth.User.role.role_denomination');
        $this->set(compact('role_denomination'));
        $this->set('_serialize',['role_denomination']);
    }

    public function briefStats(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                $cooperatives = TableRegistry::get('Cooperatives');
                $zones = TableRegistry::get('Zones');
                $auditor_accounts = TableRegistry::get('AuditorAccounts');
                $reports = TableRegistry::get('Reports');

                $role = $this->request->session()->read('Auth.User.role.role_denomination');
                if($role =="auditor"){
                    $cooperatives_count = 0;
                    $zones_count = 0;
                    $auditor_accounts_count = 0;
                    $reports_count = $reports->find()->Where(['Reports.auditor_account_id'=>$this->request->session()->read('Auth.User.id')])->count();
                }else
                {
                    $cooperatives_count = $cooperatives->find()->count();
                    $zones_count = $zones->find()->count();
                    $auditor_accounts_count = $auditor_accounts->find()->count();
                    $reports_count = $reports->find()->count();
                }


                $this->RequestHandler->renderAs($this, 'json');
                $this->set(compact('cooperatives_count','zones_count','auditor_accounts_count','reports_count'));
                $this->set('_serialize',['cooperatives_count','zones_count','auditor_accounts_count','reports_count']);
            }
        }
    }

    public function login(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){

                $user = $this->request->data;
                $auth = $this->Auth->identify($user);

                    if($auth){
                        $this->Auth->setUser($auth);
                        $this->RequestHandler->renderAs($this, 'json');
                        //generate JWT
                        $key = Security::salt();
                        $iat = time();
                        $token = [
                            "iss" => $this->request->env('SERVER_NAME'),
                            "iat" =>  $iat,
                            "data" => $auth
                        ];
                        $jwt = JWT::encode($token, $key);

                        $this->set(compact('jwt','decoded_jwt'));
                        $this->set('_serialize',['jwt','decoded_jwt']);

                    }else
                  throw new Exception\ForbiddenException(__('Forbidden'));
            }
        }else
        {
            $title = 'login';
            $this->set(compact('title'));
            $this->set('_serialize',['title']);
            $this->viewBuilder()->layout('login');
            
        }
    }

    public function create(){

        $auditors = TableRegistry::get('Auditors');

        $data = [
            'auditor_fullname' => 'RIEHL Emmanuel',
            'auditor_sexe' => 'M',
            'auditor_photo' => 'remmanuel',
            'auditor_email' => 'riehlemm@gmail.com',
            'auditor_contact' => '87853436',
            'auditor_email' => 'riehlemm@gmail.com',
            'created_by'=> 2,
            'auditor_accounts' => [
                [   
                    'account_username'=>'remmanuel225',
                    'account_password' => 'Rjeanpierre2017',
                    'account_is_active' => 1,
                    'created_by' => 1,
                ]
            ]
        ];
        $auditor = $auditors->newEntity($data, [
               'associated' => ['AuditorAccounts']
        ]);

        if($auditors->save($auditor))
        {
            $response = 'ok';
            $this->RequestHandler->renderAs($this, 'json');
            $this->set(compact('response'));
            $this->set('_serialize',['response']);
        }else
           throw new Exception\BadRequestException(__('error'));
    }

    public function dashboard(){
        $role_denomination = $this->request->session()->read('Auth.User.role.role_denomination');
        $this->set(compact('role_denomination'));
        $this->set('_serialize',['role_denomination']);
    }


    public function logout(){
        return $this->redirect($this->Auth->logout());
    }
}
