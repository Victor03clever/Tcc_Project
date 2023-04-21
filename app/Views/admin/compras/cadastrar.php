<?php

use App\Helpers\Sessao;
?>

<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
  <h1>Compras / Cadastrar</h1>
  <?= Sessao::izitoast('forn'); ?>
  <?= Sessao::sms('for'); ?>

  <main>

    <section class="container mt-5 mb-5">
      <form action="<?= URL ?>/admin/compras/cadastrar" method="post" id="formCompras">
        <div id="form">
          <fieldset id="field">

            <div class="mb-3">
              <label for="nome" class="form-label">Nome do produto</label>
              <input type="text" class="form-control <?= $dados['err_nome'] ? 'is-invalid' : '' ?>" id="nome" aria-describedby="textHelp" name="nome[]">
              <div id="nomeError" class="invalid-feedback"><?= $dados['err_nome'] ?></div>
            </div>

            <div class="row mb-3">
              <div class=" col-6">
                <label for="email" class="form-label">Preço</label>
                <input type="number" class="form-control  <?= $dados['err_preco'] ? 'is-invalid' : '' ?>" id="preco" aria-describedby="emailHelp" name="preco[]">
                <div id="precoError" class="invalid-feedback"><?= $dados['err_preco'] ?></div>
              </div>
              <div class=" col-6">
                <label for="contacto" class="form-label">Quantidade</label>
                <input type="number" class="form-control <?= $dados['err_qtd'] ? 'is-invalid' : '' ?>" id="qtd" aria-describedby="numberhelp" name="qtd[]">
                <div id="qtdError" class="invalid-feedback"><?= $dados['err_qtd'] ?></div>
              </div>
            </div>
          </fieldset>
        </div>
        <button type="button" class="fs-2 btn btn-primary p-0 mb-3" onclick="addForm()" title="adicionar campos">+</button>
        <div class="mb-3">
          <label for="forn">Fornecedor</label>
          <select class="form-select fs-5 <?= $dados['err_forn'] ? 'is-invalid' : '' ?>" id="forn" name="forn">
            <option selected disabled value="">Escolha aqui</option>

            <?php foreach ($forn as $value) : ?>
              <option value='<?= $value['id'] ?>'><?= $value['nome'] ?></option>
            <?php endforeach; ?>
          </select>
          <div id="contactoError" class="invalid-feedback"><?= $dados['err_forn'] ?></div>
        </div>
        <button type="submit" name="save" value="submit" class="btn btn-primary btn-lg p-2">Salvar</button>
      </form>
    </section>
  </main>
  <script src="<?= asset("js/admin/addForm.js") ?>"></script>