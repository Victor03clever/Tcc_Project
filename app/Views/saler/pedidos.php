<?php

use App\Models\saler\Request;
use App\Helpers\DataActual;
use App\Helpers\ResumirTexto;
use App\Helpers\Sessao;
?>
<meta http-equiv="refresh" content="30;">
<link rel="stylesheet" href="<?= asset("css/saler/style5.css") ?>">
<section class="section">
  <h1>Pedidos</h1>
  <?= Sessao::izitoast("notify") ?>
  <?= Sessao::sms("erro") ?>

  <a href="<?= URL ?>/saler/historico" class="btn btn-primary" style="
            padding: .7rem;
            font-size: 1.5rem; margin-bottom:1rem">Histórico</a>

  <div class="row">



    <?php
    if ($all) : $i = 0;
      foreach ($all as $key => $value) :
        $i += 1;
    ?>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-4">
          <div class=" card w-100 rounded-4 bg-transparent">

            <div class="card-body ">
              <div class="card-title d-flex justify-content-between align-content-center mb-0 pb-1">
                <div class="cabecalho">
                  <figure>
                    <spanoo class="img">
                      <img src="<?= asset($value['imagem']) ?>" width="40" alt="">
                    </spanoo>
                    <h4 class="username fs-3">
                      <?php $username = $value['nome'];
                      echo $username; ?> | </h4>
                    <form action="<?= URL ?>/saler/notify/<?= $value['escola'] ?>" method="post">
                      <!-- <input type="text" name="notify" value="<=$value['escola']?>" hidden readonly> -->
                      <?php if ($value['notify'] === 'OFF') : ?>
                        <button class="dropdown-item" type="submit" name="btnN" value=submit><i class="bi bi-bell"></i>
                          Notificar</button>
                      <?php else : ?>
                        <button class="dropdown-item" type="button" onclick="notice()"><i class="bi bi-bell text-success"></i>
                          Notificado</button>
                      <?php endif; ?>
                    </form>
                  </figure>
                  <span class="time">
                    <?= DataActual::during($value['pe_update']) ?>
                  </span>
                </div>
                <!-- Organizando todos os pedidos -->
                <?php if (Request::getRequestsR($value['escola']) || Request::getRequestsP($value['escola'])) : $pedidos = "";
                  $modal = "";  ?>
                  <?php $refresh = Request::getRequestsP($value['escola']); ?>
                  <?php foreach (Request::getRequestsR($value['escola']) as $key => $value) :


                    $pedidos .= $value['re_nome'] . " (" . $value['qtd'] . "x),<br>" . $refresh[$key]['pr_nome'] . " (" . $refresh[$key]['qtd'] . "x),<br>";
                    $modal .= $value['re_nome'] . " (" . $value['qtd'] . "x) =>" . $value['re_preco'] * $value['qtd'] . "kz<br>" . $refresh[$key]['pr_nome'] . " (" . $refresh[$key]['qtd'] . "x) =>" . $refresh[$key]['pr_preco'] * $refresh[$key]['qtd'] . "kz<br>";

                  endforeach; ?>
                  <?php
                  $modal = str_replace('(x) =>0kz<br>', '', $modal);
                  $pedidos = str_replace('(x) =>0kz,<br>', '', $pedidos);
                  $modal = str_replace('(x)<br>', '', $modal);
                  $pedidos = str_replace('(x),<br>', '', $pedidos);
                  if ($pedidos == '') {

                    $ref = Request::getRequestsR($value['escola']);
                    foreach (Request::getRequestsP($value['escola']) as $key => $value) :
                      $pedidos .= $value['pr_nome'] . " (" . $value['qtd'] . "x),<br>";
                      $modal .=  $value['pr_nome'] . " (" . $value['qtd'] . "x) =>" . $value['pr_preco'] * $value['qtd'] . "kz<br>";

                    endforeach;
                  }
                  ?>
                <?php endif; ?>
                <div class="dropdown fs-4">
                  <span role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots"></i>
                  </span>
                  <ul class="dropdown-menu">
                    <?php if (Request::getRequestsR($value['escola'])) : $idClient = ''; ?>

                      <form action="<?= URL ?>/saler/payment/<?= $value['escola'] ?>" method="post">
                        <input type="text" name="status" value="<?= $value['status'] ?>" hidden readonly>
                        <?php if ($value['payment'] == '0') : ?>
                          <button class="dropdown-item" type="submit" name="btnP" value=submit><i class="bi bi-cash-stack"></i>Pago</button>
                        <?php else : ?>
                          <button type="button" class="dropdown-item" onclick="pago()"><i class="bi bi-cash-stack"></i>Pago</button>

                        <?php endif; ?>

                      </form>
                      <form action="<?= URL ?>/saler/confirm/<?= $value['escola'] ?>" method="post">
                        <input type="text" readonly hidden name="data" value="<?= $value['pe_update'] ?>">
                        <input type="text" readonly hidden name="pedidos" value="<?= $modal ?>">
                        <input type="text" readonly hidden name="cliente" value="<?= $username ?>">
                        <input type="text" readonly hidden name="total" value="<?= Request::getSumTotal($value['escola'])['total']; ?>">
                        <button class="dropdown-item" type="submit" name="btnT" value=submit><i class="bi bi-check2-circle"></i>
                          Terminado</button>
                      </form>
                      <form action="<?= URL ?>/saler/deleteRq/<?= $value['escola'] ?>" method="post">
                        <input type="text" name="status" value="<?= $value['status'] ?>" hidden readonly>
                        <input type="text" readonly hidden name="pedidos" value="<?= $modal ?>">
                        <input type="text" readonly hidden name="cliente" value="<?= $username ?>">
                        <input type="text" readonly hidden name="total" value="<?= Request::getSumTotal($value['escola'])['total']; ?>">
                        <button class="dropdown-item" type="submit" name="btnD" value=submit><i class="bi bi-trash3"></i>Deletar</button>
                      </form>
                    <?php endif; ?>
                    </li>
                  </ul>
                </div>
              </div>


              <span class="fs-4">
                <strong class="<?= $value['payment'] == '0' ? 'text-danger' : 'text-success' ?>">
                  Pedidos
                </strong>
              </span>
              <p class="card-text pedidos">

                <?php if (Request::getRequestsR($value['escola']) || Request::getRequestsP($value['escola'])) : ?>
                  <?= ResumirTexto::ResumirTexto($pedidos, 3, " <a href='#' data-bs-toggle='modal' data-bs-target='#pedido" . $i . "'>mais</a><br>") ?>
                <?php endif; ?>
                <strong>
                  Total: <?= Request::getSumTotal($value['escola'])['total']; ?> kz<br>
                </strong>

              </p>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="pedido<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fs-2" id="staticBackdropLabel">Todos pedidos(<?= $username ?>)</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-3">
                  <?php echo $modal; ?>
                  <br>
                  Total: <?= Request::getSumTotal($value['escola'])['total']; ?> kz<br>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


        </div>
    <?php
      endforeach;
    endif;
    ?>
  </div>





</section>
<script>
  // funcao disparada quando eu tiver que q clicar pela segunda vez em notificar
  function notice() {
    alert('A notificação já foi efectuada por favor agurde!');
  }

  function pago() {
    alert('Já foi registrado o pagamento');
  }
</script>