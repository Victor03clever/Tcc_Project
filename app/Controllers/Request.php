<?php

namespace App\Controllers;

use App\Helpers\Sessao;
use App\Helpers\Valida;
use App\Helpers\Url;
use App\Libraries\uploads;
use App\Libraries\Controller;

class  Request  extends Controller
{

  private $Request;
  public function __construct()
  {
    $this->Request = $this->model("client\Request");
  }
  // funcao para chamar os pedidos do bd
  public function index()
  {

    if (!Sessao::nivel2()) :
      Url::redireciona('client/login');
    endif;
    $allRequest = $this->Request->getRequestsR();
    $allRequestP = $this->Request->getRequestsP();



    $file = 'requestPage';
    return $this->view('layouts/client/app', compact('file', 'allRequest', 'allRequestP'));
  }
  public function deleteRequest($id)
  {


    $id = filter_var($id, FILTER_VALIDATE_INT);
    $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);

    if ($id and $metodo == 'POST') :
      $delete = $this->Request->deleteRequest($id);
      if ($delete) :
        Sessao::izitoast('request', 'Success', 'Delectado com sucesso');
        Url::redireciona('request');
        exit;
      else :
        Sessao::izitoast('est', 'Erro', 'Não delectado, consulte BD', 'error');
      endif;
    else :
      Sessao::sms('erro', 'Metodo de envio \'GET\' não é permitido', 'alert alert-danger');
      Url::redireciona('request');
    endif;
  }
  public function confirmRequest()
  {
    $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_DEFAULT);
    $button = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if ($metodo == 'POST') {
      if ($button['confirm']) {
        // $allRequest = $this->Request->getAllRequest();
        $confirmRequest = $this->Request->confirmRequest();
        if ($confirmRequest) {
          Sessao::izitoast('request', 'Success', 'Pedido confirmado com sucesso');
          Url::redireciona('request');
          exit;
        }else{
          Sessao::izitoast('request', 'Error', 'Não deve ser enviado para confirmar', 'error');
          Url::redireciona('request');
        }
      }
    } else {
      Sessao::sms('sms', 'Metodo de envio \'GET\' não é permitido para confirmar', 'alert alert-danger');
      Url::redireciona('request');
    }
  }
}
