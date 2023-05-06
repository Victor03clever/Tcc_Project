<?php
namespace App\Controllers\admin;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;
use App\Models\admin\Venda;

class Vendas extends Controller{
  private $Data;
  public function __construct()
  {
    $this->Data = $this->model("admin\Venda");
    if (Sessao::nivel1()) :
      session_destroy();
      Url::redireciona('home');
    endif;
  }
  public function index()
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $sales=$this->Data->getSales();
    // $produto=Venda::getP('7');
    // var_dump($sales);
    // exit;
    
    $file='vendas'.DIRECTORY_SEPARATOR.'vendas';
    $this->view('layouts/admin/app',compact('file','sales'));
  }

  public function deleteV($id){
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
    
    if ($id and $metodo == 'POST') :
      $delete = $this->Data->deleteSale($id);
      if ($delete) :
        Sessao::izitoast('user', 'Success', 'Delectado com sucesso');
        Url::redireciona("admin/vendas");
        exit;
        else :
        Sessao::izitoast('user', 'Erro', 'Não delectado, consulte BD', 'error');
        Url::redireciona("admin/vendas");
        exit;
      endif;
    else :
      Sessao::sms('sms', 'Metodo de envio \'GET\' não é permitido', 'alert alert-danger');
      Url::redireciona("admin/vendas");
      exit;
  
    endif;
  }

  public function pedidos(){
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $pedidos=$this->Data->getAllRequest();
    // var_dump($pedidos);
    // exit;
    $file='vendas'.DIRECTORY_SEPARATOR.'pedidos';
    $this->view("layouts/admin/app",compact('file','pedidos'));
  }
  

}