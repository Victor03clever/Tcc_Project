<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Valida;
use App\Helpers\Url;
use App\Libraries\uploads;
use App\Libraries\Controller;

class  Saler  extends Controller
{
  private $Data;
  private $Food;
  public function __construct()
  {
    $this->Data = $this->model("Saler\Usuarios");

    if (Sessao::nivel0()) :
      session_destroy();
      Url::redireciona('client/login');
    endif;
    $this->Food = $this->model("client\Home");

  }

  public function index()
  {
    if (!Sessao::nivel1()) :
      Url::redireciona("saler/login");
    else :
      Url::redireciona("saler/home");
    endif;

    exit;
  }


  public function login()
  {
    if (Sessao::nivel1()) :
      Url::redireciona("saler"); 

    endif;

    $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //  var_dump($formulario);
    if (isset($formulario['btn_log'])) :
      $dados = [
        'nome' => trim($formulario['nome']),
        'senha' => trim($formulario['senha']),
        'err_nome' => '',
        'err_senha' => ''
      ];

      if (in_array("", $formulario)) :

        if (empty($formulario['nome'])) :
          $dados['err_nome'] = "preencha o campo nome";
          Sessao::izitoast('loginE', 'Erro', 'Preencha todos campos:*nome', 'error');

        endif;

        if (empty($formulario['senha'])) :
          $dados['err_senha'] = "preencha o campo senha";
          Sessao::izitoast('loginE', 'Erro', 'Preencha todos campos:*senha', 'error');

        endif;

      else :

        $checarlogin = $this->Data->checalogin($dados['nome'], $dados['senha'], 1);
        // var_dump($checarlogin);
        // exit;
        if ($checarlogin) :

          Sessao::izitoast('loginS', 'Bemvindo', 'Login realizado com sucesso');
          Url::redireciona('saler');
          $this->criarsessao($checarlogin);
          // var_dump($_SESSION);
          exit;

        else :
          Sessao::izitoast('loginE', 'Erro', 'Nome ou senha estão errados', 'error'); 
          $dados['err_nome'] = "Dados invalidos";
          $dados['err_senha'] = "Dados invalidos";
        endif;



      endif;
    //  var_dump($formulario);
    else :
      $dados = [
        'nome' => '',
        'senha' => '',
        'err_nome' => '',
        'err_senha' => ''
      ];
    endif;

    $this->view('client/makelogin', compact('dados'));
  }

  private function  criarsessao($usuario)
  { 

    $_SESSION['usuarioS_id'] = $usuario['usuario_id'];
    $_SESSION['usuarioS_nome'] = $usuario['u_nome'];
    $_SESSION['usuarioS_email'] = $usuario['email'];
    $_SESSION['usuarioS_img'] = !empty($usuario['imagem']) ? URL . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $usuario['imagem'] : URL . '/public/img/user-logo.jpg';
  }
  public function sair()
  {
    unset($_SESSION['usuarioS_id']);
    unset($_SESSION['usuarioS_nome']);
    unset($_SESSION['usuarioS_email']);
    unset($_SESSION['usuarioS_img']);
    session_destroy();
    Url::redireciona('saler/login');
  }
  public function home(){
    if (!Sessao::nivel1()) :
      Url::redireciona("saler/login");
    endif;
    $allFood = $this->Food->getFood();
    $allcategory = $this->Food->getCategory();

    


    $file="home";
    $this->view('layouts/saler/app', compact('file','allFood','allcategory'));
  }
}
