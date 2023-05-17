<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/client/styleC.css") ?>">
<section id="nav-taps" class="wrapper">
  <?= Sessao::izitoast('config') ?>
  <?= Sessao::sms('upload') ?>
  <h1>Configurações</h1>

  <div class="row gy-4">
    <div class="col-lg-3 links">
      <ul class="nav nav-tabs flex-column">
        <li class="nav-item">
          <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Alterar Senha</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Editar Perfil</a>
        </li>


      </ul>
    </div>
    <div class="col-lg-9">
      <div class="tab-content">
        <div class="tab-pane active show" id="tab-1">
          <section class="section profile">
            <div class="row">
              <div class="col-xl-4">

                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="<?= $_SESSION['usuarioC_img'] ?>" alt="Profile" class="rounded-circle" width="120" height="120">
                    <h2><?= $dados['nome'] ?></h2>
                    <h3>Cliente</h3>
                    <div class="social-links mt-2">

                    </div>
                  </div>
                </div>

              </div>
              <div class="col-xl-8">
                <div class="card">
                  <div class="card-body pt-3">

                    <h5 class="card-title">Detalhes de perfil</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Nome :</div>
                      <div class="col-lg-9 col-md-8"><?= $dados['nome'] ?></div>
                    </div>



                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Telefone :</div>
                      <div class="col-lg-9 col-md-8"><?= $dados['telefone'] ?></div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </section>

        </div>
        <div class="tab-pane" id="tab-2">
          <section class="section profile">
            <div class="row">
              <div class="col-xl-4">

                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="<?= $_SESSION['usuarioC_img'] ?>" alt="Profile" class="rounded-circle" width="120" height="120">
                    <h2><?= $dados['nome'] ?></h2>
                    <h3>Cliente</h3>
                    <div class="social-links mt-2">

                    </div>
                  </div>
                </div>

              </div>
              <div class="col-xl-8">
                <div class="card p-3">
                  <!-- Change Password Form -->
                  <form method="post" action="<?= URL ?>/client/config/">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Senha actual</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="senha" type="password" class="form-control <?= $change['err_senha'] ? 'is-invalid' : ''; ?>" id="currentPassword">
                        <div class="invalid-feedback" style="text-align: left;">
                          <?= $change['err_senha'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nova Senha</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="novasenha" type="password" class="form-control <?= $change['err_newpass'] ? 'is-invalid' : ''; ?>" id="newPassword">
                        <div class="invalid-feedback" style="text-align: left;">
                          <?= $change['err_newpass'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Repita nova senha</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="password" class="form-control <?= $change['err_renewpass'] ? 'is-invalid' : ''; ?>" id="renewPassword" name="rnovasenha">
                        <div class="invalid-feedback" style="text-align: left;">
                          <?= $change['err_renewpass'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="altSenha" value="alterar" class="btn " style="color: var(--textS); background:var(--blue2);">Salvar</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div>
            </div>
          </section>

        </div>
        <div class="tab-pane" id="tab-3">
          <section class="section profile">
            <div class="row">
              <div class="col-xl-4">

                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="<?= $_SESSION['usuarioC_img'] ?>" alt="Profile" class="rounded-circle" width="120" height="120">
                    <h2><?= $dados['nome'] ?></h2>
                    <h3>Cliente</h3>
                    <div class="social-links mt-2">

                    </div>
                  </div>
                </div>

              </div>
              <div class="col-xl-8">
                <div class="card p-3">
                  <!-- Profile Edit Form -->
                  <form method="post" action="<?= URL ?>/client/config" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="upload" class="col-md-4 col-lg-3 col-form-label">Foto de perfil</label>
                      <div class="col-md-8 col-lg-9">
                        <figure for="upload" title="Clique para procurar" data-bs-toggle="modal" data-bs-target="#uploadmodal">
                          <img src="<?= $_SESSION['usuarioC_img'] ?>" alt="Profile" width="120" height="120"></figure>
                        <div class="pt-2">

                          <a class="btn btn-lg " title="Carregar nova foto" style="background:#065e7c;color:#dce0ea; width:initial; height:initial;" data-bs-toggle="modal" data-bs-target="#uploadmodal"><i class="bi bi-upload fs-5"></i></a>



                          <!-- Modal -->
                          <div class="modal fade" id="uploadmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered      ">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Actualizar foto de perfil</h5>
                                  <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div for="upload" title="Clique para procurar" id="uploadContent" style="position:relative; padding: 1rem; width:100%; border: .1rem dashed white; border-radius:.5rem">
                                  <i class="bi bi-cloud-upload-fill"></i>
                                    <span>Arraste ou clique aqui</span>
                                    <input type="file" name="upload" id="upload" style="all:unset; inset:0; position:absolute; opacity:0;">

                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <a type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal" >Fechar</a>
                                  <button type="submit" class="btn btn-primary btn-lg" style="width:initial; height:initial;" title="Salvar nova foto" name="load" value="2">salvar</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          

                          <a href="<?= URL ?>/client/deletetofo" class="btn btn-danger btn-lg" title="Delectar foto"><i class="bi bi-trash3"></i></a>
                        </div>
                      </div>
                    </div>
                    <hr>

                    <div class="row mb-3">
                      <label for="nome" class="col-md-4 col-lg-3 col-form-label">Nome Completo</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nome" type="text" class="form-control <?= $dados['err_nome'] ? 'is-invalid' : ''; ?>" id="nome" value="<?= $dados['nome'] ?>">
                        <div class="invalid-feedback" style="text-align: left;">
                          <?= $dados['err_nome'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="number" class="col-md-4 col-lg-3 col-form-label">Telefone</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="input-group">
                          <span class="input-group-text">+244</span>
                          <input name="telefone" type="number" class="form-control <?= $dados['err_telefone'] ? 'is-invalid' : ''; ?>" id="number" value="<?= $dados['telefone'] ?>">
                          <div class="invalid-feedback" style="text-align: left;">
                            <?= $dados['err_telefone'] ?>
                          </div>
                        </div>
                      </div>
                    </div>









                    <div class="text-center">
                      <button type="submit" class="btn" name="perfil" value="s" style="color: var(--textS); background:var(--blue2);">Salvar</button>
                    </div>
                  </form><!-- End Profile Edit Form -->
                </div>
              </div>
            </div>
          </section>

        </div>


      </div>
    </div>
  </div>
</section>
<div class="cards d-none" data-url="<?= URL ?>"></div>