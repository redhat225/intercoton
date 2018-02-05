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

class ReportDeleteRemoteShell extends Shell
{

  public function main()
  {
    $this->listenDeleteRemote();
  }

  public function listenDeleteRemote()
  {
    $client_2 = new Pheanstalk('127.0.0.1');
    $client_2->watch('ReportDeleteRemoteAssetsTube');

    while($job = $client_2->reserve()){
      $payload =json_decode($job->getData(),true);

          $status = $this->deleteRemote($payload);
          if($status)
          {
            $client_2->delete($job);
            $this->out('Job Delete');
          }
          else
          {
            $client_2->bury($job);
            $this->out('Job Burried');
          }
    }
  }


  public function deleteRemote($payload){
      foreach ($payload['image'] as $key => $value){
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
                                              $this->loadModel('Reports');
                                                    $indexed_report = $this->Reports->get($payload['report_id']);
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

                            return $deleted;
  }



}