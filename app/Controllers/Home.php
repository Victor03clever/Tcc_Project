<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class  Home  extends Controller
{
    public static function class($controller)
    {
        return $controller();
    }
    public function index($id){
    
        echo '<pre>';
        var_dump($id);
        echo '</pre>';
    $this->view('homepage');
        
    }
}