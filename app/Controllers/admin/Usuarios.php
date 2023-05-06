<?php

namespace App\Controllers\admin;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Helpers\Valida;
use App\Libraries\Controller;

class Usuarios extends Controller
{
  private $Data;
  public function __construct()
  {
    $this->Data = $this->model("admin\Usuarios");
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
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $users = $this->Data->getUsers();
    if (isset($form['save'])) {
      $dados = ['nome' => trim($form['nome']), 'email' => trim($form['email']), 'senha' => trim($form['senha']), 'nivel' => trim($form['nivel']), 'error' => ''];
      if (in_array("", $form)) {
        if (empty($form['nome'])) {
          $dados['error'] = 'Preencha todos os campos';
          Sessao::izitoast("user", "Alert", "Tente novamente", "warning");
        }
        if (empty($form['email'])) {
          $dados['error'] = 'Preencha todos os campos';
          Sessao::izitoast("user", "Alert", "Tente novamente", "warning");
        }
        if (empty($form['senha'])) {
          $dados['error'] = 'Preencha todos os campos';
          Sessao::izitoast("user", "Alert", "Tente novamente", "warning");
        }
        if (empty($form['nivel'])) {
          $dados['error'] = 'Preencha todos os campos';
          Sessao::izitoast("user", "Alert", "Tente novamente", "warning");
        }
      } else {
        if (Valida::email($dados['email'])) {
          $dados['error'] = 'Preencha corretamente o email';
          Sessao::izitoast("user", "Alert", "Tente novamente", "warning");
        } elseif ($this->Data->checanome($dados['nome'])) {
          $dados['error'] = 'Nome escolhido já cadastrado no nosso sistema';
          Sessao::izitoast("user", "Alert", "Tente novamente", "warning");
        } else {
          $dados['senha'] = Valida::pass_segura($dados['senha']);
          $save = $this->Data->createUser($dados);
          if ($save) {
            Sessao::izitoast("user", "Success", "Usuario criado com sucesso");
          } else {
            Sessao::izitoast("user", "Error", "Usuario não criado", "error");
          }
        }
      }
    } else {
      $dados = [];
    }
    $file = "usuarios" . DIRECTORY_SEPARATOR . "usuarios";
    $this->view("layouts/admin/app", compact('file', 'dados','users'));
  }
  public function delete($id)
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
    
    if ($id and $metodo == 'POST') :
      
      if($_POST['nivel']=='1'){
        Sessao::izitoast('user', 'Error', 'Não pode eliminar um administrador','error');
        Url::redireciona("admin/usuarios");
        exit;
      }else{
        $delete = $this->Data->deleteUser($id);
      if ($delete) :
        Sessao::izitoast('user', 'Success', 'Delectado com sucesso');
        Url::redireciona("admin/usuarios");
        exit;
        else :
        Sessao::izitoast('user', 'Erro', 'Não delectado, consulte BD', 'error');
        Url::redireciona("admin/usuarios");
        exit;
      endif;
      }
    else :
      Sessao::sms('sms', 'Metodo de envio \'GET\' não é permitido', 'alert alert-danger');
      Url::redireciona("admin/usuarios");
      exit;

    endif;
  }
  // clientes
  public function clientes(){
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $users=$this->Data->getUsersC();
    
    $file = "usuarios" . DIRECTORY_SEPARATOR . "clientes";
    $this->view("layouts/admin/app", compact('file','users'));
  }
  public function deleteC($id)
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
    
    if ($id and $metodo == 'POST') :
      $delete = $this->Data->deleteUserC($id);
      if ($delete) :
        Sessao::izitoast('user', 'Success', 'Delectado com sucesso');
        Url::redireciona("admin/usuarios/clientes");
        exit;
        else :
        Sessao::izitoast('user', 'Erro', 'Não delectado, consulte BD', 'error');
        Url::redireciona("admin/usuarios/clientes");
        exit;
      endif;
    else :
      Sessao::sms('sms', 'Metodo de envio \'GET\' não é permitido', 'alert alert-danger');
      Url::redireciona("admin/usuarios/clientes");
      exit;
  
    endif;
  }
}
