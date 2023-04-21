<?php

use App\Helpers\Sessao;
?>

<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
  <h1>Compras / Fornecedores / Editar</h1>
  <?= Sessao::izitoast('forn'); ?>
  <?= Sessao::sms('for'); ?>

  <main>

    <section class="container mt-5 mb-5">
      <form action="<?= URL ?>/admin/fornecedores/edit/<?= $get['id'] ?>" method="post" id="formForn">

        <div class="mb-3">
          <label for="nome" class="form-label">Entidade</label>
          <input type="text" class="form-control <?= $dados['err_nome'] ? 'is-invalid' : '' ?>" id="nome" aria-describedby="textHelp" name="nome" value='<?= $get['nome'] ?>'>
          <div id="nomeError" class="invalid-feedback"><?= $dados['err_nome'] ?></div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control  <?= $dados['err_email'] ? 'is-invalid' : '' ?>" id="email" aria-describedby="emailHelp" name="email" value="<?= $get['email'] ?>">
          <div id="emailError" class="invalid-feedback"><?= $dados['err_email'] ?></div>
        </div>
        <div class="mb-3">
          <label for="contacto" class="form-label">Contacto</label>
          <input type="text" class="form-control <?= $dados['err_contacto'] ? 'is-invalid' : '' ?>" id="contacto" aria-describedby="numberhelp" name="contacto" value="<?= $get['contacto'] ?>">
          <div id="contactoError" class="invalid-feedback"><?= $dados['err_contacto'] ?></div>
        </div>
        <div class="mb-3">
          <label for="endereco" class="form-label">Endereço</label>
          <input type="text" class="form-control <?= $dados['err_endereco'] ? 'is-invalid' : '' ?>" id="endereco" aria-describedby="textHelp" name="endereco" value="<?= $get['endereco'] ?>">
          <div id="adressError" class="invalid-feedback"><?= $dados['err_endereco'] ?></div>
        </div>
        <button type="submit" name="edit" value="submit" class="btn btn-primary btn-lg p-2">Actualiza</button>
      </form>
    </section>
  </main>