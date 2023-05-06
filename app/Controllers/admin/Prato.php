<?php

namespace App\Controllers\admin;

use App\Helpers\Sessao;
use App\Helpers\Valida;
use App\Helpers\Url;
use App\Libraries\uploads;
use App\Libraries\Controller;

class Prato extends Controller
{
  private $Data;
  public function __construct()
  {
    $this->Data = $this->model("admin\Prato");
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

    $pratos = $this->Data->prato_read();
    // var_dump($pratos);
    // exit;
    $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($formulario['save'])) {
      $dados = [
        'img' => trim($formulario['img']),
        'name' => trim($formulario['name']),
        'value' => trim($formulario['value']),
        'status' => trim($formulario['status']),
        'err_img' => '',
        'err_name' => '',
        'err_value' => '',
      ];

      if (in_array("", $formulario)) {
        if (empty($formulario['img'])) {
          $dados['err_img'] = 'Imagem do prato';
        }
        if (empty($formulario['name'])) {
          $dados['err_name'] = 'Nome do prato';
        }
        if (empty($formulario['value'])) {
          $dados['err_value'] = 'valor a ser vendido';
        }
        Sessao::izitoast('prato', 'Warning', 'Algo deu errado tente cadastrar de novo', 'warning');
      } else {

        if ($this->Data->checa_nome($formulario['name'])) {
          $dados['err_name'] = "Nome já cadastrado";
          Sessao::izitoast('prato', 'Warning', 'Algo deu errado tente cadastrar de novo', 'warning');
        } else {

          if (isset($_FILES['img'])) :
            $upload = new Uploads();
            $upload->imagem($_FILES['img'], 7, 'Pratos');
          // var_dump($upload->getexito(),$upload->geterro());
          endif;
          $dados['img'] = !empty($_SESSION['path']) ? $_SESSION['path'] : 'uploads\Pratos\exemplo.svg';
          if ($upload->getexito()) {

            if ($cadastrar = $this->Data->store_prato($dados)) {
              Sessao::izitoast('prato', 'Success', 'Cadastrado com sucesso');
              Sessao::sms('upload', $upload->getexito() . ' movida com sucesso');
              Url::redireciona("admin/prato");
              exit;
            } else {
              Sessao::sms('upload', 'Erro com o BD', 'alert alert-danger');
            }
          } else {
            if ($upload->geterro()) {
              Sessao::sms('upload', 'Erro ao mover a imagem=>' . $upload->geterro() . 'alert alert-danger');
            }
          }
        }
      }
    } else {
      $dados = [
        'img' => '',
        'name' => '',
        'value' => '',
        'status' => '',
        'err_img' => '',
        'err_name' => '',
        'err_value' => '',
      ];
    }

    $file = 'prato' . DIRECTORY_SEPARATOR . 'prato';
    return $this->view('layouts/admin/app', compact('file', 'pratos', 'dados'));
  }
  public function edite($id)
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) :
      $refeicoes = $this->Data->prato_read1($id);
      // var_dump($refeicoes);
      // exit;
      $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);


      if (isset($formulario['edit'])) :
        $dados = [
          'name' => trim($formulario['name']),
          'value' => trim($formulario['value']),
          'img' => '',
          'status' => trim($formulario['status']),
          'err_name' => '',
          'err_value' => '',
          'err_img' => '',
          'err_status' => '',

        ];
        if (in_array("", $formulario)) :

          if (empty($formulario['name'])) :
            $dados['err_name'] = "Os campos não podem estar vazios";
          endif;

          if (empty($formulario['value'])) :
            $dados['err_value'] = "Os campos não podem estar vazios";
          endif;
          if (empty($formulario['status'])) :
            $dados['err_status'] = "Os campos não podem estar vazios";
          endif;


        else :


          // if (isset($_FILES['imag'])) :
          //   $upload = new Uploads();
          //   $upload->imagem($_FILES['imag'], 7, 'Pratos');
          //   $dados['img'] = !empty($_SESSION['path']) ? $_SESSION['path'] : 'uploads\Pratos\exemplo.svg';

          // endif;
          // if ($upload->geterro() or $upload->getexito()) :
          //   Sessao::sms('img', $upload->geterro(), 'alert alert-danger');
          //   Sessao::sms('img', $upload->getexito() . ' movida com sucesso');
          // endif;

          $actualiza = $this->Data->update_prato($dados, $id);

          if ($actualiza) :

            Sessao::izitoast('prato', 'Success', 'Produto actualizado com sucessso');
            Url::redireciona('admin/prato');


          else :
            Sessao::sms('upload', 'Não tem nada de novo', 'alert alert-info');


          endif;




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
      Sessao::sms('upload', 'String passado na url. Passe um numero(int)', 'alert alert-danger');
      Url::redireciona('admin/prato');
      exit;
    endif;

    $file = 'prato' . DIRECTORY_SEPARATOR . 'editar_prato';
    return $this->view('layouts/admin/app', compact('file', 'dados', 'refeicoes'));
  }
  public function delete($id)
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $id = filter_var($id, FILTER_VALIDATE_INT);
    $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);

    if ($id and $metodo == 'POST') :
      $delete = $this->Data->delete_prato($id);
      if ($delete) :
        Sessao::izitoast('prato', 'Success', 'Delectado com sucesso');
        Url::redireciona('admin/prato');
      else :
        Sessao::izitoast('prato', 'Erro', 'Não delectado, consulte BD', 'error');
      endif;
    else :
      Sessao::sms('upload', 'Metodo de envio \'GET\' não é permitido', 'alert alert-danger');
      Url::redireciona('admin/prato');
    endif;
  }
}
