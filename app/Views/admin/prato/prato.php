<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
    <?= Sessao::izitoast('prato') ?>
    <?= Sessao::sms('upload') ?>
    <h1>Produtos / Pratos</h1>
    <!-- Modal trigger button -->
    <a href="<?=URL?>/admin/produto" class="btn btn-primary" style="width: 10rem;
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
                                <th scope="col">Id</th>
                                <th scope="col">img</th>
                                <th scope="col">Name</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tfoot>

                            <tbody>
                                <?php if (isset($pratos)) : $i = 1; ?>
                                    <?php foreach ($pratos as $value) : ?>
                                        <tr>

                                            <td><?= $i++ ?></td>
                                            <td><?= $value['id'] ?></td>
                                            <td><img src="<?= URL ?>/public/<?= $value['imagem'] ?>" alt="" width="35"></td>
                                            <td><?= $value['nome'] ?></td>
                                            <td><?= $value['preco'] ?></td>
                                            <td><?= $value['status'] ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a name="cad" href="<?= URL ?>/admin/prato/edite/<?= $value['id'] ?>" class="btn btn-primary" style="margin-right:.3rem">
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
                                                            Prato: <?= $value['nome'] ?>
                                                            <br>
                                                            Aviso:Todos produtos serão perdidos para sempre
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">abortar</button>
                                                            <form action="<?= URL ?>/admin/prato/delete/<?= $value['id'] ?>" method="post">
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
<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Cadastrar Prato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= URL ?>/admin/prato" method="post" enctype="multipart/form-data" >
                    <p>
                        escolha a sua imagem
                        <input type="file" class="form-control <?= $dados['err_img'] ? 'is-invalid' : '' ?>" name="img" id="">
                        <span class="invalid-feedback">
                            <?= $dados['err_img'] ?>
                        </span>

                    </p>
                    <div class="row">
                        <p class="form-group col-12 col-md-6">
                            escolha o nome do prato <br>
                            <input type="text" class="form-control <?= $dados['err_name'] ? 'is-invalid' : '' ?>" name="name" id="" placeholder="nome do prato">
                            <span class="invalid-feedback">
                                <?= $dados['err_name'] ?>
                            </span>
                        </p>
                        <p class="form-group col-12 col-md-6">
                            valor a ser vendido <br>
                            <input type="number" class="form-control <?= $dados['err_value'] ? 'is-invalid' : '' ?>" name="value" id="" placeholder="preço">
                            <span class="invalid-feedback">
                                <?= $dados['err_value'] ?>
                            </span>
                        </p>
                    </div>
                    <p>
                        <label for="status">Status*</label>
                        <select class="form-control fs-5" id="status" name="status">
                            <option value="1">Ativo</option>
                            <option value="0" selected>Desativado</option>
                        </select>
                    </p>

                    <button type="submit" class="btn btn-primary" name="save" value="submit">Cadastrar</button>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal">Close</button>
                < </div>
            </div>
        </div>
    </div>


    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
    </script>