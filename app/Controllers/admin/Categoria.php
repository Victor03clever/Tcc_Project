<?php
namespace App\Controllers\admin;

use App\Libraries\Controller;
use App\Helpers\Sessao;
use App\Helpers\Url;

class Categoria extends Controller
{
    private $data;
    public function __construct()
    {
        if (Sessao::nivel1()) :
            session_destroy();
            Url::redireciona('home');
        endif;
        // $this->data = $this->model("admin");
    }

    public function index()
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;
        echo "Listar categorias";
    }

    public function cadastrar()
    {
        if (!Sessao::nivel0()) :
            Url::redireciona('home');
        endif;


        $file="cadastrar_categoria";
        return $this->view('layouts/admin/app',compact('file'));
    }
}