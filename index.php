<?php

require __DIR__ . '/vendor/System/Application.php';
require __DIR__ . '/vendor/System/File.php';

use System\File;
use System\Application;
use App\Controllers\Feature\ControllersTest;
 
//Test the importation of files from vendor/ & App/ folder and the performance of classes
$file = new File(__DIR__);
$app = new Application($file);

var_dump($file);
var_dump($app);

new System\System();
new ControllersTest();
