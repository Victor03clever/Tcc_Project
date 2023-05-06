<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
  
  <h1>Usuarios / Clientes</h1>
  <?= Sessao::izitoast("user") ?>
  <?= Sessao::sms("sms") ?>
  <!-- Modal trigger button -->
  
  <a href="<?=URL?>/admin/usuarios" class="btn btn-primary fs-3 mb-3 p-2"> Voltar</a>


  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">


          <!-- Table with stripped rows -->
          <table class="table datatable table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Img</th>
                <th scope="col">Nome</th>
                <th scope="col">Numero</th>
                <th scope="col">Criação</th>
                <th scope="col">Acções</th>
              </tr>
            </thead>


            <tbody>
              <?php if ($users) : $i = 0 ?>
                <?php foreach ($users as $key => $value) : ?>
                  <tr>
                    <td><?= $i += 1 ?></td>
                    <td><img src="<?=asset($value['imagem']) ?>" alt="" width="30" height="30" class="rounded-5"></td>
                    <td><?= $value['nome'] ?></td>
                    <td><?= $value['numero'] ?></td>
                    <td><?= $value['create_at'] ?></td>
                    <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal<?= $i ?>"><i class="bi bi-trash3"></i></button></td>
                    <!-- Modal delete-->
                    <div class="modal fade" id="modal<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog        ">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" style="color:var(--text)">Tem certeza que deseja delectar?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" style="color:#dc3545">
                            Usuario: <?= $value['nome'] ?>
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary p-1 fs-5" data-bs-dismiss="modal">abortar</button>
                            <form action="<?= URL ?>/admin/usuarios/deleteC/<?= $value['id'] ?>" method="post">
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


