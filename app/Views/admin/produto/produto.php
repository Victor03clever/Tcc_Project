<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
  <?= Sessao::sms('upload') ?>
  <?= Sessao::izitoast('produto') ?>

  <h1>Produtos</h1>
  <!-- Modal trigger button -->
  <a class="btn btn-primary " href="<?= URL ?>/admin/produto/create" style="width: 10rem;padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">
    + Cadastrar
  </a>
  <a href="<?= URL ?>/admin/prato" class="btn btn-primary" style="width: 10rem;
            padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">Pratos</a>
  <a href="<?= URL ?>/admin/estoque" class="btn btn-primary" style="width: 10rem;
            padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">Estoque</a>
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">



          <!-- Table with stripped rows -->
          <table class="table datatable table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Id</th>
                <th scope="col">Img</th>
                <th scope="col">Nome</th>
                <th scope="col">Preço</th>
                <th scope="col">Categoria</th>
                <th scope="col">C.barra</th>
                <th scope="col">Criação</th>
              </tr>
            </thead>
            <tfoot>

              <tbody>
                <?php if(isset($dados)) : $i = 1; ?>
                  <?php foreach ($dados as $value) : ?>
                    <tr>

                      <td><?= $i++ ?></td>
                      <td><?= $value['id'] ?></td>
                      <td><img src="<?= URL ?>/public/<?= $value['imagem'] ?>" alt="" width="35"></td>
                      <td><?= $value['p_nome'] ?></td>
                      <td><?= $value['preco'] ?></td>
                      <td><?= $value['c_nome'] ?></td>
                      <td><?= $value['cod'] ?></td>
                      <td><?= Valida::ANG($value['create_at']) ?></td>
                      <td>
                        <div class="d-flex align-items-center">
                          <a name="cad" href="<?= URL ?>/admin/produto/edit/<?= $value['p_id'] ?>" class="btn btn-primary" style="margin-right:.3rem">
                            editar
                          </a>
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal<?= $i ?>">delectar</button>
                        </div>
                      </td>
                      <!-- Modal delete-->
                      <div class="modal fade" id="modal<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog        ">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel" style="color:#000">Tem certeza que deseja delectar?</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="color:#dc3545">
                              Produto: <?= $value['p_nome'] ?>
                              <br>
                              Aviso:O produto será perdido para sempre
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">abortar</button>
                              <form action="<?= URL ?>/admin/produto/delete/<?= $value['p_id'] ?>" method="post">
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