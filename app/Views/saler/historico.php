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
  <!-- Modal trigger button -->
  <!-- <button type="button" class="btn btn-primary  mb-3" data-bs-toggle="modal" data-bs-target="#userN">
    + Cadastrar
  </button> -->
  <!-- <a href="<= URL ?>/admin/vendas/pedidos" class="btn btn-primary fs-3 mb-3 p-2"> Pedidos</a> -->


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
                              if ($pedidos == '') {

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
                            <button type="button" class="btn btn-secondary p-1 fs-5" data-bs-dismiss="modal">fechar</button>

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



<!-- Modal Body cadastrar -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="userN" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId" style="color:var(--text)">Cadastrar Usuarios</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= URL ?>/admin/Usuarios" method="POST">

        <div class="modal-body">

          <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control <?= $dados['error'] ? 'is-invalid' : '' ?>" id="nome" aria-describedby="textHelp" name="nome" placeholder='nome'>
            <div id="textHelp" class="form-text">We'll never share your texts with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?= $dados['error'] ? 'is-invalid' : '' ?>" id="email" aria-describedby="emailHelp" name="email" placeholder='email'>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control <?= $dados['error'] ? 'is-invalid' : '' ?>" id="senha" name="senha" aria-describedby="passwordHelp" placeholder='senha'>
            <div id="passwordHelp" class="form-text">We'll never share your password with anyone else.</div>
          </div>
          <select class="form-select fs-4 <?= $dados['error'] ? 'is-invalid' : '' ?>" aria-label="Default select example" name="nivel">
            <option selected value="" disabled>Nivel</option>
            <option value="1">Admin</option>
            <option value="2">Funcionario</option>
          </select>
          <div id="passwordHelp" class="invalid-feedback"><?= $dados['error'] ?></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger fs-5 p-2" data-bs-dismiss="modal">Abortar</button>
          <button type="submit" class="btn btn-primary p-2" name='save' value='submit'>salvar</button>
        </div>
      </form>

    </div>
  </div>
</div>