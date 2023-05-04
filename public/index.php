<?php
session_start();
ob_start();
use App\Libraries\Router;
include '../app/config/phperror.php';
include '../vendor/autoload.php';
include '../app/config/config.php';
date_default_timezone_set('Africa/Luanda');







$route=new Router();

        


foreach ($helpers as $key => $value) {
    $helper = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'app' 
    . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . str_replace('.php','',$value).'.php';
    if (file_exists($helper)) require_once $helper;
}







