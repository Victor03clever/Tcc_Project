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
    <link rel="stylesheet" href="<?=asset("css/admin/style1.css")?>">
  <link rel="shortcut icon" href="<?=asset("img/favicon.png")?>" type="image/x-icon">

    <!-- <script src="<=asset(NOTIFY)?>"></script> -->
</head>

<body>
    <?=Sessao::izitoast('loginE');?>
    <main class="wrapper">
        <img src="<?=asset("img/logo.png")?>" alt="logotipo de um refeitorio">
        <form action="<?= URL ?>/admin/login" method="post">
            <h1>Faça login</h1>
            <p>
                
                <label for="nome">Nome</label><br>
                <input style="background: transparent; color: var(--text);" type="text" class="form-control <?= $dados['erro_nome'] ? 'is-invalid' : '' ?>" value="<?= $dados['nome'] ?>" id="nome" name="nome" placeholder="Exemplo: Victor clever">
                <span class="invalid-feedback">
                    <?= $dados['erro_nome'] ?>
                </span>
                
            </p>
            <p>
                <label for="senha">Senha</label><br>
                <input style="background: transparent; color: var(--text);" type="password" class="form-control <?= $dados['erro_senha'] ? 'is-invalid' : '' ?>" name="senha" id="senha" value="<?= $dados['senha']?>" name="senha"  placeholder="Digite a sua senha">
                <span class="invalid-feedback">
                    <?= $dados['erro_senha'] ?>
                </span>
            </p>
            <p>
                <button type="submit" name="btn_log" value="logar"><span id='efeito_botao'></span>Entrar</button>
            </p>

        </form>
    </main>
    <script src="<?=asset(BOOTJS)?>"></script>
<script src="<?=asset(BOOTPOPPER)?>"></script>
</body>

</html>