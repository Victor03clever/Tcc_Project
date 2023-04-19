<?php

use App\Helpers\Sessao;

Sessao::izitoast("loginS");
Sessao::izitoast("sale");
?>
<link rel="stylesheet" href="<?= asset("css/saler/style.css") ?>">
<div class="content">
  <!-- Botao vender para chamar o mmodal -->
  <button title="venda" class="btn btn-primary m-3 position-fixed" id="vendaButton" data-bs-toggle="modal" data-bs-target="#modalId"><i class="bi-cart text-white" style="font-size: 1.6rem;"></i><span class="badge badge-number position-absolute" style="width:1rem; left:2rem; color:var(--new);">0</span> Vender</button>
  <div class="menu">
    <h1 class="mb-5">Refeições</h1>
    <div class="cards mb-5 cards-dishes">

    </div>
    <h1>Produtos</h1>
    <div class="category">

      <h5> Find by category</h5>
      <div class="cats">

        <div id="cat">
          <button type="submit" class="cat active" name="" data-category="0">
            <img src="<?= asset("img/client/cat1.svg") ?>" alt="">
            <h6>Todos</h6>
          </button>
        </div>

        <?php foreach ($allcategory as $key => $value) : ?>

          <div id="cat">
            <button type="button" class="cat" name="" data-category="<?= $value['id'] ?>">
              <!-- <img src="<= asset("img/client/cat1.svg") ?>" alt=""> -->
              <h6><?= $value['nome'] ?></h6>
            </button>
          </div>
        <?php endforeach ?>
      </div>


    </div>
    <div class="cards cards-products mb-5" data-url="<?= URL ?>">

    </div>
  </div>

</div>


<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content rounded-3" style="width: 100% ;height:100%;">
      <div class="modal-header">
        <h5 class="modal-title fs-2" id="modalTitleId">Efectuar uma venda</h5>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" id="search">
          <input class="form-control mb-3" list="datalistOptions" id="exampleDataList" placeholder="pesquise aqui">
          <datalist id="datalistOptions">
            <option value="San Francisco">
            <option value="New York">
            <option value="Seattle">
          </datalist>
          <button type="submit" class="btn btn-primary p-0" style="height: 3rem;" title="adicionar">
            <i class="bi bi-plus text-white p-0"></i>
          </button>
        </form>
        <!-- Table with stripped rows -->
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Qtd</th>
              <th scope="col">img</th>
              <th scope="col">Nome</th>
              <th scope="col">Preço</th>
              <th scope="col">total</th>
              <th scope="col"></th>
            </tr>
          </thead>

          <tbody>
            <!-- Sera acrescentado por intermédio do javascript -->
          </tbody>


        </table>

        <form action="<?= URL ?>/saler/sale" method="post" id="venda">
          <hr>
          <div class="divInputs d-none"></div>
          <span class="totalprice">
            <h1>Total:</h1>
            <h1 id="totalCost">0.00</h1>
          </span>
          <hr>
          <div class="payment">
            <div class="paymenttype">
              <select class="form-select text-black fs-4" aria-label="Default select example" name="f_pagamento" id="modepayment">
                <option selected disabled value="">Selecione a forma de pagamento</option>
                <option value="0">Cash</option>
                <option value="1">Tpa</option>
              </select>
            </div>
            <div class="clientname row">
              <div class="name col-6">
                <input class="form-control mb-3" list="datalistname" id="exampleDataListname" placeholder="Nome do cliente" name="cliente">
                <datalist id="datalistname">
                  <option value="Aldair">
                  <option value="Psicopata em pessoa">
                  <option value="Antonio">
                </datalist>
              </div>
              <div class="col-6">
                <input type="number" class="form-control" id="pay" aria-describedby="textHelp" placeholder="VALOR A PAGAR" name="pagamento">
              </div>
              <span id="troco" class="fs-1">Troco: 0.00</span>
              <input type="text" name="troco" id="change"  hidden>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary w-25 fs-4 p-2 cancelCart" data-bs-dismiss="modal"><i class="bi bi-x ttext white"></i> Abortar</button>
        <button type="submit" class="btn btn-primary w-25" name="sale" value="submit"><i class="bi bi-check text-white"></i>
          Vender</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>

</script>
<script src="<?= asset("js/saler/validateSale.js") ?>"></script>
<script src="<?= asset("js/saler/getApiDishes.js") ?>"></script>
<script src="<?= asset("js/saler/getApiProducts.js") ?>"></script>