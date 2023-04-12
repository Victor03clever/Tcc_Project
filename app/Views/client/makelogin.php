<?php

use App\Helpers\Sessao;
// Sessao::notify('teste');

?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="<?= asset(BOOTCSS) ?>">
  <link rel="stylesheet" href="<?= asset(IZOCSS) ?>">
  <script src="<?= asset(JQUERY) ?>"></script>
  <script src="<?= asset(IZOJS) ?>"></script>
  <link rel="stylesheet" href="<?= asset("css/client/style1.css") ?>">
  <link rel="shortcut icon" href="<?= asset("img/favicon.png") ?>" type="image/x-icon">
  <style>
    body{
      overflow: hidden;
    }
    .btn_back {
      background: hsl(195, 91%, 25%);
    }

    .btn_back1 {
      background: hsla(199, 100%, 5%, 1);
    }

    button.btn_back1:hover {
      filter: brightness(1.3);
    }

    .btn_color {
      color: hsla(199, 100%, 5%, 1);
    }

    .btn_color:hover {
      color: gray;

    }
   
  </style>
</head>

<body>
  <main class="wrapper">
    <?= Sessao::izitoast('loginE'); ?>
    <?= Sessao::izitoast('signup'); ?>
    <img src="<?= asset("img/logo.png") ?>" alt="logotipo de um refeitorio">
    <form action="<?= URL ?>/client/login" method="post">
      <h1>Faça login</h1>
      <p>
        <label for="nome">Nome</label><br>
        <input class="form-control <?= $dados['erro_nome'] ? 'is-invalid' : '' ?>" type="text" name="nome" id="nome" placeholder="Exemplo: Victor Clever" value="<?= $dados['nome'] ?>" style="background: transparent; color: var(--text);">
        <span class="invalid-feedback" style="text-align: left;">
          <?= $dados['erro_nome'] ?>
        </span>
      </p>
      <p class="position-relative">
        <label for="senha">Senha</label><br>
        <input class="form-control <?= $dados['erro_senha'] ? 'is-invalid' : '' ?>" type="password" name="senha" id="senha" placeholder="Digite a sua senha" value="<?= $dados['senha'] ?>" style="background: transparent; color: var(--text);">
        <span class="togglePass">
          <img id="visible" class="" src="<?= asset("img/visible.png") ?>">
          <img id="hide" class="display" src="<?= asset("img/hide.png") ?>">
        </span>
        <span class="invalid-feedback" style="text-align: left;">
          <?= $dados['erro_senha'] ?>
        </span>
        <span class="dd" style="text-align: left; display:block">
        
          <a href="<?=URL?>/password" class="fs-5 ">Esqueceu a senha?</a>
        </span>

      </p>
      <p class="m-0">
        <button type="submit" name="login" value="submit">Entrar</button>
        <span>
          <a href="<?= URL ?>/client/signup" class="p-0">Criar uma conta</a><br>
          <a href="<?= URL ?>" class="p-0">Retornar ao inicio</a><br>
          <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class=" text-decoration-underline">Funcionário</a>
        </span>
      </p>
    </form>
  </main>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
      <div class=" modal-content" style="width:40rem">
        <!-- <div class="modal-header btn_back">
          <h5 class="modal-title " id="exampleModalLabel">Autenticação do Funcionário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> -->
        <div class="modal-body p-5 btn_back ">
          <form action="<?= URL ?>/saler/login" method="post">
            <h1 class=" p-2">Funcionário</h1>
            <p class=" pb-md-2 text-start">
              <label for="nome" class=" p-2 ">Nome</label><br>
              <input class="p-lg-3 fs-5 form-control <?= $dados['err_nome'] ? 'is-invalid' : '' ?>" type="text" name="nome" id="nome" placeholder="Exemplo: Victor Clever" value="<?= $dados['nome'] ?>">

            </p>
            <p class=" pb-md-2 text-start">
              <label for="senha" class="  p-2 ">Senha</label><br>
              <input class="p-lg-3 fs-5 form-control <?= $dados['err_senha'] ? 'is-invalid' : '' ?>" type="password" name="senha" id="senha" placeholder="Digite a sua senha" value="<?= $dados['senha'] ?>">
              <a href="<?=URL?>/password" class="text-decoration-none fs-5 btn_color">Esqueceu a senha?</a>

            </p>

            <button type="submit" name="btn_log" value="submit" class="p-lg-3 w-25 text-white link-opacity-25-hover btn_back1 border-0 rounded-1 d-flex align-items-start justify-content-center">login</button>

          </form>
        </div>

      </div>
    </div>
  </div>
















  <script>
    const togglePass = document.querySelector(".togglePass")
    const visibleButton = document.querySelector("#visible")
    const hideButton = document.querySelector("#hide")
    const passInput = document.querySelector("#senha")

    function togglePassword() {
      togglePass.addEventListener("click", () => {
        if (passInput.type === "password") {
          passInput.type = "text"
          visibleButton.classList.add("display")
          hideButton.classList.remove("display")

        } else {
          passInput.type = "password"
          visibleButton.classList.remove("display")
          hideButton.classList.add("display")
        }
      })
    }
    togglePassword();
  </script>
  <script src="<?= asset(BOOTJS) ?>"></script>
  <script src="<?= asset(BOOTPOPPER) ?>"></script>
</body>

</html>