<?php

use App\Helpers\Sessao;

?>
<?= Sessao::izitoast('loginS'); ?>
<?= Sessao::izitoast('pedido'); ?>

<?= Sessao::browser('browser'); ?>

<link rel="stylesheet" href="<?= asset("css/client/style.css") ?>">
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

<section id="produtos" class="">
  <div class="wrapper">
    <h4>Produtos</h4>
    <div class="category">
      <?php if (isset($_SESSION['usuarioC_id'])) : ?>
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
      <?php else : ?>
      <?php endif; ?>

    </div>

    <div class="cards cards-products" data-authenticated="<?= $_SESSION['usuarioC_id'] ? "true" : "false" ?>" data-url="<?= URL ?>">
      </form>
    </div>


  </div>
</section>

<script>
  function dataActual() {
    let span = document.querySelector('.dataActual')
    let data = new Date()
    dia = data.getDate()
    diaSemanal = data.getDay() + 1
    mes = data.getMonth() + 1
    ano = data.getFullYear()
    hora = data.getHours()
    min = data.getMinutes()
    seg = data.getSeconds()
    switch (diaSemanal) {
      case 1:
        diaSemanal = "Domingo,";
        break;
      case 2:
        diaSemanal = "Segunda F,";

        break;
      case 3:
        diaSemanal = "Terça F,";
        break;
      case 4:
        diaSemanal = "Quarta F,";
        break;
      case 5:
        diaSemanal = "Quinta F,";
        break;
      case 6:
        diaSemanal = "Sexta F,";
        break;
      case 7:
        diaSemanal = "Sábado,";

        break;

      default:
        diaSemanal = "";
        break;
    }
    span.innerHTML = `${diaSemanal} Aos ${dia}/${mes}/${ano} ${hora}:${min}:${seg}`
  }
  setInterval(() => {
    dataActual()
  }, 111);

  function defaultInCart() {
    inCart = <?= $totalRequest['total'] ?? 0 ?>;
    localStorage.setItem("inCart", inCart);
    document.querySelector(".cart").textContent = inCart;
  }
  defaultInCart()
</script>