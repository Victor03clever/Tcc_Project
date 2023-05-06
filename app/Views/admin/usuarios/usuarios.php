<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
 
  <h1>Usuarios</h1>
  <?= Sessao::izitoast("user") ?>
  <?= Sessao::sms("sms") ?>
  <!-- Modal trigger button -->
  <button type="button" class="btn btn-primary  mb-3" data-bs-toggle="modal" data-bs-target="#userN">
    + Cadastrar
  </button>
  <a href="<?=URL?>/admin/usuarios/clientes" class="btn btn-primary fs-3 mb-3 p-2"> Clientes</a>


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
                <th scope="col">Email</th>
                <th scope="col">Nivel</th>
                <th scope="col">Criação</th>
                <th scope="col">Acções</th>
              </tr>
            </thead>


            <tbody>
              <?php if ($users) : $i = 0 ?>
                <?php foreach ($users as $key => $value) : ?>
                  <tr>
                    <td><?= $i += 1 ?></td>
                    <td><img src="<?= asset($value['imagem']) ?>" alt="" width="30" height="30" class="rounded-5"></td>
                    <td><?= $value['nome'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><?= $value['nivel_usuario'] == '1' ? '(admin)' : '(funcio..)' ?></td>
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
                            <form action="<?= URL ?>/admin/usuarios/delete/<?= $value['id'] ?>" method="post">
                            <input type="text" hidden readonly value="<?=$value['nivel_usuario']?>" name="nivel">
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