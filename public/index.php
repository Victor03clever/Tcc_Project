<?php
session_start();
ob_start();
// use App\Libraries\Router;
include '../app/config/phperror.php';
include '../vendor/autoload.php';
include '../app/config/config.php';

use  App\Http\Router;





$route=new Router(URL);

include '../app/Routes/Page.php';

$route->run()->sendResponse();
        


foreach ($helpers as $key => $value) {
    $helper = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'app' 
    . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . str_replace('.php','',$value).'.php';
    if (file_exists($helper)) require_once $helper;
}







