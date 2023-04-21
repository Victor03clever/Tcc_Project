<?php

namespace App\Controllers\admin;

use App\Helpers\Url;
use App\Helpers\Sessao;
use App\Libraries\Controller;
use App\Helpers\Valida;
use App\Libraries\Uploads;
use LDAP\Result;

class fornecedores extends Controller
{
  private $Data;
  public function __construct()
  {
    if (Sessao::nivel1()) :
      session_destroy();
      Url::redireciona('home');
    endif;
    $this->Data = $this->model("admin\Fornecedores");
  }

  public function index()
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;

    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // var_dump($form);
    if (isset($form)) {
      $dados = ['nome' => trim($form['nome']), 'email' => trim($form['email']), 'contacto' => trim($form['contacto']), 'endereco' => trim($form['endereco']), 'emailError' => '', 'contactoError' => ''];

      if (Valida::email($form['email'])) {
        $dados['emailError'] = 'Preencha correctamente o email';
        Sessao::sms('for', 'Preencha correctamente o email', 'alert alert-danger');
      }
      // elseif(!str_starts_with($form['conctacto'],"+")){
      //   $dados['contactoError'] = 'Preencha o código do País, ex:\'+244********\'';
      //   Sessao::sms('for','Preencha correctamente o contacto','alert alert-danger');
      // }
      else {
        $save = $this->Data->store($dados);
        if ($save) {
          Sessao::izitoast("forn", 'Success', "Salvo com sucesso");
          Url::redireciona('admin/fornecedores');
          exit;
        } else {
          Sessao::izitoast("forn", 'Error', "Erro, Dados não salvos", 'error');
          Url::redireciona('admin/fornecedores');
          exit;
        }
      }
    } else {
      $dados = ['nome' => '', 'email' => '', 'contacto' => '', 'endereco' => '', 'emailError' => '', 'contactoError' => ''];
    }

    $list = $this->Data->list();


    $file = 'fornecedores' . DIRECTORY_SEPARATOR . "fornecedores";
    return $this->view('layouts/admin/app', compact('file', 'dados', 'list'));
  }

  public function delete(int $id)
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);

    if ($id and $metodo == 'POST') :
      $delete = $this->Data->delete($id);
      if ($delete) :
        Sessao::izitoast('forn', 'Success', 'Delectado com sucesso');
        Url::redireciona('admin/fornecedores');
      else :
        Sessao::izitoast('forn', 'Erro', 'Não delectado, consulte BD', 'error');
      endif;
    else :
      Sessao::sms('for', 'Metodo de envio \'GET\' não é permitido', 'alert alert-danger');
      Url::redireciona('admin/fornecedores');
    endif;
  }

  public function edit(int $id)
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) :
      $get = $this->Data->get($id);
      // var_dump($refeicoes);
      // exit;
      $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);


      if (isset($formulario['edit'])) :
        $dados = [
          'nome' => trim($formulario['nome']),
          'email' => trim($formulario['email']),
          'contacto' => trim($formulario['contacto']),
          'endereco' => trim($formulario['endereco']),
          'err_nome' => '',
          'err_email' => '',
          'err_contacto' => '',
          'err_endereco' => '',

        ];
        if (in_array("", $formulario)) :

          if (empty($formulario['nome'])) :
            $dados['err_nome'] = "Os campos não podem estar vazios";
          endif;

          if (empty($formulario['email'])) :
            $dados['err_email'] = "Os campos não podem estar vazios";
          endif;
          if (empty($formulario['contacto'])) :
            $dados['err_contacto'] = "Os campos não podem estar vazios";
          endif;
          if (empty($formulario['endereco'])) :
            $dados['err_endereco'] = "Os campos não podem estar vazios";
          endif;


        else :
          if (Valida::email($formulario['email'])) {
            $dados['err_email'] = "Email Inválido";
          } else {

            $actualiza = $this->Data->update($dados, $id);

            if ($actualiza) :

              Sessao::izitoast('forn', 'Success', 'Actualizado com sucesso');
              Url::redireciona('admin/fornecedores');
              exit;
            else :
              Sessao::sms('for', 'Nada foi actualizado', 'alert alert-danger');
            endif;
          }

        endif;

      else :
        $dados = [
          'name' => '',
          'value' => '',
          'img' => '',
          'status' => '',
          'err_name' => '',
          'err_value' => '',
          'err_img' => '',
          'err_status' => '',
        ];
      endif;

    else :
      Sessao::sms('for', 'String passado na url. Passe um numero(int)', 'alert alert-danger');
      Url::redireciona('admin/prato');
      exit;
    endif;

    $file = 'fornecedores' . DIRECTORY_SEPARATOR . 'editar';
    return $this->view('layouts/admin/app', compact('file', 'dados', 'get'));
  }
}
