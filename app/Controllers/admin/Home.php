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
        $this->Data = $this->model("admin\Usuarios");
    }

    public function index()
    {
        if (Sessao::nivel1()) :
            Url::redireciona('home');
        endif;
        echo $_SESSION['usuarios_nome'];
        $file='php'; 
        return $this->view('layouts/admin/app',compact('file'));
    }
}

