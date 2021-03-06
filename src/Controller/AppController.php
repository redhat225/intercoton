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

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Security;
use \Firebase\JWT\JWT;
use \Exception as MainException;
use Cake\Network\Exception;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
                'loginAction' => [
                    'controller' => 'Admins',
                    'action' => 'login'
                ],
                'authenticate' => [
                    'Form' => [
                        'fields' => ['username' => 'account_username', 'password' => 'account_password'],
                        'userModel' => 'AuditorAccounts',
                        'finder' => 'auth'
                    ]
                ],
                'authorize' => 'Controller'
        ]);
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');


        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        // $this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }



    public function isAuthorized($user = null){
        if($this->request->is('ajax')){
                $authorization_header = $this->request->env('HTTP_AUTHORIZATION');
                $evaluation_jwt = preg_split("/\s/", $authorization_header);
                $jwt = $evaluation_jwt[1];
                $decoded_jwt = $this->checking($jwt);

                if($decoded_jwt == false)
                  throw new Exception\ForbiddenException(__('forbidden'));
                else
                {
                    $role_denomination = $decoded_jwt->data->role->role_denomination;
                    switch($role_denomination){
                        case 'auditor':
                            $role_contents = $decoded_jwt->data->role->role_contents;
                            $matched_route = $this->request->params['_matchedRoute'];

                            if(in_array($matched_route, $role_contents))
                               throw new Exception\ForbiddenException(__('Unauthorized'));
                            else
                                return true;
                        break;

                        default:
                            return true;
                        break;
                    }
                }
        }else
         return true;
      }


      private function checking($jwt){
        $key = Security::salt();
        try{
             $decoded = JWT::decode($jwt,$key,array('HS256'));
        }catch(MainException $e){
            $decoded = false;
        }
        return $decoded;
      }

}
