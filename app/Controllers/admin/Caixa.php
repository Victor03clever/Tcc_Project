<?php
namespace App\Controllers\admin;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;

class Caixa extends Controller{
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
    $file='caixa'.DIRECTORY_SEPARATOR.'caixa';
    $this->view('layouts/admin/app',compact('file'));
  }
}