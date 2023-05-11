<?php

use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
  <?= Sessao::izitoast('prato') ?>
  <?= Sessao::sms('upload') ?>
  <h1> Pratos</h1>
  <!-- Modal trigger button -->


  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">



          <!-- Table with stripped rows -->
          <table class="table datatable table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
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
                      <td><img src="<?= URL ?>/public/<?= $value['imagem'] ?>" alt="" width="35"></td>
                      <td><?= $value['nome'] ?></td>
                      <td><?= $value['preco'] ?></td>
                      <td><?= $value['status'] ?></td>
                      <td>
                        <div class="d-flex align-items-center">
                          <a name="cad" class="btn btn-primary" style="margin-right:.3rem" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $i ?>">
                            <i class="bi bi-pencil-square"></i>
                          </a>

                        </div>
                      </td>

                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Activar o prato</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="<?= URL ?>/saler/saidas" method="post">
                          <div class="modal-body">
                              <p>
                                <input type="text" readonly hidden value="<?=$value['id']?>" name="id">
                                <label for="status">Status*</label>
                                <select class="form-control fs-4" id="status" name="status">
                                  <option value="<?= $value['status'] ?>" selected><?php
                                    if ($value['status'] == 0) {
                                      echo "Desactivado";
                                    } else {
                                      echo "Activado";
                                    }
                                    ?></option>
                                  <option value="1">Ativo</option>
                                  <option value="0">Desativado</option>
                                </select>
                              </p>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Fechar</button>
                              <button type="submit" class="btn btn-primary p-2" name="update" value="submit">Salvar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
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