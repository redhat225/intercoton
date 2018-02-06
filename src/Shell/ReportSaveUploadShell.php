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

class ReportSaveUploadShell extends Shell
{

  public function main()
  {
    $this->listen();
  }

  public function listen(){
      $client = new Pheanstalk('127.0.0.1');
      $client->watch('ReportSaveUploadTube');

    while($job = $client->reserve()){
      $payload =json_decode($job->getData(),true);

          $status = $this->save($payload);
          if($status)
          {
            $client->delete($job);
            $this->out('Save Upload Job Delete');
          }
          else
          {
            $client->bury($job);
            $this->out('Save Upload Job Burried');
          }
    }
  }

  public function save($payload){
          $save = true;
          $this->loadModel('Reports');
          $report = $this->Reports->get($payload['id_report']);
          $report->report_content = $payload['payload'];
          try{
            $this->Reports->save($report);
          }catch(MainException $e){
            $save = false;
          }
          return $save;
  }



}