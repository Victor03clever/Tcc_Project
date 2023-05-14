<?php

use App\Models\admin\Report;
use App\Helpers\Valida;
use App\Helpers\Sessao;

?>
<link rel="stylesheet" href="<?= asset("css/admin/style3.css") ?>">
<section class="section">
 
  <h1>Relatórios / Vendas</h1>
  <!-- Modal trigger button -->

  <a href="<?=URL?>/admin/relatorio/compras" class="btn btn-primary " style="padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">
    Compras
  </a>
  <a href="<?=URL?>/admin/relatorio/pedidos" class="btn btn-primary " style="padding: .7rem;font-size: 1.5rem; margin-bottom:1rem">
    Pedidos
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
                <th scope="col">Vendedor</th>
                <th scope="col">Total</th>
                <th scope="col">F_pagamento</th>
                <th scope="col">Data</th>
                <th scope="col" class="w-25">Ver</th>
              </tr>
            </thead>


            <tbody id="corpo">

              <?php if ($sales) : $i = 0 ?>
                <?php foreach ($sales as $key => $value) : ?>
                  <tr>
                    <td><?= $i += 1 ?></td>
                    <td><?= $value['nome'] ?></td>
                    <td><?= $value['total'] ?></td>
                    <td><?= $value['forma_pagamento'] == '0' ? '(cash)' : '(tpa)' ?></td>
                    <td><?= $value['v_create_at'] ?></td>
                    <td>
                      <div class="d-flex align-items-center">
                        <a class="btn btn-primary" style="margin-right:.3rem" title='ver' data-bs-toggle="modal" data-bs-target="#modalV<?= $i ?>">
                          <i class="bi bi-eye"></i>
                        </a>

                      </div>
                    </td>
                    <!-- Modal vsualizar-->
                    <div class="modal fade" id="modalV<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog        ">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel" style="color:var(--text)">Produtos vendidos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" style="color:var(--text)">
                            <!-- Organizando todos os pedidos -->
                            <?php if (Report::getP($value['v_id']) || Report::getR($value['v_id'])) :
                              $modal = "";  ?>
                              <?php $refresh = Report::getP($value['v_id']); ?>
                              <?php foreach (Report::getR($value['v_id']) as $key => $value) :



                                $modal .= $value['re_nome'] . " (" . $value['qtd'] . "x) =>" . $value['re_preco'] * $value['qtd'] . "kz<br>" . $refresh[$key]['pr_nome'] . " (" . $refresh[$key]['qtd'] . "x) =>" . $refresh[$key]['pr_preco'] * $refresh[$key]['qtd'] . "kz<br>";

                              endforeach; ?>
                              <?php
                              $modal = str_replace('(x) =>0kz<br>', '', $modal);
                              $modal = str_replace('(x)<br>', '', $modal);
                              if ($modal == '') {
                                $ref = Report::getR($value['v_id']);
                                foreach (Report::getP($value['v_id']) as $key => $value) :

                                  $modal .=  $value['pr_nome'] . " (" . $value['qtd'] . "x) =>" . $value['pr_preco'] * $value['qtd'] . "kz<br>";

                                endforeach;
                              }

                              // var_dump($refresh);
                              echo $modal;

                              ?>
                            <?php endif; ?>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">fechar</button>

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
          url: "<?= URL ?>/admin/relatorio/filtrosV",
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