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
                    //get reports

                }
            }
        }
    }

    public function edit(){

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
                $all_images_uploaded = true;
                $saved_images = [];
                foreach ($data['reports'] as $key => $value) {
                    foreach ($value as $element => $content) {
                        if(preg_match('/evidence/', $element))
                         {
                            //save involved images
                             $evidence_path = Text::uuid().".".strtolower(pathinfo($content['name'],PATHINFO_EXTENSION));

                             if(!move_uploaded_file($content['tmp_name'], WWW_ROOT.'img/tmp_report_evidences/'.$evidence_path))
                             {
                               $all_images_uploaded = false;
                             }
                             else
                             {
                                $data['reports'][$key][$element] = $evidence_path;
                                array_push($saved_images, [$element => $evidence_path]);
                             }
                         }
                    }
                }

                if(!$all_images_uploaded)
                {
                    //open suppression pipe with array elements ($saved_images)
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
                            foreach ($saved_images as $key => $value) {
                                foreach($value as $item => $elm){

                                    $payload = [
                                        'image'=> [
                                           $item => $elm,
                                        ],
                                        'report_id' => $report->id,
                                        'session_id' => $report->session_id
                                    ];
                                    // $pheanstalk = new Pheanstalk('127.0.0.1');
                                    // $pheanstalk->useTube('ReportTube')
                                    // $pheanstalk->put(json_encode($payload));
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

}
