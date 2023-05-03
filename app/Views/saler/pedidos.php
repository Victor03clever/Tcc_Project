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
  <?=Sessao::izitoast("notify")?>
  <?=Sessao::sms("erro")?>

  <a href="historico.html" class="btn btn-primary" style="
            padding: .7rem;
            font-size: 1.5rem; margin-bottom:1rem">Histórico</a>
  <div class="row">



    <?php
    if ($all) :$i = 0; 
      foreach ($all as $key => $value) :
        $i+=1;
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
                      <?php $username= $value['nome']; echo $username; ?>
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
                    <?php if (Request::getRequestsR($value['escola'])) : $idClient = ''; ?>

                      <form action="<?= URL ?>/saler/notify/<?= $value['escola'] ?>" method="post">
                        <!-- <input type="text" name="notify" value="<=$value['escola']?>" hidden readonly> -->
                        <?php if ($value['notify'] === 'OFF') : ?>
                          <button class="dropdown-item" type="submit" name="btnN" value=submit><i class="bi bi-bell"></i>
                            Notificar</button>
                        <?php else : ?>
                          <button class="dropdown-item" type="button" onclick="notice()"><i class="bi bi-bell"></i>
                            Notificar</button>
                        <?php endif; ?>
                      </form>
                      <form action="<?= URL ?>/saler/confirm/<?= $value['escola'] ?>" method="post">
                        <button class="dropdown-item" type="submit" name="btnT" value=submit><i class="bi bi-check2-circle"></i>
                          Terminado</button>
                      </form>
                    <?php endif; ?>
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
                <?php if (Request::getRequestsR($value['escola'])) : $pedidos = ""; $modal = "";  ?>
                  <?php $refresh=Request::getRequestsP($value['escola']);?>
                  <?php foreach (Request::getRequestsR($value['escola']) as $key => $value) :
                   

                    $pedidos .= $value['re_nome'] . " (" . $value['qtd'] . "x),<br>".$refresh[$key]['pr_nome']. " (" . $refresh[$key]['qtd'] . "x),<br>";
                    $modal .= $value['re_nome'] . " (" . $value['qtd'] . "x) =>" . $value['re_preco']*$value['qtd'] . "kz<br>".$refresh[$key]['pr_nome'] . " (" . $refresh[$key]['qtd'] . "x) =>" . $refresh[$key]['pr_preco']*$refresh[$key]['qtd'] . "kz<br>";
                    
                  endforeach; ?>
                  <!-- <php $i++ ?> -->
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
                    <h5 class="modal-title fs-2" id="staticBackdropLabel">Todos pedidos(<?=$username?>)</h5>
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
    <?php
      endforeach;
    endif;
    ?>
  </div>

</section>
<script>
  // funcao disparada quando eu tiver que q clicar pela segunda vez em notificar
function notice(){
  alert('A notificação já foi efectuada por favor agurde!');
}
</script>