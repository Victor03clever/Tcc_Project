<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class  Home  extends Controller
{
    private $Food;
    public function __construct()
    {
        $this->Food = $this->model("client\Home");
        
    }
    public function index(){
        if (Sessao::nivel2()) :
            Url::redireciona('client');
        endif;
        $allFood= $this->Food->getFood();
       
        $file = 'homepage';
        return $this->view('layouts/client/app', compact('file', 'allFood'));
        
    }
}