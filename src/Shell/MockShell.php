<?php 
namespace App\Shell;

use Cake\Console\Shell;

class MockShell extends Shell
{
    public function main()
    {
        $this->out('Hello world.');
    }

    public function hi($name = 'Anonymous'){
    	$this->out('Hey there '. $name);
    }

    
    
}
