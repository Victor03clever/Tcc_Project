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

</head>

<body>
  <main class="wrapper">
    <?= Sessao::izitoast('loginE'); ?>
    <?= Sessao::izitoast('signup'); ?>
    <img src="<?= asset("img/logo.png") ?>" alt="logotipo de um refeitorio">
    <form action="<?= URL ?>/client/login" method="post">
      <h1>Faça login</h1>
      <p>
        <label for="nome">nome</label><br>
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
      </p>
      <p>
        <button type="submit" name="login" value="submit">Entrar</button>
        <span>
          <a href="<?= URL ?>/client/signup">Criar uma conta</a><br>
          <a href="<?= URL ?>/saler/login">Vendedor</a>
        </span>
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
  <script src="<?= asset(BOOTJS) ?>"></script>
  <script src="<?= asset(BOOTPOPPER) ?>"></script>
</body>

</html>