<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class  Home  extends Controller
{
    
    public function index(){
        if (Sessao::nivel2()) :
            Url::redireciona('client');
        endif;
        
        $file = 'homepage';
        return $this->view('layouts/client/app', compact('file'));
        
    }
}