<?php
namespace App\Controllers\admin;
use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class Home extends Controller
{
    private $Data;
    public function __construct()
    {
        if (Sessao::nivel1()) :
            session_destroy();
            Url::redireciona('home');
        endif;
        $this->Data = $this->model("admin\Usuarios");
    }

    public function index()
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        echo $_SESSION['usuarios_nome'];
        $file='home'; 
        return $this->view('layouts/admin/app',compact('file'));
    }
}

