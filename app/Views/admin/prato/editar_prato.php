<?php

use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
    <h1>Produtos / Pratos / Editar</h1>
    <?= Sessao::sms('upload') ?>
    <?= Sessao::izitoast('produto') ?>

    <a class="btn btn-primary " href="<?= URL ?>/admin/prato" style="width: 10rem;padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">
        Voltar
    </a>

    <form action="<?= URL ?>/admin/prato/edite/<?=$refeicoes['id']?>" method="post" enctype="multipart/form-data" >
   
                    <p>
                        escolha a sua imagem
                        <input type="file" class="form-control <?= $dados['err_img'] ? 'is-invalid' : '' ?>" name="img" id="" value="<?=URL.'/'.$refeicoes['imagem']?>">
                        <span class="invalid-feedback">
                            <?= $dados['err_img']?>
                        </span>

                    </p>
                    <div class="row">
                        <p class="form-group col-12 col-md-6">
                            escolha o nome do produto <br>
                            <input type="text" class="form-control <?= $dados['err_name'] ? 'is-invalid' : '' ?>" name="name" id="" value="<?=$refeicoes['nome']?>">
                            <span class="invalid-feedback">
                                <?= $dados['err_name'] ?>
                            </span>
                        </p>
                        <p class="form-group col-12 col-md-6">
                            valor a ser vendido <br>
                            <input type="number" class="form-control <?= $dados['err_value'] ? 'is-invalid' : '' ?>" name="value" id="" value="<?=$refeicoes['preco']?>">
                            <span class="invalid-feedback">
                                <?= $dados['err_value'] ?>
                            </span>
                        </p>
                    </div>
                    <p>
                        <label for="status">Status*</label>
                        <select class="form-control" id="status" name="status">
                            <option value="<?=$refeicoes['status']?>" selected><?php
                            if($refeicoes['status']==0){
                                echo "Desactivado";
                            }else{
                                echo "Activado";
                            }
                            ?></option>
                            <option value="1">Ativo</option>
                            <option value="0">Desativado</option>
                        </select>
                    </p>

                    <button type="submit" class="btn btn-primary" name="edit" value="submit">Cadastrar</button>

                </form>
</section>