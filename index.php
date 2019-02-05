<?php

require __DIR__ . '/vendor/System/Application.php';
require __DIR__ . '/vendor/System/File.php';

use System\File;
use System\Application;
use App\Controllers\Feature\ControllersTest;
 
//Test the importation of files from vendor/ & App/ folder and the performance of classes
$file = new File(__DIR__);
$app = new Application($file);

new System\System();
new ControllersTest();


$app->run();

//Test Session
$app->session->set('key', 'value');
$app->session->set('key2', 2);
var_dump($app->session->get('key'));
var_dump($app->session->all());
var_dump($app->session->pull('key2'));
var_dump($app->session->pull('noKey'));
var_dump($app->session->remove('NoKey'));
var_dump($app->session->remove('key'));
var_dump($app->session->all());
var_dump($app->session->destroy());
var_dump($app->session->appSession());