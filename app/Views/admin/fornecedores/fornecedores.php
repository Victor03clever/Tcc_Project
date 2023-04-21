<?php

use App\Helpers\Sessao;
?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
  <?=
  Sessao::sms('for');
  ?>
  <?=
  Sessao::izitoast('forn');
  ?>
  <h1>Compras / Fornecedores</h1>
  <!-- Modal trigger button -->
  <a href="<?=URL?>/admin/compras" class="btn btn-primary" style="width: 10rem;
            padding: .7rem;
            font-size: 1.5rem; margin-bottom:1rem">Voltar</a>
  <button type="button" class="btn btn-primary  mb-3" data-bs-toggle="modal" data-bs-target="#modalId">
    + Cadastrar
  </button>


  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">


          <!-- Table with stripped rows -->
          <table class="table datatable table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Entidade</th>
                <th scope="col">Email</th>
                <th scope="col">Contacto</th>
                <th scope="col">Endereco</th>
              </tr>
            </thead>
            <tfoot>

              <tbody>
                <?php if ($list) : $i = 0 ?>
                  <?php foreach ($list as $key => $value) : $i += 1 ?>
                    <tr>
                      <th scope="row"><?= $i ?></th>
                      <td><?= $value['nome'] ?></td>
                      <td><?= $value['email'] ?></td>
                      <td><?= $value['contacto'] ?></td>
                      <td><?= $value['endereco'] ?></td>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <a name="cad" href="<?=URL?>/admin/fornecedores/edit/<?=$value['id']?>" class="btn btn-primary" title="editar">
                            <i class="bi bi-pencil-square"></i>
                          </a>
                          <button class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $i ?>" title="deletar"><i class="bi bi-trash3"></i></button>

                        </div>
                      </td>
                    </tr>


                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog        ">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Deseja delectar?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Entidade: <?= $value['nome'] ?>
                          </div>
                          <form action="<?=URL?>/admin/fornecedores/delete/<?=$value['id']?>" method="post">
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                              <button type="submit" class="btn-lg btn-primary p-1 rounded" name="delete" value="submit">Delectar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
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



<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleId" style="color:var(--text)">Cadastrar Novo Fornecedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= URL ?>/admin/fornecedores" method="post" id="formForn">
        <div class="modal-body">

          <div class="mb-3">
            <label for="nome" class="form-label">Entidade</label>
            <input type="text" class="form-control" id="nome" aria-describedby="textHelp" name="nome" value='<?= $dados['nome'] ?>'>
            <div id="nomeError" class="invalid-feedback">We'll never share your texts with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control  <?= $dados['emailError'] ? 'is-invalid' : '' ?>" id="email" aria-describedby="emailHelp" name="email" value="<?= $dados['email'] ?>">
            <div id="emailError" class="invalid-feedback"><?= $dados['emailError'] ?></div>
          </div>
          <div class="mb-3">
            <label for="contacto" class="form-label">Contacto</label>
            <input type="text" class="form-control <?= $dados['contactoError'] ? 'is-invalid' : '' ?>" id="contacto" aria-describedby="numberhelp" name="contacto" value="<?= $dados['contacto'] ?>">
            <div id="contactoError" class="invalid-feedback"><?= $dados['contactoError'] ?></div>
          </div>
          <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" aria-describedby="textHelp" name="endereco" value="<?= $dados['endereco'] ?>">
            <div id="adressError" class="invalid-feedback">We'll never share your texts with anyone else.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="save" value="submit" class="btn btn-primary btn-lg p-2">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  // variables
  const form = document.querySelector('#formForn');
  const nomeInput = document.querySelector('#nome');
  const emailInput = document.querySelector('#email');
  const contactoInput = document.querySelector('#contacto');
  const enderecoInput = document.querySelector('#endereco');

  // errors
  const nomeError = document.querySelector('#nomeError');
  const emailError = document.querySelector('#emailError');
  const contactoError = document.querySelector('#contactoError');
  const adressError = document.querySelector('#adressError');

  form.addEventListener('submit', (event) => {
    event.preventDefault();

    if (nomeInput.value === '' || emailInput.value === '' || contactoInput.value === '' || enderecoInput.value === '') {
      // se campo nome estiver vazio
      if (nomeInput.value === "") {
        nomeInput.classList.add('is-invalid');
        nomeError.innerHTML = '';
        nomeError.innerHTML += `Preencha o campo nome`;
        //   return;
      } else {
        nomeInput.classList.remove('is-invalid');
        nomeInput.classList.add('is-valid');
        nomeError.innerHTML = '';
      }

      // se campo email estiver vazio
      if (emailInput.value === "") {
        emailInput.classList.add('is-invalid');
        emailError.innerHTML = '';
        emailError.innerHTML += `Preencha o campo email`;
        //   return;
      } else {
        emailInput.classList.remove('is-invalid');
        emailInput.classList.add('is-valid');
        emailError.innerHTML = '';
      }
      // se campo contacto estiver vazio
      if (contactoInput.value === "") {
        contactoInput.classList.add('is-invalid');
        contactoError.innerHTML = '';
        contactoError.innerHTML += `Preencha o campo contacto`;
        //   return;
      } else {
        contactoInput.classList.remove('is-invalid');
        contactoInput.classList.add('is-valid');
        contactoError.innerHTML = '';
      }
      // se campo nome endereco vazio
      if (enderecoInput.value === "") {
        enderecoInput.classList.add('is-invalid');
        adressError.innerHTML = '';
        adressError.innerHTML += `Preencha o campo`;
        //   return;
      } else {
        enderecoInput.classList.remove('is-invalid');
        enderecoInput.classList.add('is-valid');
        adressError.innerHTML = '';
      }
    } else {
      form.submit();

    }
  });
</script>