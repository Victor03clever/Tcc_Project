<?php
namespace App\Controllers\admin;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class Relatorio extends Controller{
  private $Data;
  public function __construct()
  {
    // $this->Data = $this->model("admin\Vendas");
    if (Sessao::nivel1()) :
      session_destroy();
      Url::redireciona('home');
    endif;
   
  }
  public function index(){
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $file='relatorio'.DIRECTORY_SEPARATOR.'relatorio';
    $this->view('layouts/admin/app',compact('file'));
  }
}