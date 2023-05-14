<?php

use App\Models\admin\Report;
use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
 
  <h1>Relatórios / Compras</h1>
  <!-- Modal trigger button -->

  <a href="<?=URL?>/admin/relatorio" class="btn btn-primary " style="padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">
    Voltar
  </a>
 



  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <div class="row">

            <div class="mb-3 col-5">
              <input type="date" class="form-control" id="fromDate" aria-describedby="textHelp" style="padding:1.8rem" placeholder="Apartir da data">
              <div id="textHelp" class="form-text">Apartir da data</div>
            </div>
            <div class="mb-3 col-5">

              <input type="date" class="form-control" id="toDate" aria-describedby="textHelp" placeholder="Para data" style="padding:1.8rem">
              <div id="textHelp" class="form-text">Para a data</div>

            </div>
            <div class="mb-3 col-2 p-0">

              <button type="button" class="btn btn-primary" id="filter">Filtrar</button>
            </div>
          </div>

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


            <tbody id="corpo">

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

                        </div>
                      </td>
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
<script>
  // filtrar entre datas com ajax

  $(document).ready(function() {


    // $.datepicker.setDefaults({
    //   dateFormat: 'yy-mm-dd'
    // })

    // $(function() {
    //   $("#fromDate").datepicker();
    //   $("#toDate").datepicker();
    // });

    $('#filter').click(function() {
      
      var from_date = $('#fromDate').val();
      var to_date = $('#toDate').val();

      if (from_date != '' && to_date != '') {
        $.ajax({
          url: "<?= URL ?>/admin/relatorio/filtrosC",
          method: "POST",
          data: {
            fromDate: from_date,
            toDate: to_date
          },
          success: function(data) {
            // console.log(data);
            $('#corpo').html(data);
          }
        });
      } else {
        alert("Porfavor informe as datas");
      }
    });

  });
      
</script>