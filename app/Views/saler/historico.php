<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;
use App\Models\saler\Request;


?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">

  <h1>Pedidos / Historico</h1>
  <?= Sessao::izitoast("history") ?>
  <?= Sessao::sms("sms") ?>


  <a href="<?=URL?>/saler/pedidos" class="btn btn-primary" style="
            padding: .7rem;
            font-size: 1.5rem; margin-bottom:1rem">Voltar</a>
  <div class="row">

  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">


          <!-- Table with stripped rows -->
          <table class="table datatable table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">img</th>
                <th scope="col">Nome</th>
                <th scope="col">Total</th>
                <th scope="col">Criação</th>
                <th scope="col">Acções</th>
              </tr>
            </thead>


            <tbody>
              <?php if ($history) : $i = 0 ?>
                <?php foreach ($history as $key => $value) : ?>
                  <tr>
                    <td><?= $i += 1 ?></td>
                    <td><img src="<?= asset($value['imagem']) ?>" alt="" width="30" height="30" class="rounded-5"></td>
                    <td><?= $value['nome'] ?></td>
                    <td><?= Request::getSumTotalH($value['pe_update'])['total'] ?></td>
                    <td><?= $value['pe_update'] ?></td>
                    <td>
                      <div class="d-flex align-items-center">
                        <a class="btn btn-primary" style="margin-right:.3rem" title='ver' data-bs-toggle="modal" data-bs-target="#modalV<?= $i ?>">
                          <i class="bi bi-eye"></i>
                        </a>
                      </div>
                    </td>
                    <!-- Modal delete-->
                    <div class="modal fade" id="modalV<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog        ">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" style="color:var(--text)">Pratos Atendidos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" style="color:var(--text)">
                            <!-- Organizando todos os pedidos -->
                            <?php       
                             if (Request::getRequestsRH($value['pe_update']) || Request::getRequestsPH($value['pe_update'])) : $pedidos = "";
                              $modal = "";  ?>
                              <?php $refresh = Request::getRequestsPH($value['pe_update']); ?>
                              <?php foreach (Request::getRequestsRH($value['pe_update']) as $key => $value) :

                                
                                
                                $modal .= $value['re_nome'] . " (" . $value['qtd'] . "x) =>" . $value['re_preco'] * $value['qtd'] . "kz<br>" . $refresh[$key]['pr_nome'] . " (" . $refresh[$key]['qtd'] . "x) =>" . $refresh[$key]['pr_preco'] * $refresh[$key]['qtd'] . "kz<br>";

                              endforeach; ?>
                              <?php
                              $modal = str_replace('(x) =>0kz<br>', '', $modal);
                              // $pedidos = str_replace('(x) =>0kz,<br>', '', $pedidos);
                              $modal = str_replace('(x)<br>', '', $modal);
                              // $pedidos = str_replace('(x),<br>', '', $pedidos);
                              if ($modal == '') {

                                $ref = Request::getRequestsRH($value['pe_update']);
                                foreach (Request::getRequestsPH($value['pe_update']) as $key => $value) :
                                  // $pedidos .= $value['pr_nome'] . " (" . $value['qtd'] . "x),<br>";
                                  $modal .=  $value['pr_nome'] . " (" . $value['qtd'] . "x) =>" . $value['pr_preco'] * $value['qtd'] . "kz<br>";

                                endforeach;
                              }
                              ?>
                             <?=$modal?>
                            <?php endif; ?>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">fechar</button>

                          </div>
                        </div>
                      </div>
                    </div>

                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>

            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>



