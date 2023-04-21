<?php

namespace App\Controllers\admin;

use App\Helpers\Url;
use App\Helpers\Sessao;
use App\Libraries\Controller;
use App\Helpers\Valida;
use App\Libraries\Uploads;
use App\Libraries\Pdf;
use DateTime;
use LDAP\Result;

class Compras extends Controller
{
  private $Data;
  private $Suppliers;
  public function __construct()
  {
    if (Sessao::nivel1()) :
      session_destroy();
      Url::redireciona('home');
    endif;
    $this->Data = $this->model("admin\Compras");
    $this->Suppliers = $this->model("admin\Fornecedores");
  }

  public function index()
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;

    $file = 'compras' . DIRECTORY_SEPARATOR . "compras";
    return $this->view('layouts/admin/app', compact('file', 'dados'));
  }
  public function cadastrar()
  {
    if (!Sessao::nivel0()) :
      Url::redireciona('home');
    endif;
    $forn = $this->Suppliers->list();

    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($form)) {
      $dados = [
        'err_nome' => '',
        'err_forn' => '',
        'err_qtd' => '',
        'err_preco' => ''
      ];
      // var_dump($form);
      // exit;
      // if(in_array("",$form)){

      if (empty($form['forn'])) {
        $dados['err_forn'] = "Não informou o fornecedor";
      } else {
        $array = ['nome' => $form['nome'], 'qtd' => $form['qtd'], 'preco' => $form['preco']];
        $idf = $form['forn'];
        $nomef = $this->Suppliers->get($idf);

        $path = "uploads/Faturas/Compras/".uniqid() . '.pdf';
        $total = 0;
        foreach ($array['qtd'] as $key => $value) {
          $total += $value * $array['preco'][$key];
        }
        // var_dump($array);
        // // echo $path;
        // exit;
        
        $factura = $this->Data->store1($path, $total);
        $compra = $this->Data->store2($array, $idf);


        if ($factura and $compra) {
          $pdf = new Pdf;
         
            
          $html = "<!DOCTYPE html>
          <html>
          
          <head>
              <meta charset='UTF-8'>
              
          
              <style>
                  .wrapper {
                      margin-left: 40px;
                  }
          
                  table {
                      width: 100%;
                      margin-top: 50px;
                  
                  }
          th{
              text-align: left;
          }
                  footer {
                      text-align: center;
                      font-style: italic;
                  }
              </style>
          </head>
          
          <body>
          
             <a target='_blank' href=".URL."/admin/compras> <img src='".asset("img/logo.png")."' width='200'></a>
              <div class='wrapper'>
          
          
                  <h1> Fatura</h1>
          
                  <span>
                      Rua direita da CNE <br>
                      <strong> Fornecedor: ".$nomef['nome']."</strong> <br>
                      <strong> Data: ".Date("Y-m-d H:i:s")."</strong>
                  </span>
          
                  <table class='table'>
                      <thead>
                          <tr>
                              <th>quantidade</th>
                              <th>Descrição</th>
                              <th>Preço p/unidade</th>
                              <th>Total</th>
                          </tr>
                      </thead>
                      <tbody>
                      ";
                     foreach($array['qtd'] as $key=>$value):
                      $html.= "  <tr>
                          <td>$value</td>
                          <td>".$array['nome'][$key]."</td>
                          <td>".$array['preco'][$key]."</td>
                          <td>".$array['preco'][$key]*$value."</td>
                        </tr>";
                         endforeach;
                      $html.="
                      </tbody>
                  </table>
                  <span style='font-size: 30px;'>Total Geral: ".$total."</span>
                  <footer>
                     &copy; Refeitorio Anherc | Victor_Clever
                  </footer>
              </div>
        
          </body>
          
          </html>";

         





          Sessao::izitoast('compra', 'Success' , 'Compra efectuada com sucesso');
          $pdf->generate($html, $path);
          Url::redireciona("admin/compras");
          exit;
          
        } else {
          Sessao::izitoast('compra', 'Error' . 'Compra não efectuada com sucesso');
          // Url::redireciona("admin/compras");

        }
      }
    } else {
      $dados = ['nome' => '', 'preco' => '', 'qtd' => '', 'err_nome' => '', 'err_preco' => '', 'err_qtd' => '', 'err_forn' => '', 'forn' => ''];
    }
    $file = 'compras' . DIRECTORY_SEPARATOR . "cadastrar";
    return $this->view('layouts/admin/app', compact('file', 'dados', 'forn'));
  }
}
