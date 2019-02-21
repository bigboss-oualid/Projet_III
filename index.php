<?php

require __DIR__ . '/vendor/System/Application.php';
require __DIR__ . '/vendor/System/File.php';

use System\File;
use System\Application;



$file = new File(__DIR__);
$app =  Application::getInstance($file);

//Application test

echo "Application: ";
$app->run();

//session and Cookie test through lazy loading mode 
$app->session->set('Last_name','Big');
$app->cookie->set('first_name','Boss');
echo "Session: ";
pre($_SESSION);
echo "Cookie : ";
pre($_COOKIE);

//test import files from App folder
use App\Controllers\Feature\ControllersTest;
echo "App folder:";
new ControllersTest();

echo "Route :";
$app->route->add('/', 'Home');

echo "Url :  ";
pre($app->url->link('home') . '<br>');
pre(assets('images/logo.png'). '<br>');

echo "Database :   ";
pre($app->db->connectionDb());

echo "HTml :  ";
$app->html->setTitle('My Title');
pre($app->html->title());

echo 'Request :   ';
pre($app->request->method());

