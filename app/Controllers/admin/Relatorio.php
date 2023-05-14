<?php

namespace App\Controllers\admin;

use App\Helpers\Sessao;
use App\Helpers\Url;
use App\Libraries\Controller;
use App\Models\admin\Venda;
use App\Models\admin\Report;

class Relatorio extends Controller
{
  private $Data;
  public function __construct()
  {
    $this->Data = $this->model("admin\Report");
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
    $sales = $this->Data->getSales();

    $file = 'relatorio' . DIRECTORY_SEPARATOR . 'relatorio';
    $this->view('layouts/admin/app', compact('file', 'sales'));
  }
  public function filtrosV()
  {

    $filtroV = $this->Data->filterV($_POST['fromDate'], $_POST['toDate']);
    if ($filtroV) {

      $i = 0;
      $filtro="";

      foreach ($filtroV as $key => $value) :
        $i += 1;

        $pagamento = $value['forma_pagamento'] == '0' ? '(cash)' : '(tpa)';
        $filtro .= "
              <tr>
                <td>" . $i . "</td>
                <td>" . $value['nome'] . "</td>
                <td>" . $value['total'] . "</td>
                <td>" . $pagamento . "</td>
                <td>" . $value['v_create_at'] . "</td>
               
                
              
      ";
        if (Report::getP($value["v_id"]) || Report::getR($value["v_id"])) {
          $modal = "";
          $refresh = Report::getP($value["v_id"]);
          foreach (Report::getR($value["v_id"]) as $key => $value) :



            $modal .= $value["re_nome"] . " (" . $value["qtd"] . "x) =>" . $value["re_preco"] * $value["qtd"] . "kz<br>" . $refresh[$key]["pr_nome"] . " (" . $refresh[$key]["qtd"] . "x) =>" . $refresh[$key]["pr_preco"] * $refresh[$key]["qtd"] . "kz<br>";

          endforeach;

          $modal = str_replace("(x) =>0kz<br>", "", $modal);
          $modal = str_replace("(x)<br>", "", $modal);
          if ($modal == '') {
            $ref = Report::getR($value["v_id"]);
            foreach (Report::getP($value["v_id"]) as $key => $value) :

              $modal .=  $value["pr_nome"] . " (" . $value["qtd"] . "x) =>" . $value["pr_preco"] * $value["qtd"] . "kz<br>";

            endforeach;
          }

          // var_dump($refresh);
          // echo $modal;
        }

        $filtro .= "
        <td>
      " . $modal . "
          </td>
        </tr>
        ";
        
      endforeach;
      echo $filtro;
    } else {
      echo '<tr></tr>';
    }
  }

  // <!-- ========== Start compra ========== -->

  public function compras()
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $list = $this->Data->list();

    $file = 'relatorio' . DIRECTORY_SEPARATOR . 'relatorio_compras';
    $this->view('layouts/admin/app', compact('file', 'list'));
  }
  public function filtrosC()
  {
    $filtroC = $this->Data->filterC($_POST['fromDate'], $_POST['toDate']);
    if ($filtroC) {

      $i = 0;

      $output = "";
      foreach ($filtroC as $key => $value) :

        $i += 1;
        $output .= "
        <tr>
                      <th scope='row'>" . $i . "</th>
                      <td>" . $value['nome_f'] . "</td>
                      <td>" . $value['total_fc'] . "</td>
                      <td>" . $value['create_at'] . "</td>
                      <td>
                        <div class='d-flex align-items-center gap-2'>
                          <a name='cad' href='" . asset($value['path']) . "' target='__blank' class='btn btn-primary' title='ver fatura'>
                            <i class='bi bi-journal-bookmark-fill'></i>
                          </a>

                        </div>
                      </td>
                    </tr>

        ";
      endforeach;
      echo $output;
    } else {
    }
  }
  // <!-- ========== End compra ========== -->

//   <!-- ========== Start pedidos ========== -->
  public function pedidos(){
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $pedidos = $this->Data->pedidos();

    $file = 'relatorio' . DIRECTORY_SEPARATOR . 'relatorio_pedidos';
    $this->view('layouts/admin/app', compact('file', 'pedidos'));
  }
  public function filterP(){
    $filtroP= $this->Data->filterP($_POST['fromDate'], $_POST['toDate']);
    if ($filtroP) {

      $i = 0;
      $filtro="";

      foreach ($filtroP as $key => $value) :
        $i += 1;

        $filtro .= "
              <tr>
                <td>" . $i . "</td>
                <td><img src='".asset($value['imagem'])."' alt='' width='30' height='30' class='rounded-5'></td>
                <td>" . $value['nome'] . "</td>
                <td>" . Report::getSumTotalH($value['pe_update'])['total'] . "</td>
                <td>" . $value['pe_update'] . "</td>
               
                
              
      ";
      if (Report::getRequestsRH($value['pe_update']) || Report::getRequestsPH($value['pe_update'])) : $pedidos = "";
      $modal = "";  
      $refresh = Report::getRequestsPH($value['pe_update']); 
       foreach (Report::getRequestsRH($value['pe_update']) as $key => $value) :



        $modal .= $value['re_nome'] . " (" . $value['qtd'] . "x) =>" . $value['re_preco'] * $value['qtd'] . "kz<br>" . $refresh[$key]['pr_nome'] . " (" . $refresh[$key]['qtd'] . "x) =>" . $refresh[$key]['pr_preco'] * $refresh[$key]['qtd'] . "kz<br>";

      endforeach; 
      
      $modal = str_replace('(x) =>0kz<br>', '', $modal);
      // $pedidos = str_replace('(x) =>0kz,<br>', '', $pedidos);
      $modal = str_replace('(x)<br>', '', $modal);
      // $pedidos = str_replace('(x),<br>', '', $pedidos);
      if ($modal == '') {

        $ref = Report::getRequestsRH($value['pe_update']);
        foreach (Report::getRequestsPH($value['pe_update']) as $key => $value) :
          // $pedidos .= $value['pr_nome'] . " (" . $value['qtd'] . "x),<br>";
          $modal .=  $value['pr_nome'] . " (" . $value['qtd'] . "x) =>" . $value['pr_preco'] * $value['qtd'] . "kz<br>";

        endforeach;
      }
      
     
    endif;

        $filtro .= "
        <td>
      " . $modal . "
          </td>
        </tr>
        ";
        
      endforeach;
      echo $filtro;
    } else {
      echo '<tr></tr>';
    }
  }
//   <!-- ========== End pedidos ========== -->
}
