<?php
session_start();
ob_start();
include '../app/config/phperror.php';
include '../vendor/autoload.php';
include '../app/config/config.php';
use App\Helpers\Sessao;
use App\Libraries\Router;
// ( new App\config\Environment(dirname(__DIR__)))->load();

// Carregando arquivos dotenv


// load(dirname(__DIR__));

$rota = new Router;
// print_r(getenv()) ;echo'<br>';

foreach ($helpers as $key => $value) {
    $helper = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'app' 
    . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . str_replace('.php','',$value).'.php';
    if (file_exists($helper)) require_once $helper;
}







