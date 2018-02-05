<?php 
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Pheanstalk\Pheanstalk;
use \Exception as MainException;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Http\Client;
use Cake\Utility\Text;

class ReportUploadShell extends Shell
{

  public function main(){
    $this->listen();
  }

  public function listen(){
    $client = new Pheanstalk('127.0.0.1');
    $client->watch('ReportTube');

    while($job = $client->reserve()){
      $payload =json_decode($job->getData(),true);

          $status = $this->upload($payload);
          if($status)
          {
            $client->delete($job);
            $this->out('Job Delete');
          }
          else
          {
            $client->bury($job);
            $this->out('Job Burried');
          }
    }
  }


  public function upload($payload){
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

                                            if($upload){
                                                //unlink data
                                                if(!(unlink(WWW_ROOT.'img/tmp_report_evidences/'.$value)))
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
                                                            $this->loadModel('Reports');

                                                            $indexed_report = $this->Reports->get($payload['report_id']);
                                                            $report_content = json_decode($indexed_report->report_content);
                                                            foreach ($report_content as $y => $z) {
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
                                              $upload = false;


                                        }catch(MainException $e){
                                            $upload = false;
                                        }
                                  }

                            return $upload;
  }


}