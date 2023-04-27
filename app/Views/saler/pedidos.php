<?php

use App\Models\saler\Request;
use App\Helpers\DataActual;
use App\Helpers\ResumirTexto;
?>
<meta http-equiv="refresh" content="30;">
<link rel="stylesheet" href="<?= asset("css/saler/style5.css") ?>">
<section class="section">
  <h1>Pedidos</h1>

  <a href="historico.html" class="btn btn-primary" style="
            padding: .7rem;
            font-size: 1.5rem; margin-bottom:1rem">Histórico</a>
  <div class="row">



    <?php
    if ($all) : $i = 0;
      foreach ($all as $key => $value) :
    ?>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-4">
          <div class=" card w-100 rounded-4 bg-transparent">

            <div class="card-body ">
              <div class="card-title d-flex justify-content-between align-content-center mb-0 pb-1">
                <div class="cabecalho">
                  <figure>
                    <span class="img">
                      <img src="<?= asset($value['imagem']) ?>" width="40" alt="">
                    </span>
                    <h4 class="username fs-3">
                      <?= $value['nome'] ?>
                    </h4>
                  </figure>
                  <span class="time">
                    <?= DataActual::during($value['pe_create']) ?>
                  </span>
                </div>

                <div class="dropdown">
                  <span role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots"></i>
                  </span>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-bell"></i>
                        Notificar</a></li>
                    <li>
                      <form action="#" method="post">
                        <button class="dropdown-item" type="submit" name="btn" value=submit><i class="bi bi-check2-circle"></i>
                          Terminado</button>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>


              <span class="fs-4">
                <strong>
                  Pedidos

                </strong>
              </span>
              <p class="card-text pedidos">
                <?php if (Request::getRequestsR($value['escola'])) : $pedidos = "";
                  $modal = ''; ?>

                  <?php foreach (Request::getRequestsR($value['escola']) as $key => $value) :
                    $pedidos .= $value['re_nome'] . " (" . $value['qtd'] . "x),<br>";
                    $modal .= $value['re_nome'] . " (" . $value['qtd'] . "x) =>" . $value['re_preco'] . "kz<br>";
                  endforeach; ?>
                  <?= ResumirTexto::ResumirTexto($pedidos, 3, " <a href='#' data-bs-toggle='modal' data-bs-target='#pedido" . $i . "'>mais</a><br>") ?>
                <?php endif; ?>

                <strong>

                  Total: <?= Request::getSumTotal($value['escola'])['total']; ?> kz<br>
                </strong>

              </p>
            </div>
          </div>


        </div>
    <?php
      endforeach;
    endif;
    ?>
    <!-- Modal -->
    <div class="modal fade" id="pedido<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fs-2" id="staticBackdropLabel">Todos pedidos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body fs-3">
            <?php echo $modal; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>