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
                ]
        ]);
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        // $this->Cookie->delete('WelcomePca');


        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        // $this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }



    public function isAuthorized($user = null){
        return true;
        // if($this->request->session()->read('Auth'))
        // {
        //     // if($this->request->is('ajax'))
        //     //     $jwt = $this->request->env('HTTP_X_AUTHORIZATION');
        //     // else
        //     //     $jwt = $this->request->is('get')?$this->request->getParam('jwt'):$this->request->data['jwt'];

        //     // if($jwt)
        //     // {
        //     //     try{
        //     //          $decoded_jwt = JWT::decode($jwt, Security::salt(), array('HS256'));
        //     //      }catch(MainException $e){
        //     //         $decoded_jwt = false;
        //     //     }

        //     //     if($decoded_jwt === false)
        //     //         throw new Exception\ForbiddenException(__('error'));
        //     // }
        //     // else
        //     //     throw new Exception\ForbiddenException(__('error'));
        //     return true;
        // }else
        // return false;
      }

}
