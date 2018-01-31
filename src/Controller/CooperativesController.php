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
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Http\Client;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class  CooperativesController extends AppController
{
    public function initialize(){
        parent::initialize();    
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }

    public function create(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;

                    //create $cooperative
                    $data['cooperative']['action'] = 'create'; 
                    $session = $this->request->session();
                    $user = $session->read('Auth.User');
                    $data['cooperative']['created_by'] = $user['id'];

                    $cooperative = $this->Cooperatives->newEntity($data['cooperative']);
                    // upload images first

                    try{
                        $upload = true;
                        $main_image_candidate_path = "/cooperatives"."/".Text::uuid().".".strtolower(pathinfo($data['cooperative']['main_photo_candidate']['name'],PATHINFO_EXTENSION));
                        $args_api = ['path'=>$main_image_candidate_path, 'mode'=>'add', 'autorename'=>true,'mute'=>false];
                        $client = new Client([
                            'headers' => [
                                'Content-Type' => "application/octet-stream",
                                'Authorization' => "Bearer ".Configure::read('dropbox-api.token'),
                                'Dropbox-API-Arg' => json_encode($args_api),
                            ]
                        ]);
                        $file = new File($data['cooperative']['main_photo_candidate']['tmp_name']);
                        $response = $client->post('https://content.dropboxapi.com/2/files/upload',$file->read());
                        $response_data = $response->json;

                        if(isset($response_data['error']))
                            $upload = false;

                        if($upload)
                        {
                            $shared_link_data = [
                                'path' => $response_data['path_lower'],
                                'settings' => [
                                    'requested_visibility' => "public"
                                ]
                            ];

                            $client_2 = new Client([
                                'headers' => [
                                    'Content-Type' => "application/json",
                                    'Authorization' => 'Bearer '.Configure::read('dropbox-api.token'),
                                ]
                            ]);

                            $response_2 = $client_2->post('https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings', json_encode($shared_link_data),['type'=>'json']);
                            $response_2_data = $response_2->json;

                            if(isset($response_data['error']))
                                $upload = false;

                            if($upload)
                            {
                                $link = $response_2_data['url'];
                                $pattern = "/dl=0/";
                                $link_main_photo_candidate = preg_replace($pattern, "dl=1", $link);

                                $cooperative->cooperative_assets = $link_main_photo_candidate;
                            }


                        }


                    }catch(MainException $e){
                        $upload = false;
                    }

                        if(!$upload)
                        {
                            $save_photo_and_open_a_pipe_here = false;
                        }

                        if($this->Cooperatives->save($cooperative))
                        {
                            $response = 'ok';
                            $this->RequestHandler->renderAs($this, 'json');
                            $this->set(compact('response'));
                            $this->set('_serialize',['response']);
                        }else
                            throw new Exception\BadRequestException(__('error'));
            }
        }
    }

    public function all(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){


            }

            if($this->request->is('get')){
                if(isset($this->request->query['action']))
                {

                    if(isset($this->request->query['page'])){
                        $page = $this->request->query['page'];
                        $cooperatives = $this->Cooperatives->find()
                                                           ->contain(['Zones'])
                                                           ->limit(30)
                                                           ->page($page);

                    }else
                    {
                         $cooperatives = $this->Cooperatives->find()
                                                           ->contain(['Zones']);
                    }

                        $cooperatives_all = $this->Cooperatives->find()
                                                                ->count();
                        $cooperatives_pages = ceil($cooperatives_all/30);

                    

                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('cooperatives','cooperatives_pages','cooperatives_all'));
                    $this->set('_serialize',['cooperatives','cooperatives_pages','cooperatives_all']); 
                }

            }
        }
    }

    public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $data['cooperative']['action'] = 'modify';

                $cooperative_old = $this->Cooperatives->get($data['cooperative']['id']);

                $role = $this->request->session()->read('Auth.User.role.role_denomination');
                    if($role == "auditor"){
                        if($cooperative_old->created_by != $this->request->session()->read('Auth.User.id'))
                            throw new Exception\ForbiddenException(__('forbidden'));
                }

                $cooperative  = $this->Cooperatives->patchEntity($cooperative_old, $data['cooperative']); 
                $cooperative->deleted = $cooperative_old->deleted;

                if($cooperative->cooperative_sub_prefecture=='')
                    $cooperative->cooperative_sub_prefecture = null;

                if(!$cooperative->errors()){
                    //checking if new image
                    $type_main_photo = gettype($cooperative->main_photo_candidate);
                   if($type_main_photo=="array")
                   {
                        try{
                                $upload = true;
                                //deleted old image
                                 $subject = $cooperative->cooperative_assets;
                                 preg_match("/.*\.(png|jpg|bitmap|gif|jpeg)/", $subject, $matches);
                                 $split_chain = preg_split('/\//', $matches[0]);
                                 $path_to_delete = $split_chain[count($split_chain)-1];

                                $deleted_data = [
                                    'path' => '/cooperatives'.'/'.$path_to_delete
                                ];
                                $client = new Client([
                                    'headers' => ['Authorization' => 'Bearer '.Configure::read('dropbox-api.token'), 'Content-Type'=>'json']
                                ]);

                                $response = $client->post('https://api.dropboxapi.com/2/files/delete_v2', json_encode($deleted_data),['type'=>'json']);

                                $response1_issue = $response->json;

                                if(isset($response1_issue['error']))
                                    $upload = false;

                                if($upload)
                                {
                                    // upload the new image
                                    $new_cooperative_asset_path = "/cooperatives"."/".Text::uuid().".".strtolower(pathinfo($data['cooperative']['main_photo_candidate']['name'],PATHINFO_EXTENSION));
                                    $args_api = ['path'=>$new_cooperative_asset_path, 'mode'=>'add', 'autorename'=>true,'mute'=>false];
                                    $client_2 = new Client([
                                        'headers' => [
                                            'Content-Type' => "application/octet-stream",
                                            'Authorization' => "Bearer ".Configure::read('dropbox-api.token'),
                                            'Dropbox-API-Arg' => json_encode($args_api),
                                        ]
                                    ]);



                                    $file = new File($data['cooperative']['main_photo_candidate']['tmp_name']);
                                    $response_2 = $client_2->post('https://content.dropboxapi.com/2/files/upload',$file->read());
                                    $response_data = $response_2->json;

                                    if(isset($response_data['error']))
                                        $upload = false;

                                    if($upload)
                                    {
                                        $shared_link_data = [
                                            'path' => $response_data['path_lower'],
                                            'settings' => [
                                                'requested_visibility' => "public"
                                            ]
                                        ];

                                        $client_2 = new Client([
                                            'headers' => [
                                                'Content-Type' => "application/json",
                                                'Authorization' => 'Bearer '.Configure::read('dropbox-api.token'),
                                            ]
                                        ]);

                                        $response_2 = $client_2->post('https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings', json_encode($shared_link_data),['type'=>'json']);
                                        $response_2_data = $response_2->json;

                                        if(isset($response_data['error']))
                                            $upload = false;

                                        if($upload){
                                            $link = $response_2_data['url'];
                                            $pattern = "/dl=0/";
                                            $link_main_photo_candidate = preg_replace($pattern, "dl=1", $link);

                                            $cooperative->cooperative_assets = $link_main_photo_candidate;
                                        }

                                    }

                                }


                        }catch(MainException $e){
                                $upload = false;
                        }
                   }

                   if(isset($upload))
                   {    
                      if(!$upload){}
                     //open a pipe here for image (save it before)
                   }

                   //save cooperative 
                   if($this->Cooperatives->save($cooperative))
                   {
                        $response = 'ok';
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('response'));
                        $this->set('_serialize',['response']);
                   }
                   else
                      throw Exception\BadRequestException(__('error save'));
                }else
                   throw new Exception\BadRequestException(__('error'));
            }

            if($this->request->is('get')){
                if(isset($this->request->query['action'])){
                    switch($this->request->query['action']){
                        case 'modify':

                        break;

                        case 'edit':
                            $query_data = $this->request->query;
                            $cooperative= $this->Cooperatives->get($query_data['cooperative_id']);
                            $this->RequestHandler->renderAs($this, 'json');
                            $this->set(compact('cooperative'));
                            $this->set('_serialize',['cooperative']);
                        break;
                    }

                }
            }

            if($this->request->is('put')){
                $data = $this->request->data;
                $cooperative = $this->Cooperatives->get($data['cooperative']);

                if($cooperative)
                {
                    switch($data['action']){
                        case 'turn_off':
                             $cooperative->deleted = new \DateTime('NOW');
                        break;

                        case'turn_on':
                            $cooperative->deleted = null;
                        break;
                    }

                    if($this->Cooperatives->save($cooperative))
                    {
                        $this->RequestHandler->renderAs($this, 'json');
                        $cooperative = [
                            'deleted' => $cooperative->deleted
                        ];
                        $this->set(compact('cooperative'));
                        $this->set('_serialize',['cooperative']);
                    }
                      else
                         throw new Exception\BadRequestException(__('error not saved'));

                }else
                   throw new Exception\BadRequestException(__('error not found'));

            }
        }
    }

    public function maps(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                if(isset($this->request->query['action']))
                {
                    $cooperatives = $this->Cooperatives->find()
                                                        ->contain(['Zones'])->map(function($row){
                                                            $geoloc = json_decode($row->cooperative_geoloc);

                                                            $row->lat = $geoloc->latitude;
                                                            $row->lon = $geoloc->longitude;

                                                            return $row;
                                                        });
                    $this->RequestHandler->renderAs($this, 'json');
                    $this->set(compact('cooperatives'));
                    $this->set('_serialize',['cooperatives']);
                }

            }
        }

    }

    public function addImageOpaItem(){
        if(!Cache::read('token','token_create_cooperative'))
            Cache::write('token',1,'token_create_cooperative');
        else
            Cache::write('token',(Cache::read('token','token_create_cooperative')+1),'token_create_cooperative');

        $token = Cache::read('token','token_create_cooperative');
        $this->set(compact('token'));
        $this->set('_serialize',['token']);
    }

}
