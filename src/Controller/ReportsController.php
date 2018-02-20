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
use Pheanstalk\Pheanstalk;
use Cake\Filesystem\File;
use Cake\Http\Client;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class  ReportsController extends AppController
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

                    $role = $this->request->session()->read('Auth.User.role.role_denomination');
                    if($role == "auditor"){
                        $reports = $this->Reports->find()
                                                 ->where(['Reports.session_id'=>$this->request->query['session_id'],'Reports.auditor_account_id' => $this->request->session()->read('Auth.User.id')])
                                                 ->contain(['Cooperatives','AuditorAccounts.Auditors','Sessions']);
                    }else
                    {
                        //get reports
                        $reports = $this->Reports->find()
                                                 ->where(['Reports.session_id'=>$this->request->query['session_id']])
                                                 ->contain(['Cooperatives','AuditorAccounts.Auditors','Sessions']);
                    }

                    if(!$reports->isEmpty()){
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('reports'));
                        $this->set('_serialize',['reports']);
                    }else{
                         if($role == "auditor")
                            throw new Exception\ForbiddenException(__('error'));
                         else
                             throw new Exception\BadRequestException(__('error'));

                    }

                }
            }
        }
    }

    public function view(){
        if($this->request->is('ajax')){
            if($this->request->is('get')){
                if(isset($this->request->query['action'])){
                    $report = $this->Reports->find()
                                            ->Where(['Reports.id'=>$this->request->query['id']])
                                            ->contain(['Cooperatives.Zones','AuditorAccounts.Auditors'])
                                            ->first();

                    if(count($report)){
                        $this->RequestHandler->renderAs($this, 'json');
                        $this->set(compact('report'));
                        $this->set('_serialize',['report']);
                    }else
                        throw new Exception\BadRequestException(__('error'));
                }

            }
        }
    }

    public function edit(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $report = $this->Reports->get($data['id']);
                $role = $this->request->session()->read('Auth.User.role.role_denomination');
                
                if($role == "auditor"){
                    if($report->auditor_account_id != $this->request->session()->read('Auth.User.id'))
                       throw new Exception\ForbiddenException(__('error'));
                }else
                {
                    if(count($report)>0)
                    {
                        $report->report_content = json_encode($data['report_content']);
                        $report->report_title = $data['report_title'];
                        $report->cooperative_id = $data['cooperative_id'];
                        $report->session_id = $data['session_id'];

                        if($this->Reports->save($report)){
                            $response = ['message' => 'ok'];
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


    public function edit_master(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $report = $this->Reports->get($data['id']);
                $role = $this->request->session()->read('Auth.User.role.role_denomination');
                
                if($role == "auditor"){
                    if($report->auditor_account_id != $this->request->session()->read('Auth.User.id'))
                       throw new Exception\ForbiddenException(__('error'));
                }

                if(count($report)>0)
                {
                    $report->report_content = json_encode($data['report_content']);
                    $report->report_title = $data['report_title'];
                    $report->cooperative_id = $data['cooperative_id'];
                    $report->session_id = $data['session_id'];

                    //additional sections assets
                    if(isset($data['reports'])){
                        if(count($data['reports'])>0){
                            $all_images_uploaded = true;
                            $saved_images = [];
                            foreach ($data['reports'] as $key => $value){
                                if(isset($value['evidences'])){
                                    foreach ($value['evidences'] as $element => $content){
                                            //save involved images
                                            if($content != 'null'){
                                                     $evidence_path = Text::uuid().".".strtolower(pathinfo($content['name'],PATHINFO_EXTENSION));

                                                     if(!move_uploaded_file($content['tmp_name'], WWW_ROOT.'img/tmp_report_evidences/'.$evidence_path))
                                                     {
                                                       $all_images_uploaded = false;
                                                     }
                                                     else
                                                     {
                                                        $data['reports'][$key]['evidences'][$element] = $evidence_path;
                                                        array_push($saved_images, [$element => $evidence_path]);
                                                     }
                                            }else
                                            {
                                                unset($data['reports'][$key]['evidences'][$element]);
                                            }

                                    }
                                }

                            }
                            
                            if(!$all_images_uploaded)
                            {
                                //open suppression pipe with array elements ($saved_images)
                                $this->deleteLocalAssets($saved_images);
                                throw new Exception\BadRequestException(__('error'));
                            }else
                            {
                                //consolidate reports
                                $merged_content = json_encode(array_merge($data['report_content'],$data['reports']));
                                $report->report_content = $merged_content;
                            }



                        }
                    }

                    if($this->Reports->save($report)){

                            // open pipe for uploading new images
                           if(isset($saved_images)){
                                if(count($saved_images)>0)
                                {
                                    foreach ($saved_images as $key => $value) {
                                        foreach($value as $item => $elm){

                                            $payload = [
                                                'image'=> [
                                                   $item => $elm,
                                                ],
                                                'report_id' => $report->id,
                                                'session_id' => $report->session_id
                                            ];
                                            $pheanstalk = new Pheanstalk('127.0.0.1');
                                            $pheanstalk->useTube('ReportTube');
                                            $pheanstalk->put(json_encode($payload));
                                        }
                                    }
                                }
                           }

                           // open pipe for deleted images
                            if(isset($data['deleted'])){
                                if(count($data['deleted'])>0){
                                    foreach ($data['deleted'] as $key => $value) {
                                        $payload_deleted = [
                                            'image' => [
                                                $data['deleted'][$key]['key'] => $data['deleted'][$key]['value']
                                            ],
                                            'report_id' => $report->id,
                                            'session_id' => $report->session_id
                                        ];
                                                $pheanstalk = new Pheanstalk('127.0.0.1');
                                                $pheanstalk->useTube('ReportDeleteRemoteAssetsTube');
                                                $pheanstalk->put(json_encode($payload_deleted));

                                    }
                                }
                            }

                        $response = ['message' => 'ok'];
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

    public function edit2(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $report = $this->Reports->get($data['id']);
                if(count($report)>0)
                {
                    $report->report_content = json_encode($data['report_content']);
                    $report->report_title = $data['report_title'];
                    $report->cooperative_id = $data['cooperative_id'];
                    $report->session_id = $data['session_id'];

                    //additional sections assets
                    if(isset($data['reports'])){
                        if(count($data['reports'])>0){
                            $all_images_uploaded = true;
                            $saved_images = [];
                            foreach ($data['reports'] as $key => $value){
                                if(isset($value['evidences'])){
                                    foreach ($value['evidences'] as $element => $content){
                                            //save involved images
                                            if($content != 'null'){
                                                     $evidence_path = Text::uuid().".".strtolower(pathinfo($content['name'],PATHINFO_EXTENSION));

                                                     if(!move_uploaded_file($content['tmp_name'], WWW_ROOT.'img/tmp_report_evidences/'.$evidence_path))
                                                     {
                                                       $all_images_uploaded = false;
                                                     }
                                                     else
                                                     {
                                                        $data['reports'][$key]['evidences'][$element] = $evidence_path;
                                                        array_push($saved_images, [$element => $evidence_path]);
                                                     }
                                            }else
                                            {
                                                unset($data['reports'][$key]['evidences'][$element]);
                                            }

                                    }
                                }

                            }
                            
                            if(!$all_images_uploaded)
                            {
                                //open suppression pipe with array elements ($saved_images)
                                $this->deleteLocalAssets($saved_images);
                                throw new Exception\BadRequestException(__('error'));
                            }else
                            {
                                //consolidate reports
                                $merged_content = json_encode(array_merge($data['report_content'],$data['reports']));
                                $report->report_content = $merged_content;
                            }



                        }
                    }

                    if($this->Reports->save($report)){

                            //open pipe for uploading new images
                           // if(isset($saved_images)){
                           //      if(count($saved_images)>0)
                           //      {
                           //          foreach ($saved_images as $key => $value) {
                           //              foreach($value as $item => $elm){

                           //                  $payload = [
                           //                      'image'=> [
                           //                         $item => $elm,
                           //                      ],
                           //                      'report_id' => $report->id,
                           //                      'session_id' => $report->session_id
                           //                  ];
                           //                  $pheanstalk = new Pheanstalk('127.0.0.1');
                           //                  $pheanstalk->useTube('ReportTube');
                           //                  $pheanstalk->put(json_encode($payload));
                           //              }
                           //          }
                           //      }
                           // }

                           //open pipe for deleted images
                            // if(isset($data['deleted'])){
                            //     if(count($data['deleted'])>0){
                            //         foreach ($data['deleted'] as $key => $value) {
                            //             $payload_deleted = [
                            //                 'image' => [
                            //                     $data['deleted'][$key]['key'] => $data['deleted'][$key]['value']
                            //                 ],
                            //                 'report_id' => $report->id,
                            //                 'session_id' => $report->session_id
                            //             ];
                            //                     $pheanstalk = new Pheanstalk('127.0.0.1');
                            //                     $pheanstalk->useTube('ReportDeleteRemoteAssetsTube');
                            //                     $pheanstalk->put(json_encode($payload_deleted));

                            //         }
                            //     }
                            // }

                        //delete classically
                        if(isset($data['deleted'])){
                                if(count($data['deleted'])>0){
                                    foreach ($data['deleted'] as $key => $value) {
                                        $payload_deleted = [
                                            'image' => [
                                                $data['deleted'][$key]['key'] => $data['deleted'][$key]['value']
                                            ],
                                            'report_id' => $report->id,
                                            'session_id' => $report->session_id
                                        ];
                                                // $pheanstalk = new Pheanstalk('127.0.0.1');
                                                // $pheanstalk->useTube('ReportDeleteRemoteAssetsTube');
                                                // $pheanstalk->put(json_encode($payload_deleted));
                                                  foreach ($payload_deleted['image'] as $key => $value){
                                                         try{
                                                                $deleted = true;
                                                                $main_image_candidate_path = "/cooperatives/reports"."/".Text::uuid().".".$value;
                                                                $args_api = ['path'=>$main_image_candidate_path, 'mode'=>'add', 'autorename'=>true,'mute'=>false];
                                                                $client = new Client([
                                                                    'headers' => [
                                                                        'Content-Type' => "application/json",
                                                                        'Authorization' => "Bearer ".Configure::read('dropbox-api.token'),
                                                                    ]
                                                                ]);

                                                     preg_match("/.*\.(png|jpg|bitmap|gif|jpeg)/", $value, $matches);
                                                     $split_chain = preg_split('/\//', $matches[0]);
                                                     $path_to_delete = $split_chain[count($split_chain)-1];

                                                    $deleted_data = [
                                                        'path' => '/cooperatives/reports'.'/'.$path_to_delete
                                                    ];
                                                    $client = new Client([
                                                        'headers' => ['Authorization' => 'Bearer '.Configure::read('dropbox-api.token'), 'Content-Type'=>'json']
                                                    ]);

                                                    $response = $client->post('https://api.dropboxapi.com/2/files/delete_v2', json_encode($deleted_data),['type'=>'json']);

                                                    $response_data = $response->json;

                                                                if(isset($response_data['error']))
                                                                    $deleted = false;

                                                                if($deleted){
                                                                        $indexed_report = $this->Reports->get($payload_deleted['report_id']);
                                                                        $report_content = json_decode($indexed_report->report_content);
                                                                        foreach ($report_content as $y => $z){
                                                                          foreach($z->evidences as $a => $b){
                                                                            if($z->evidences->$a == $value)
                                                                              unset($z->evidences->$a);
                                                                          }
                                                                        }
                                                                        $indexed_report->report_content = json_encode($report_content);
                                                                        $indexed_report->dirty('report_content',true);
                                                                        if(!$this->Reports->save($indexed_report))
                                                                          $deleted = false;
                                                                    }else
                                                                        $deleted = false;

                                                            }catch(MainException $e){
                                                                $deleted = false;
                                                            }
                                                      }


                                    }
                                }
                            }


                        //saved classically
                        if(isset($saved_images)){
                          if(count($saved_images)>0){
                                            foreach ($saved_images as $key => $value) {
                                                foreach($value as $item => $elm){

                                                    $payload = [
                                                        'image'=> [
                                                           $item => $elm,
                                                        ],
                                                        'report_id' => $report->id,
                                                        'session_id' => $report->session_id
                                                    ];

                                                  foreach ($payload['image'] as $key => $value){
                                                     try{
                                                            $upload = true;
                                                            $main_image_candidate_path = "/cooperatives/reports"."/".Text::uuid().".".$value;
                                                            $args_api = ['path'=>$main_image_candidate_path, 'mode'=>'add', 'autorename'=>true,'mute'=>false];
                                                            $client = new Client([
                                                                'headers' => [
                                                                    'Content-Type' => "application/octet-stream",
                                                                    'Authorization' => "Bearer ".Configure::read('dropbox-api.token'),
                                                                    'Dropbox-API-Arg' => json_encode($args_api),
                                                                ]
                                                            ]);
                                                            $file = new File(WWW_ROOT.'img/tmp_report_evidences/'.$value);
                                                            $response = $client->post('https://content.dropboxapi.com/2/files/upload',$file->read());
                                                            $response_data = $response->json;

                                                            if(isset($response_data['error']))
                                                                $upload = false;


                                                            if($upload)
                                                            {

                                                                $unlink = unlink(WWW_ROOT.'img/tmp_report_evidences/'.$value);
                                                                if(!$unlink)
                                                                  $upload = false;

                                                                if($upload){    

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

                                                                            $indexed_report = $this->Reports->get($payload['report_id']);
                                                                            $report_content = json_decode($indexed_report->report_content);
                                                                            foreach ($report_content as $y => $z){
                                                                              foreach($z->evidences as $a => $b){
                                                                                if($z->evidences->$a == $value)
                                                                                   $z->evidences->$a = $link_main_photo_candidate;
                                                                              }
                                                                            }
                                                                            $indexed_report->report_content = json_encode($report_content);
                                                                            $indexed_report->dirty('report_content',true);
                                                                            if(!$this->Reports->save($indexed_report))
                                                                              $upload = false;
                                                                        }else
                                                                            $upload = false;
                                                                }else
                                                                    $upload = false;
                                                            }else
                                                                $upload =false;


                                                        }catch(MainException $e){
                                                            $upload = false;
                                                        }
                                                    }

                                                }
                                            }
                                        }
                        }
         


                        $response = ['message' => 'ok'];
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

    public function addItemReport(){    
            if($this->request->is('ajax')){
                if($this->request->is('get')){
                        if(!Cache::read('token','token_create_report_item'))
                            Cache::write('token',1,'token_create_report_item');
                        else
                            Cache::write('token',(Cache::read('token','token_create_report_item')+1),'token_create_report_item');

                        $token = Cache::read('token','token_create_report_item');
                        $this->set(compact('token'));
                        $this->set('_serialize',['token']);
                }
            }
    }

    public function create(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                //verify if session expired
                $this->loadModel('Sessions');
                $session = $this->Sessions->get($data['session_id']);
                $now_date = new \DateTime('NOW');
                $session_date = new \DateTime($session->session_end_date);

                //checking if session expired
                if($session_date < $now_date) 
                    throw new Exception\ForbiddenException(__('error'));
                else{
                        $all_images_uploaded = true;
                        $saved_images = [];

                        foreach ($data['reports']['evidences'] as $key => $value){
                            if(isset($value['tmp_name'])){
                                //save involved assets
                                                 $evidence_path = Text::uuid().".".strtolower(pathinfo($value['name'],PATHINFO_EXTENSION));

                                                 if(!move_uploaded_file($value['tmp_name'], WWW_ROOT.'img/tmp_report_evidences/'.$evidence_path))
                                                 {
                                                   $all_images_uploaded = false;
                                                 }
                                                 else
                                                 {
                                                    $data['reports']['evidences'][$key] = $evidence_path;
                                                    array_push($saved_images, [ $key => $evidence_path ]);
                                                 }
                            }else{
                                unset($data['reports']['evidences'][$key]);
                            }
                        }

                        if(!$all_images_uploaded)
                        {
                            //open suppression pipe with array elements ($saved_images)
                            $this->deleteLocalAssets($saved_images);
                            throw new Exception\BadRequestException(__('error'));
                        }
                        else
                        {
                            $report = $this->Reports->newEntity($data);
                            $now = new \DateTime('NOW');
                            $report->report_content = json_encode($data['reports']);
                            $report->report_code = 'R-'.$now->format('Y-m-d').Text::uuid();
                            $report->auditor_account_id = $this->request->session()->read('Auth.User.id');
                             //save images before opening pipeline job
                            if(!$report->errors()){
                                if($this->Reports->save($report))
                                {
                                    //open pipe wih array_images
                                    if(count($saved_images)>0)
                                    {
                                        foreach ($saved_images as $key => $value) {
                                            foreach($value as $item=>$item_desc){
                                                $payload = [
                                                    'image'=> [
                                                       $item => $item_desc,
                                                    ],
                                                    'report_id' => $report->id,
                                                    'session_id' => $report->session_id
                                                ];
                                                $pheanstalk = new Pheanstalk('127.0.0.1');
                                                $pheanstalk->useTube('ReportTube');
                                                $pheanstalk->put(json_encode($payload)); 
                                            }
                                        }
                                    }

                                    $response = ['message'=>'ok'];
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
            if($this->request->is('get')){

            }
        }
    }

    public function create_master(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                //verify if session expired
                $this->loadModel('Sessions');
                $session = $this->Sessions->get($data['session_id']);
                $now_date = new \DateTime('NOW');
                
                //checking if session expired
                if($session->session_end_date < $now_date) 
                    throw new Exception\ForbiddenException(__('error'));

                $all_images_uploaded = true;
                $saved_images = [];
                foreach ($data['reports'] as $key => $value){
                    if(isset($value['evidences'])){
                        foreach ($value['evidences'] as $element => $content){
                                //save involved images
                                if($content != 'null'){
                                         $evidence_path = Text::uuid().".".strtolower(pathinfo($content['name'],PATHINFO_EXTENSION));

                                         if(!move_uploaded_file($content['tmp_name'], WWW_ROOT.'img/tmp_report_evidences/'.$evidence_path))
                                         {
                                           $all_images_uploaded = false;
                                         }
                                         else
                                         {
                                            $data['reports'][$key]['evidences'][$element] = $evidence_path;
                                            array_push($saved_images, [$element => $evidence_path]);
                                         }
                                }else
                                {
                                    unset($data['reports'][$key]['evidences'][$element]);
                                }

                        }
                    }

                }

                if(!$all_images_uploaded)
                {
                    //open suppression pipe with array elements ($saved_images)
                    $this->deleteLocalAssets($saved_images);
                    throw new Exception\BadRequestException(__('error'));
                }
                else
                {
                    $report = $this->Reports->newEntity($data);
                    $now = new \DateTime('NOW');
                    $report->report_content = json_encode($data['reports']);
                    $report->report_code = 'R-'.$now->format('Y-m-d').Text::uuid();
                    $report->auditor_account_id = $this->request->session()->read('Auth.User.id');
                     //save images before opening pipeline job
                    if(!$report->errors()){
                        if($this->Reports->save($report))
                        {
                            //open pipe wih array_images
                            if(count($saved_images)>0)
                            {
                                foreach ($saved_images as $key => $value) {
                                    foreach($value as $item => $elm){

                                        $payload = [
                                            'image'=> [
                                               $item => $elm,
                                            ],
                                            'report_id' => $report->id,
                                            'session_id' => $report->session_id
                                        ];
                                        $pheanstalk = new Pheanstalk('127.0.0.1');
                                        $pheanstalk->useTube('ReportTube');
                                        $pheanstalk->put(json_encode($payload));
                                    }
                                }
                            }

                            $response = ['message'=>'ok'];
                            $this->RequestHandler->renderAs($this, 'json');
                            $this->set(compact('response'));
                            $this->set('_serialize',['response']);
                        }else
                          throw new Exception\BadRequestException(__('error'));
                    }else
                       throw new Exception\BadRequestException(__('error'));
                }


            }
            if($this->request->is('get')){

            }
        }
    }

    public function create2(){
        if($this->request->is('ajax')){
            if($this->request->is('post')){
                $data = $this->request->data;
                $all_images_uploaded = true;
                $saved_images = [];

                foreach ($data['reports'] as $key => $value){
                    if(isset($value['evidences'])){
                        foreach ($value['evidences'] as $element => $content){
                                //save involved images
                                if($content != 'null'){
                                         $evidence_path = Text::uuid().".".strtolower(pathinfo($content['name'],PATHINFO_EXTENSION));

                                         if(!move_uploaded_file($content['tmp_name'], WWW_ROOT.'img/tmp_report_evidences/'.$evidence_path))
                                         {
                                           $all_images_uploaded = false;
                                         }
                                         else
                                         {
                                            $data['reports'][$key]['evidences'][$element] = $evidence_path;
                                            array_push($saved_images, [$element => $evidence_path]);
                                         }
                                }else
                                {
                                    unset($data['reports'][$key]['evidences'][$element]);
                                }

                        }
                    }

                }



                if(!$all_images_uploaded)
                {

                            if(count($saved_images)>0)
                            {
                                foreach ($saved_images as $key => $value) {
                                    foreach($value as $item => $elm){

                                        $payload = [
                                            'image'=> [
                                               $item => $elm,
                                            ]
                                        ];
                                         foreach ($payload['image'] as $key => $value){
                                            unlink(WWW_ROOT.'img/tmp_report_evidences/'.$value);
                                         }
                                    }
                                }
                            }
                    throw new Exception\BadRequestException(__('error'));
                }
                else
                {
                    $report = $this->Reports->newEntity($data);
                    $now = new \DateTime('NOW');
                    $report->report_content = json_encode($data['reports']);
                    $report->report_code = 'R-'.$now->format('Y-m-d').Text::uuid();
                    $report->auditor_account_id = $this->request->session()->read('Auth.User.id');
                     //save images before opening pipeline job
                    if(!$report->errors()){
                        if($this->Reports->save($report))
                        {
                                //open pipe wih array_images
                             if(count($saved_images)>0){
                                foreach ($saved_images as $key => $value) {
                                    foreach($value as $item => $elm){

                                        $payload = [
                                            'image'=> [
                                               $item => $elm,
                                            ],
                                            'report_id' => $report->id,
                                            'session_id' => $report->session_id
                                        ];

                                      foreach ($payload['image'] as $key => $value){
                                         try{
                                                $upload = true;
                                                $main_image_candidate_path = "/cooperatives/reports"."/".Text::uuid().".".$value;
                                                $args_api = ['path'=>$main_image_candidate_path, 'mode'=>'add', 'autorename'=>true,'mute'=>false];
                                                $client = new Client([
                                                    'headers' => [
                                                        'Content-Type' => "application/octet-stream",
                                                        'Authorization' => "Bearer ".Configure::read('dropbox-api.token'),
                                                        'Dropbox-API-Arg' => json_encode($args_api),
                                                    ]
                                                ]);
                                                $file = new File(WWW_ROOT.'img/tmp_report_evidences/'.$value);
                                                $response = $client->post('https://content.dropboxapi.com/2/files/upload',$file->read());
                                                $response_data = $response->json;

                                                if(isset($response_data['error']))
                                                    $upload = false;


                                                if($upload)
                                                {

                                                    $unlink = unlink(WWW_ROOT.'img/tmp_report_evidences/'.$value);
                                                    if(!$unlink)
                                                      $upload = false;

                                                    if($upload){    

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

                                                                $indexed_report = $this->Reports->get($payload['report_id']);
                                                                $report_content = json_decode($indexed_report->report_content);
                                                                foreach ($report_content as $y => $z){
                                                                  foreach($z->evidences as $a => $b){
                                                                    if($z->evidences->$a == $value)
                                                                       $z->evidences->$a = $link_main_photo_candidate;
                                                                  }
                                                                }
                                                                $indexed_report->report_content = json_encode($report_content);
                                                                $indexed_report->dirty('report_content',true);
                                                                if(!$this->Reports->save($indexed_report))
                                                                  $upload = false;
                                                            }else
                                                                $upload = false;
                                                    }else
                                                        $upload = false;
                                                }else
                                                    $upload =false;


                                            }catch(MainException $e){
                                                $upload = false;
                                            }
                                        }

                                    }
                                }
                            }

                                $response = ['message'=>'ok'];
                                $this->RequestHandler->renderAs($this, 'json');
                                $this->set(compact('response'));
                                $this->set('_serialize',['response']);
                        }else
                          throw new Exception\BadRequestException(__('error'));
                    }else
                       throw new Exception\BadRequestException(__('error'));
                }


            }
            if($this->request->is('get')){
                $this->render('create');
            }
        } 
    }


    private function deleteLocalAssets($saved_images){
                            //open pipe wih array_images
                            if(count($saved_images)>0)
                            {
                                foreach ($saved_images as $key => $value) {
                                    foreach($value as $item => $elm){

                                        $payload = [
                                            'image'=> [
                                               $item => $elm,
                                            ]
                                        ];
                                        $pheanstalk = new Pheanstalk('127.0.0.1');
                                        $pheanstalk->useTube('ReportDeleteLocalAssetsTube');
                                        $pheanstalk->put(json_encode($payload));
                                    }
                                }
                            }
    }

    private function deleteRemoteAssets($saved_images, $report_id, $session_id){
                            //open pipe wih array_images
                            if(count($saved_images)>0)
                            {
                                foreach ($saved_images as $key => $value) {
                                    foreach($value as $item => $elm){

                                        $payload = [
                                            'image'=> [
                                               $item => $elm,
                                            ],
                                            'report_id' => $report->id,
                                            'session_id' => $report->session_id
                                        ];
                                        $pheanstalk = new Pheanstalk('127.0.0.1');
                                        $pheanstalk->useTube('ReportDeleteRemoteAssetsTube');
                                        $pheanstalk->put(json_encode($payload));
                                    }
                                }
                            }
    }

}
