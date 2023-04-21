<?php
use App\Helpers\Sessao;
?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
  <?=Sessao::izitoast("compra")?>
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
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Age</th>
                <th scope="col">Start Date</th>
              </tr>
            </thead>
            <tfoot>

              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Brandon Jacob</td>
                  <td>Designer</td>
                  <td>28</td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <a name="cad" href="#" class="btn btn-primary">
                        <i class="bi bi-journal-bookmark-fill"></i>
                      </a>
                      <a name="cad" href="#" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <form action="#" method="post">
                        <button class="btn btn-danger "><i class="bi bi-trash3"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>

              </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>



