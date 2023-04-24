<?php

use App\Helpers\Sessao;
// Sessao::notify('teste');

?>



<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="<?= asset(BOOTCSS) ?>">
  <link rel="stylesheet" href="<?= asset(IZOCSS) ?>">
  <script src="<?= asset(JQUERY) ?>"></script>
  <script src="<?= asset(IZOJS) ?>"></script>
  <link rel="stylesheet" href="<?= asset("css/admin/style1.css") ?>">
  <link rel="shortcut icon" href="<?= asset("img/favicon.png") ?>" type="image/x-icon">

  <!-- <script src="<=asset(NOTIFY)?>"></script> -->

</head>

<body>
  <?= Sessao::izitoast('loginE'); ?>
  <main class="wrapper">
    <!-- <img src="<= asset("img/logo.png") ?>" alt="logotipo de um refeitorio"> -->
    <form action="<?= URL ?>/admin/login" method="post">
      <h1>Administrador</h1>
      <p>

        <label for="nome">Nome</label><br>
        <input style="background: transparent; color: var(--text);" type="text" class="form-control <?= $dados['erro_nome'] ? 'is-invalid' : '' ?>" value="<?= $dados['nome'] ?>" id="nome" name="nome" placeholder="Exemplo: Victor clever">
        <span class="invalid-feedback">
          <?= $dados['erro_nome'] ?>
        </span>

      </p>
      <p class="position-relative">
        <label for="senha">Senha</label><br>
        <input style="background: transparent; color: var(--text);" type="password" class="form-control <?= $dados['erro_senha'] ? 'is-invalid' : '' ?>" name="senha" id="senha" value="<?= $dados['senha'] ?>" name="senha" placeholder="Digite a sua senha">
        <span class="togglePass">
          <img id="visible" class="" src="<?= asset("img/visible.png") ?>">
          <img id="hide" class="display" src="<?= asset("img/hide.png") ?>">
        </span>
        <span class="invalid-feedback">
          <?= $dados['erro_senha'] ?>
        </span>
        <span class="text-start d-block">

          <a href="<?= URL ?>/password" class="fs-5  text-decoration-none hover-link">Esqueceu a senha?</a>
        </span>
      </p>
      <p>
        <button type="submit" name="btn_log" value="logar">Entrar</button>
      </p>

    </form>
  </main>
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
  <script src="<?= asset("js/blockCode.js") ?>"></script>
  <script src="<?= asset(BOOTJS) ?>"></script>
  <script src="<?= asset(BOOTPOPPER) ?>"></script>
</body>

</html>