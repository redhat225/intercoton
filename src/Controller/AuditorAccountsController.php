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
class  AuditorAccountsController extends AppController
{
    public function initialize(){
        parent::initialize();    
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function view(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                if(isset($this->request->query['action'])){
                    $account_id = $this->request->session()->read('Auth.User.id');
                    $auditor_accounts = TableRegistry::get('AuditorAccounts');
                    $profile = $auditor_accounts->get($account_id,['contain'=>['Auditors','Roles']]);
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('profile'));
                    $this->set('_serialize',['profile']);
                }
            }
        }
    }

    public function update(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $data['profile']['action'] = $data['action']; 
                $account_id = $this->request->session()->read('Auth.User.id');
                unset($data['profile']['role']);
                unset($data['profile']['auditor']);
                $old_account = $this->AuditorAccounts->get($account_id);

                $account = $this->AuditorAccounts->patchEntity($old_account, $data['profile']);
                $account->deleted = $old_account->deleted;

                if(!$account->errors()){
                    if($this->AuditorAccounts->save($account))
                    {
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
