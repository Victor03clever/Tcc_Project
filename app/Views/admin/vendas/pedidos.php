<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;
use App\Models\admin\Venda;


?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">

  <h1>Vendas / pedidos</h1>
  <?= Sessao::izitoast("user") ?>
  <?= Sessao::sms("sms") ?>
  <!-- Modal trigger button -->
  <!-- <button type="button" class="btn btn-primary  mb-3" data-bs-toggle="modal" data-bs-target="#userN">
    + Cadastrar
  </button> -->
  <a href="<?= URL ?>/admin/vendas" class="btn btn-primary fs-3 mb-3 p-2"> voltar</a>


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
              <?php if ($pedidos) : $i = 0 ?>
                <?php foreach ($pedidos as $key => $value) : ?>
                  <tr>
                    <td><?= $i += 1 ?></td>
                    <td><img src="<?= asset($value['imagem']) ?>" alt="" width="30" height="30" class="rounded-5"></td>
                    <td><?= $value['nome'] ?></td>
                    <td><?= $value['total'] ?></td>
                    <td><?= $value['pe_create'] ?></td>
                    <td>
                      <div class="d-flex align-items-center">
                        <a class="btn btn-primary" style="margin-right:.3rem" title='ver' data-bs-toggle="modal" data-bs-target="#modalP<?= $i ?>">
                          <i class="bi bi-eye"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalD<?= $i ?>"><i class="bi bi-trash3"></i></button>
                      </div>
                    </td>
                    <!-- Modal delete-->
                    <div class="modal fade" id="modalP<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog        ">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" style="color:var(--text)">Produtos vendidos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" style="color:var(--text)">
                            <!-- Organizando todos os pedidos -->
                            <?php if (Venda::getP($value['v_id']) || Venda::getR('v_id')) :
                              $modal = "";  ?>
                              <?php $refresh = Venda::getP($value['v_id']); ?>
                              <?php foreach (Venda::getR($value['v_id']) as $key => $value) :



                                $modal .= $value['re_nome'] . " (" . $value['qtd'] . "x) =>" . $value['re_preco'] * $value['qtd'] . "kz<br>" . $refresh[$key]['pr_nome'] . " (" . $refresh[$key]['qtd'] . "x) =>" . $refresh[$key]['pr_preco'] * $refresh[$key]['qtd'] . "kz<br>";

                              endforeach; ?>
                              <?php
                              $modal = str_replace('(x) =>0kz<br>', '', $modal);
                              $modal = str_replace('(x)<br>', '', $modal);
                              if ($modal == '') {
                                $ref=Venda::getR($value['v_id']);
                                foreach (Venda::getP($value['v_id']) as $key => $value) :

                                  $modal .=  $value['pr_nome'] . " (" . $value['qtd'] . "x) =>" . $value['pr_preco'] * $value['qtd'] . "kz<br>";

                                endforeach;
                              }

                              // var_dump($refresh);
                              echo $modal;

                              ?>
                            <?php endif; ?>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary p-1 fs-5" data-bs-dismiss="modal">fechar</button>

                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal delete-->
                    <div class="modal fade" id="modalD<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog        ">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" style="color:var(--text)">Tem certeza que deseja deletar?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" style="color:#dc3545">
                            Vendedor: <?= $value['nome'] ?>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary p-1 fs-5" data-bs-dismiss="modal">abortar</button>
                            <form action="<?= URL ?>/admin/vendas/deleteV/<?= $value['v_id'] ?>" method="post">
                              <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                            </form>
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