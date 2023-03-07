<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
    <?= Sessao::izitoast('categoriaA'); ?>
    <?= Sessao::izitoast('categoriaS'); ?>
    <?= Sessao::izitoast('categoriaE'); ?>
    <?= Sessao::sms('metodo'); ?>
    <h1>Categorias</h1>
    <!-- Modal trigger button -->
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
                                <th scope="col">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Status</th>
                                <th scope="col">Criação</th>
                                <th scope="col">Acções</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php if (isset($dados)) : $i = 1; ?>
                                <?php foreach ($dados as $value) : ?>
                                    <tr>

                                        <td><?= $i++ ?></td>
                                        <td><?= $value['id'] ?></td>
                                        <td><?= $value['nome'] ?></td>
                                        <td><?= $value['descricao'] ?></td>
                                        <td><?= $value['status'] ?></td>
                                        <td><?= Valida::ANG($value['create_at']) ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a name="cad" href="<?=URL?>/admin/categoria/edit/<?=$value['id']?>" class="btn btn-primary" style="margin-right:.3rem">
                                                    editar
                                                </a>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal<?=$i?>">delectar</button>
                                            </div>
                                        </td>
                                        <!-- Modal delete-->
                                        <div class="modal fade" id="modal<?=$i?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog        ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel" style="color:#000">Tem certeza que deseja delectar?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="color:#dc3545">
                                                        Categoria: <?=$value['nome']?>
                                                        <br>
                                                        Aviso:Todos produtos incluindo codigos de barra cadastrados com essa categoria serão perdidos para sempre
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">abortar</button>
                                                       <form action="<?= URL ?>/admin/categoria/delete/<?= $value['id'] ?>" method="post">
                                                      <button type="submit" class="btn btn-danger" name="delete">Delecte</button>
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
<div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Cadastrar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="container mt-5 mb-5">
                    <form action="<?= URL ?>/admin/categoria" method="POST">
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="nome" style="color:#000">Nome*</label>
                                <input type="text" class="form-control <?= $dados1['erro_nome'] ? 'is-invalid' : '' ?>" value="<?= $dados1['nome'] ?>" id="nome" name="nome" placeholder="Digite o nome da categoria...">
                                <div class="invalid-feedback">
                                    <?= $dados1['erro_nome'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="descricao" style="color:#000">Descrição*</label>
                                <input type="text" class="form-control <?= $dados1['erro_descricao'] ? 'is-invalid' : '' ?>" id="descricao" name="descricao" placeholder="Digite a descrição da categoria..." value="<?= $dados1['descricao'] ?>">
                                <div class="invalid-feedback">
                                    <?= $dados1['erro_descricao'] ?>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="status" style="color:#000">Status*</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Ativo</option>
                                    <option value="0">Desativado</option>
                                </select>
                            </div>
                        </div><br>
                        <button type="submit" class="btn p-3" style="background:#065e7c;color:#dce0ea" name="btn_save" value="salvar">Salvar</button>
                    </form>
                </section>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Abortar</button>
            </div>
        </div>
    </div>
</div>







<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
</script>