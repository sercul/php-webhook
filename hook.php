<?php

require_once('inc.php');
header('Content-Type: text/plain');
if (file_exists('key.php'))
{
    $key = require('key.php');
    if ($key['current'] === $_SERVER['QUERY_STRING'])
    {
        $submodule = getcwd();
        $project = $submodule.'/../../../';
        chdir(dirname($project));
        _exec('pwd');
        _exec('git pull');
        _exec('git submodule update');
        
        _exec('php yiic migrate --interactive=0');
        _exec('chmod -R 0777 assets');
        $all_files = glob('path/to/assets/*');
        foreach($all_files as $one_file){ 
          if(is_file($one_file))
            unlink($one_file); 
        }
        

    }
}

_log(var_export($_POST, true));
