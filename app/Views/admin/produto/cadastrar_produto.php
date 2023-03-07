<?php

use App\Helpers\Sessao;
?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
    <h1>Produtos / Cadastrar</h1>
    <?= Sessao::sms('upload') ?>
    <?= Sessao::izitoast('produto') ?>

    <a class="btn btn-primary " href="<?= URL ?>/admin/produto/" style="width: 10rem;padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">
        Voltar
    </a>
    <form action="<?= URL ?>/admin/produto/create" method="post" enctype="multipart/form-data">
        <p> 
            escolha a sua imagem
            <input type="file" class="form-control <?= $dados['err_img'] ? 'is-invalid' : '' ?>" name="upload" id="">
            <span class="invalid-feedback">
                    <?= $dados['err_img'] ?>
                </span>
            
        </p>
        <div class="row">
        <p class="form-group col-12 col-md-6">
            escolha o nome do produto <br>
            <input type="text" class="form-control <?= $dados['err_name'] ? 'is-invalid' : '' ?>" name="name" id="">
            <span class="invalid-feedback">
                    <?= $dados['err_name'] ?>
                </span>
        </p>
        <p class="form-group col-12 col-md-6">
            valor a ser vendido <br>
            <input type="number" class="form-control <?= $dados['err_value'] ? 'is-invalid' : '' ?>" name="value" id="">
            <span class="invalid-feedback">
                    <?= $dados['err_value'] ?>
                </span>
        </p>
        </div>
        <p>
            codigo de barra <br>
            <input type="text" class="form-control <?= $dados['err_code'] ? 'is-invalid' : '' ?>" name="code" id="">
            <span class="invalid-feedback">
                    <?= $dados['err_code'] ?>
                </span>
        </p>
        <p>
            categoria <br>
            <select class="form-select  <?= $dados['err_cat'] ? 'is-invalid' : '' ?>" aria-label="Default select example" name="cat">
                <option selected disabled>Escolha a categoria</option>
                <?php foreach ($dados['read_c'] as $value) : ?>
                    <option value='<?= $value['id'] ?>'><?= $value['nome'] ?></option>
                <?php endforeach; ?>
            </select>
            <span class="invalid-feedback">
                    <?= $dados['err_cat'] ?>
                </span>
        </p>

        <button type="submit" class="btn btn-primary" name="store" value="submit">Cadastrar</button>

    </form>
</section>