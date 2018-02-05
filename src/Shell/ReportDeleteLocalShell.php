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

class ReportDeleteLocalShell extends Shell
{

  public function main()
  {
    $this->listenDeleteLocal();
  }

  public function listenDeleteLocal(){
      $client_3 = new Pheanstalk('127.0.0.1');
    $client_3->watch('ReportDeleteLocalAssetsTube');

    while($job = $client_3->reserve()){
      $payload =json_decode($job->getData(),true);

          $status = $this->deleteLocal($payload);
          if($status)
          {
            $client_3->delete($job);
            $this->out('Job Delete');
          }
          else
          {
            $client_3->bury($job);
            $this->out('Job Burried');
          }
    }
  }

  public function deleteLocal($payload){
      $delete = true;
      foreach ($payload['image'] as $key => $value){
                                     try{
                                        if(!(unlink(WWW_ROOT.'img/tmp_report_evidences/'.$value)))
                                          $delete = false;
                                        }catch(MainException $e){
                                            $delete = false;
                                        }
      }

                            return $delete;
  }



}