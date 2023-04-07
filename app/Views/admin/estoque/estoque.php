<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
    <?= Sessao::izitoast('est') ?>
    <?=Sessao::sms('erro') ?>


    <h1>Produtos / Estoque</h1>
    <!-- Modal trigger button -->
    <a href="<?= URL ?>/admin/produto" class="btn btn-primary" style="width: 10rem;padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">Voltar</a>
    <a class="btn btn-primary" href="<?= URL ?>/admin/estoque/create" style="width: 10rem;padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">
        + Entrada
    </a>

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">


                    <!-- Table with stripped rows -->
                    <table class="table datatable table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">id</th>
                                <th scope="col">img</th>
                                <th scope="col">Nome</th>
                                <th scope="col">qtd.Estoque</th>
                                <th scope="col">Lote</th>
                                <th scope="col">Fabri</th>
                                <th scope="col">Expir</th>
                                <th scope="col">Entrado em</th>
                            </tr>
                        </thead>
                        <tfoot>

                            <tbody>
                                <?php if (isset($dados)) : $i = 1; ?>
                                    <?php foreach ($dados as $value) : ?>
                                        <tr>

                                            <td><?= $i++ ?></td>
                                            <td><?= $value['e_id'] ?></td>
                                            <td><img src="<?= URL ?>/public/<?= $value['p_imagem'] ?>" alt="" width="35" height="35"></td>
                                            <td><?= $value['p_nome'] ?></td>
                                            <td><?= $value['qtd'] ?></td>
                                            <td><?= $value['l_lote'] ?></td>
                                            <td><?= $value['data_prod'] ?></td>
                                            <td><?= $value['data_exp'] ?></td>
                                            <td><?= $value['e_create'] ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a name="cad" href="<?= URL ?>/admin/estoque/edite/<?= $value['e_id'] ?>" class="btn btn-primary" style="margin-right:.3rem">
                                                        actualizar
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
                                                            Aviso: Delectará a entrada de estoque feito com esse produto.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">abortar</button>
                                                            <form action="<?= URL ?>/admin/estoque/delete/<?= $value['l_id'] ?>" method="post">
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