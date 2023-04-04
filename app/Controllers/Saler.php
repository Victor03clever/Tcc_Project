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
  public function __construct()
  {
    $this->Data = $this->model("Saler\Usuarios");

    if (Sessao::nivel0()) :
      session_destroy();
      Url::redireciona('client/login');
    endif;
  }

  public function index()
  {
    if (!Sessao::nivel1()) :
      Url::redireciona("client/login");
    endif;
  }


  public function login()
  {
    if (Sessao::nivel1()) :
      Url::redireciona("saler");
    endif;
    
  }
}
