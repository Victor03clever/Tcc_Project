<?php

use App\Helpers\Sessao;

?>
<?= Sessao::izitoast('loginS'); ?>
<?= Sessao::izitoast('pedido'); ?>

<?= Sessao::browser('browser'); ?>

<link rel="stylesheet" href="<?= asset("css/client/style.css") ?>">

<span  style="position:relative; top:18rem"><?=$_SESSION['usuarioC_nome']?><br></span>
<span class="dataActual" style="position:relative; top:18rem"></span>

<header class="wrapper header" id="header">
  <img src="<?= asset("img/pngegg 1.png") ?>" alt="Sabores">
  <span>
    <h1>
      Sabores incríveis👌
    </h1>
    <p>Sinta o cuidado do preparo dos nossos pratos.</p>
  </span>
</header>
<section id="refeicoes" class="">
  <div class="wrapper">
    <h4>Refeições</h4>
    <div class="cards cards-dishes" data-authenticated="<?= $_SESSION['usuarioC_id'] ? "true" : "false" ?>" data-url="<?= URL ?>">
      
    </div>
  </div>
</section>
<!-- produtos -->
<!-- <section id="produtos" class="">
  <div class="wrapper">
    <h4>Produtos</h4>
    <div class="category">
      <php if (isset($_SESSION['usuarioC_id'])) : ?>
        <h5> Find by category</h5>
        <div class="cats">

          <div id="cat">
            <button type="submit" class="cat active" name="" data-category=0>
              <img src="<= asset("img/client/cat1.svg") ?>" alt="">
              <h6>Todos</h6>
            </button>
          </div>

          <php foreach ($allcategory as $key => $value) : ?>

            <div id="cat">
              <button type="button" class="cat" name="" data-category="<= $value['id'] ?>">
                 <img src="<= asset("img/client/cat1.svg") ?>" alt="">
                <h6><= $value['nome'] ?></h6>
              </button>
            </div>
          <php endforeach ?>
        </div>
      <php else : ?>
      <php endif; ?>

    </div>

    <div class="cards cards-products" data-authenticated="<= $_SESSION['usuarioC_id'] ? "true" : "false" ?>" data-url="<= URL ?>">
 </form> 
    </div>


  </div>
</section> -->

<section id="produtos" class="">
  <div class="wrapper">
    <h4>Bebidas</h4>
    <div class="cards">
    <?php if ($refresh) : ?>
        <?php foreach ($refresh as $key => $value) : ?>

          <div class="card">

            <img src="<?= asset($value['imagem']) ?>" alt="" width="100" height="100">
            <h6 class="title"><?= $value['p_nome'] ?></h6>
            <h6 class="price">Kz <?= $value['preco'] ?></h6>
            <div class="add">
              <form action="<?= URL ?>/client/makeRequest" method="post">
                <svg class="subtract" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M4 13C4 12.4477 4.33579 12 4.75 12H21.25C21.6642 12 22 12.4477 22 13C22 13.5523 21.6642 14 21.25 14H4.75C4.33579 14 4 13.5523 4 13Z" fill="white" />
                </svg>

                <input type="text" name="qtdP" class="operations" value="01" readonly style="width: 2rem; background: transparent; color: var(--text); border: none; outline: none;">


                <svg class="plus" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M4 13C4 12.5858 4.33579 12.25 4.75 12.25H21.25C21.6642 12.25 22 12.5858 22 13C22 13.4142 21.6642 13.75 21.25 13.75H4.75C4.33579 13.75 4 13.4142 4 13Z" fill="white" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M13 4C13.4142 4 13.75 4.33579 13.75 4.75V21.25C13.75 21.6642 13.4142 22 13 22C12.5858 22 12.25 21.6642 12.25 21.25V4.75C12.25 4.33579 12.5858 4 13 4Z" fill="white" />
                </svg>
            </div>

            <?php if (isset($_SESSION['usuarioC_id'])) : ?>

              <input type="text" value="<?= $value['p_id'] ?>" name="idGo" hidden>
              <button type="submit" name="statusP1" value="submit" class="include"> Adicionar </button>
              </form>
            <?php else : ?>
              <a href="<?= URL ?>/client/login">
                <button type="button"> Adicionar </button>
              </a>
            <?php endif; ?>

          </div>

        <?php endforeach; ?>
      <?php else : ?>
        <h3>Nenhuma Refeição por hoje, agradecemos a sua visita, retornaremos o mais rápido possível🤞.</h3>
      <?php endif; ?>
    </div>
  </div>
</section>

<script src="<?=asset("js/dateRealTime.js")?>"></script>

<script>
  function defaultInCart() {
    inCart = <?= $totalRequest['total'] ?? 0 ?>;
    localStorage.setItem("inCart", inCart);
    document.querySelector(".cart").textContent = inCart;
  }
  defaultInCart()
</script>