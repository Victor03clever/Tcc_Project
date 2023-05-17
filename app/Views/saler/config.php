<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/saler/style2.css") ?>">
<section id="nav-taps">
  <h1>Configurações</h1>
  <?= Sessao::izitoast('config') ?>
  <?= Sessao::sms('upload') ?>
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

                    <img src="<?= $_SESSION['usuarioS_img'] ?>" alt="Profile" class="rounded-circle" width="120" height="120">
                    <h2><?= $dados['nome'] ?></h2>
                    <h3>Saler</h3>
                    <div class="social-links mt-2">

                    </div>
                  </div>
                </div>

              </div>
              <div class="col-xl-8">
                <div class="card">
                  <div class="card-body pt-3">

                    <h5 class="card-title">Profile Details</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Nome</div>
                      <div class="col-lg-9 col-md-8"><?= $dados['nome'] ?></div>
                    </div>



                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Email</div>
                      <div class="col-lg-9 col-md-8"><?= $dados['email'] ?></div>
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

                    <img src="<?= $_SESSION['usuarioS_img'] ?>" alt="Profile" class="rounded-circle" width="120" height="120">
                    <h2><?= $dados['nome'] ?></h2>
                    <h3>Saler</h3>
                    <div class="social-links mt-2">

                    </div>
                  </div>
                </div>

              </div>
              <div class="col-xl-8">
                <div class="card p-3">
                  <!-- Change Password Form -->
                  <form method="post" action="<?= URL ?>/saler/config/">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Senha actual</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="senha" type="password" class="form-control <?= $change['err_senha'] ? 'is-invalid' : ''; ?>" id="currentPassword">
                        <div class="invalid-feedback">
                          <?= $change['err_senha'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nova Senha</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="novasenha" type="password" class="form-control <?= $change['err_newpass'] ? 'is-invalid' : ''; ?>" id="newPassword">
                        <div class="invalid-feedback">
                          <?= $change['err_newpass'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Repita nova senha</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="password" class="form-control <?= $change['err_renewpass'] ? 'is-invalid' : ''; ?>" id="renewPassword" name="rnovasenha">
                        <div class="invalid-feedback">
                          <?= $change['err_renewpass'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="altSenha" value="alterar" class="btn btn-primary">Salvar</button>
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

                    <img src="<?= $_SESSION['usuarioS_img'] ?>" alt="Profile" class="rounded-circle" width="120" height="120">
                    <h2><?= $dados['nome'] ?></h2>
                    <h3>Saler</h3>
                    <div class="social-links mt-2">

                    </div>
                  </div>
                </div>

              </div>
              <div class="col-xl-8">
                <div class="card p-3">
                  <!-- Profile Edit Form -->
                  <form method="post" action="<?= URL ?>/saler/config" enctype="multipart/form-data">

                    <div class="row mb-3">
                      <label for="upload" class="col-md-4 col-lg-3 col-form-label">Foto de perfil</label>
                      <div class="col-md-8 col-lg-9">
                        <figure for="upload" title="Clique para procurar">
                          <img src="<?= $_SESSION['usuarioS_img'] ?>" alt="Profile" width="120" height="120" data-bs-toggle="modal" data-bs-target="#uploadmodals">
                        </figure>
                        <div class="pt-2">

                          <a class="btn btn-lg " title="Carregar nova foto" style="background:#065e7c;color:#dce0ea; width:initial; height:initial;" data-bs-toggle="modal" data-bs-target="#uploadmodals"><i class="bi bi-upload fs-5"></i></a>

                          <a href="<?= URL ?>/saler/deletetofo" class="btn btn-danger btn-lg " title="Remove my profile image"><i class="bi bi-trash3"></i></a>


                          <!-- Modal -->
                          <div class="modal fade" id="uploadmodals" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered      ">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Actualizar a foto do perfil</h5>
                                  <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div for="upload" title="Clique para procurar" id="uploadContent" style="position:relative; padding: 1rem; width:100%; border: .1rem dashed white; border-radius:.5rem ;text-align:center;">
                                    <i class="bi bi-cloud-upload-fill"></i>
                                    <span>Arraste ou clique aqui</span>
                                    <input type="file" name="upload" id="upload" style="all:unset; inset:0; position:absolute; opacity:0;">

                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">fechar</button>
                                  <button type="submit" name="load" value="2" class="btn btn-primary btn-lg fs-5" style="width:initial; height:initial">salvar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="nome" class="col-md-4 col-lg-3 col-form-label">Nome Completo</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nome" type="text" class="form-control <?= $dados['err_nome'] ? 'is-invalid' : ''; ?>" id="nome" value="<?= $dados['nome'] ?>">
                        <div class="invalid-feedback">
                          <?= $dados['err_nome'] ?>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control <?= $dados['err_email'] ? 'is-invalid' : ''; ?>" id="eamil" value="<?= $dados['email'] ?>">
                        <div class="invalid-feedback">
                          <?= $dados['err_email'] ?>
                        </div>
                      </div>
                    </div>


                    <div class="text-center">
                      <button type="submit" name="cad" value="s" class="btn btn-primary">Salvar</button>
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