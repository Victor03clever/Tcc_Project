<?php

use App\Helpers\Sessao;
?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
    <h1>Produtos / Estoque / Actualizar Estoque</h1>

    <?=Sessao::sms('erro') ?>
    <?=Sessao::izitoast('est') ?>


    <a class="btn btn-primary " href="<?= URL ?>/admin/estoque" style="width: 10rem;padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">
        Voltar
    </a>
    <form action="<?= URL ?>/admin/estoque/edite/<?=$estoque['e_id']?>" method="post" enctype="multipart/form-data">
        <p>
            <label for="lote">Lote</label>
            <input type="text" class="form-control <?= $dados['err_lote'] ? 'is-invalid' : '' ?>" name="lote" id="lote" value="<?=$dados['lote']?>" placeholder="Lote">
            <span class="invalid-feedback">
                <?= $dados['err_lote'] ?>
            </span>

        </p>
        <div class="row">
            <p class="form-group col-12 col-md-6">
                <label for="fab"> Data de Fabricação</label> <br>
                <input type="date" class="form-control <?= $dados['err_fab'] ? 'is-invalid' : '' ?>" name="fab" id="fab" value="<?=$dados['fab']?>" placeholder="Fabrição">
                <span class="invalid-feedback">
                    <?= $dados['err_fab'] ?>
                </span>
            </p>
            <p class="form-group col-12 col-md-6">
                <label for="exp">Data de Expiração</label> <br>
                <input type="date" class="form-control <?= $dados['err_exp'] ? 'is-invalid' : '' ?>" name="exp" id="exp" value="<?=$dados['exp']?>" placeholder="Expiração">
                <span class="invalid-feedback">
                    <?= $dados['err_exp'] ?>
                </span>
            </p>
            <p class="form-group col-12 col-md-6">
                <label for="qtd">Quantidade</label> <br>
                <input type="number" class="form-control <?= $dados['err_qtd'] ? 'is-invalid' : '' ?>" name="qtd" id="qtd" value="<?=$dados['qtd']?>" placeholder="Quantidade">
                <span class="invalid-feedback">
                    <?= $dados['err_qtd'] ?>
                </span>
            </p>
            <!-- <p class="form-group col-12 col-md-6">
                
                

                <label for="pro" >Produto</label><br>
                <input class="form-control  <= $dados['err_pro'] ? 'is-invalid' : '' ?>" list="datalistOptions" id="pro" name="produto" placeholder="pesquise o produto"         value="<=$dados['produto']?>">
                <datalist id="datalistOptions">
                <php foreach ($produto as $value) : ?>
                        <option value='<= $value['id'] ?>'><= $value['nome'] ?></option>
                    <php endforeach; ?>
                </datalist>
                <span class="invalid-feedback">
                    <= $dados['err_pro'] ?>
                </span>
            </p> -->
        </div>

        <button type="submit" class="btn btn-primary" name="store" value="submit">Actualizar</button>

    </form>
</section>