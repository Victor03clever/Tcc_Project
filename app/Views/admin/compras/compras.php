<?php

use App\Helpers\Sessao;
?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
  <?= Sessao::izitoast("compra") ?>
  <?= Sessao::sms("comp") ?>
  <h1>Compras</h1>
  <!-- Modal trigger button -->
  <a href="<?= URL ?>/admin/compras/cadastrar" class="btn btn-primary  mb-3" style="padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">
    + Factura
  </a>
  <a href="<?= URL ?>/admin/fornecedores" class="btn btn-primary" style="padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">Fornecedores</a>

  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">


          <!-- Table with stripped rows -->
          <table class="table datatable table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Fornecedor</th>
                <th scope="col">Total</th>
                <th scope="col">Data</th>
              </tr>
            </thead>
            <tfoot>

              <tbody>
                <?php if ($list) : $i = 1; ?>
                  <?php foreach ($list as $key => $value) : ?>
                    <tr>
                      <th scope="row"><?= $i++ ?></th>
                      <td><?= $value['nome_f'] ?></td>
                      <td><?= $value['total_fc'] ?></td>
                      <td><?= $value['create_at'] ?></td>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <a name="cad" href="<?= asset($value['path']) ?>" target="__blank" class="btn btn-primary" title="ver fatura">
                            <i class="bi bi-journal-bookmark-fill"></i>
                          </a>
                          <button class="btn btn-danger " title="deletar" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $i ?>"><i class="bi bi-trash3"></i></button>
                        </div>
                      </td>
                    </tr>


                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog        ">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Deseja deletar?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Tem certeza que deseja eliminar esta compra?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="<?= URL ?>/admin/compras/delete/<?= $value['id_fc'] ?>" method="post">
                              <button type="submit" name="delete" value="submit" class="btn btn-primary p-1">Deletar</button>
                            </form>
                          </div>
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