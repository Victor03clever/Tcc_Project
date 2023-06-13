<?php

use App\Helpers\Sessao;

?>
<?= Sessao::izitoast('request'); ?>

<link rel="stylesheet" href="<?= asset("css/client/style2.css") ?>">
<main class="wrapper">
  <h1 style="font-size: 3rem;">Pedidos</h1>
  <div class="d-flex flex-wrap justify-content-between align-items-start">
    <div id="all" class="">
      <h1>Refeições</h1>
      <div class="pedidos">
        <?php $totalR = 0;
        foreach ($allRequest as $key => $value) : ?>
          <div class="pedido">
            <img src="<?= asset($value['re_img']) ?>" alt="">
            <span class="pri">
              <span class="seg">
                <h4 class="qtd"><?= $value['qtd'] ?>x</h4>
                <h4><?= $value['re_nome'] ?></h4>
                <small>KZ <?= $value['pe_preco'] * $value['qtd'] ?></small>
                <?php $totalR += $value['pe_preco'] * $value['qtd'] ?>
              </span>
              <form action="<?= URL ?>/request/deleteRequest/<?= $value['pe_id'] ?>" method="post">
                <button type="submit" name="delete" value="submit" class="ter">Excluir</button>
              </form>
            </span>
          </div>
        <?php endforeach; ?>
      </div>
      <h3>Total de Refeições: KZ <?= $totalR ?></h3>
    </div>

     <div id="all" class="">
      <h1>Bebidas</h1>

      <div class="pedidos">
        <?php $totalP = 0;
        foreach ($allRequestP as $key => $value) : ?>
          <div class="pedido">
            <img src="<?= asset($value['pr_img']) ?>" alt="">
            <span class="pri">
              <span class="seg">
                <h4 class="qtd"><?= $value['qtd'] ?>x</h4>
                <h4><?= $value['pr_nome'] ?></h4>
                <small>KZ <?= $value['pe_preco'] * $value['qtd'] ?></small>
                <?php $totalP += $value['pe_preco'] * $value['qtd'] ?>
              </span>
              <form action="<?= URL ?>/request/deleteRequest/<?= $value['pe_id'] ?>" method="post">
                <button type="submit" name="delete" value="submit" class="ter">Excluir</button>
              </form>
            </span>
          </div>
        <?php endforeach; ?>
      </div>
      <h3>Total de Bebidas : KZ <?= $totalP ?></h3>

   </div> 

    <!-- <div id="all">
      <h1>Produtos</h1>

      <div class="pedidos">
        <?php $totalP = 0;
        foreach ($allRequestP as $key => $value) : ?>
          <div class="pedido">
            <img src="<?= asset($value['pr_img']) ?>" alt="">
            <span class="pri">
              <span class="seg">
                <h4 class="qtd"><?= $value['qtd'] ?>x</h4>
                <h4><?= $value['pr_nome'] ?></h4>
                <small>KZ <?= $value['pe_preco'] * $value['qtd'] ?></small>
                <?php $totalP += $value['pe_preco'] * $value['qtd'] ?>
              </span>
              <form action="<?= URL ?>/request/deleteRequest/<?= $value['pe_id'] ?>" method="post">
                <button type="submit" name="delete" value="submit" class="ter">Excluir</button>
              </form>
            </span>
          </div>
        <?php endforeach; ?>
      </div>
      <h3>Total de Produtos: KZ <?= $totalP ?></h3>

    </div> -->
  </div>
  <h2 class=" mt-5">Total Geral: <?= $totalR + $totalP ?></h2>
  <form action="<?= URL ?>/request/confirmRequest" method="post">
    <!-- <a href="<=URL?>" class="btn btn-dark">Voltar</a> -->
    <button type="submit" onclick="clearCart()" name="confirm" value="submit">
      Confirmar
    </button>
  </form>

  <a href="<?=URL?>" class="btn btn-dark p-3 fs-4 " style="margin-bottom:9rem">Voltar</a>
</main>
<div class="cards d-none" data-url="<?= URL ?>"></div>