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
class  ZonesController extends AppController
{
    public function initialize(){
        parent::initialize();    
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function all(){
        if($this->request->is('ajax'))
        {
           if($this->request->is('get')){
                if(isset($this->request->query['action']))
                {
                    switch($this->request->query['action']){
                        case 'all':
                            $zones = $this->Zones->find();
                            $this->RequestHandler->renderAs($this, 'json');

                            $this->set(compact('zones'));
                            $this->set('_serialize',['zones']); 
                        break;
                    }

                }

           }
        }
    }

    public function create(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $session = $this->request->session();
                $user = $session->read('Auth.User');

                $zones_array =[];
                foreach ($data as $zone){
                    $zone_item = [
                        'zone_denomination' => strtoupper($zone),
                        'created_by' => $user['id'],
                        'action' => 'create'
                    ];
                    array_push($zones_array, $zone_item);
                }
                $zones  = $this->Zones->newEntities($zones_array);
                if(!$zones->errors())
                {
                    if($this->Zones->saveMany($zones)){
                        $this->RequestHandler->renderAs($this, 'json');
                        $response = 'ok';
                        $this->set(compact('response'));
                        $this->set('_serialize',['response']);
                    }else
                      throw new Exception\BadRequestException(__('error')); 
                }else
                      throw new Exception\BadRequestException(__('error')); 


            }
        }
    }

    public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                if(isset($this->request->query['action'])){
                    $zone = $this->Zones->get($this->request->query['id']);
                    if($zone){
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('zone'));
                        $this->set('_serialize',['zone']); 
                    }else
                      throw new Exception\BadRequestException(__('error'));
                }
            }
            if($this->request->is('post')){
                $data  = $this->request->data;
                $zone = $this->Zones->get($data['zone']['id']||$data['zone']);
                if(!empty($zone))
                {
                    switch($data['action']){
                        case 'edit-zone':
                            $data['zone']['action'] = 'edit-zone';
                            $zone = $this->Zones->patchEntity($zone, $data['zone']);
                            $zone->deleted = $zone->deleted;
                        break;

                        case 'activate_zone':
                            $zone->deleted = null;
                        break;

                        case 'desactivate_zone':
                            $zone->deleted = new  \DateTime('NOW');
                        break;
                    }
                    if($this->Zones->save($zone))
                    {
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('response'));
                        $this->set('_serialize',['response']); 
                    }
                    else
                         throw new Exception\BadRequestException(__('error'));
                }
                else
                     throw new Exception\BadRequestException(__('error'));



           
            }
        }
    }

    public function createZoneTemplate(){
        if(!Cache::read('token','token_create_zone'))
            Cache::write('token',1,'token_create_zone');
        else
            Cache::write('token',(Cache::read('token','token_create_zone')+1),'token_create_zone');

        $token = Cache::read('token','token_create_zone');
        $this->set(compact('token'));
        $this->set('_serialize',['token']);
    }

}
