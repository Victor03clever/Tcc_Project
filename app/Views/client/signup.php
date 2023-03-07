<?php

use App\Helpers\Sessao;
// Sessao::notify('teste');

?>
<!DOCTYPE html>
<html lang="en">

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
  <link rel="shortcut icon" href="<?=asset("img/favicon.png")?>" type="image/x-icon">

    <style>
        form .metter {
            position: relative;
            width: 31.6rem;
            height: .3rem;
            bottom: -1rem;
            left: 0;
            margin: 0;
            padding: 0;
            display: block;

            background-color: var(--dark700);
        }

        form .metter.fraca::before {
            content: '';
            width: 25%;
            height: 100%;
            left: 0;
            position: absolute;
            transition: 1s ease;
            background-color: #f00;
        }

        form .metter.media::before {
            content: '';
            width: 50%;
            height: 100%;
            left: 0;
            position: absolute;
            transition: 1s ease;
            background-color: #FFD700;
        }

        form .metter.forte::before {
            content: '';
            width: 75%;
            height: 100%;
            left: 0;
            position: absolute;
            transition: 1s ease;
            background-color: #7FFF00;
        }

        form .metter.excelente::before {
            content: '';
            width: 100%;
            height: 100%;
            left: 0;
            position: absolute;
            transition: 1s ease;
            background-color: #008000;
        }
    </style>
</head>

<body>
    <main class="wrapper">
        <?= Sessao::izitoast('signup'); ?>
        <img src="<?= asset("img/logo.png") ?>" alt="logotipo de um refeitorio">
        <form action="<?= URL ?>/client/signup" method="post">
            <h1>Crie sua conta</h1>
            <p>
                <label for="nome">Seu nome</label><br>
                <input class="form-control <?= $dados['erro_nome'] ? 'is-invalid' : '' ?>" type="text" name="nome" id="nome" value="<?= $dados['nome'] ?>" placeholder="Exemplo: Victor Clever" style="background: transparent; color: var(--text);">
                <span class="invalid-feedback" style="text-align: left;">
                    <?= $dados['erro_nome'] ?>
                </span>
            </p>
            <p>
                <label for="telefone">Telefone</label><br>
                <span class="input-group">
                    <span class="input-group-text">+244</span>
                    <input class="form-control <?= $dados['erro_telefone'] ? 'is-invalid' : '' ?>" type="number" name="telefone" id="telefone" placeholder="Exemplo: 999 999 999" value="<?= $dados['telefone'] ?>" style="background: transparent; color: var(--text);">
                    <span class="invalid-feedback" style="text-align: left;">
                        <?= $dados['erro_telefone'] ?>
                    </span>
                </span>
            </p>
            <p>
                <label for="senha">Senha</label><br>
                <input class="form-control <?= $dados['erro_senha'] ? 'is-invalid' : '' ?>" type="password" name="senha" id="senha" value="<?= $dados['senha'] ?>" placeholder="Digite a sua senha" onkeyup="validarSenhaForca()" style="background: transparent; color: var(--text);">
                <span class="metter"></span>
                <span class="invalid-feedback" style="text-align: left;">
                    <?= $dados['erro_senha'] ?>
                </span>
            </p>
            <p>
                <button type="submit" name="cad" value="submit">Criar Conta</button>
                <span>
                    <a href="<?= URL ?>/client/login">Já tenho conta</a>
                </span>
            </p>
        </form>
    </main>
    <script>
        function validarSenhaForca() {
            const senha = document.getElementById('senha').value;
            var forca = 0;
            // document.getElementById("impSenha").innerHTML = "Senha " + senha;

            if ((senha.length >= 4) && (senha.length <= 7)) {
                forca += 10;
            } else if (senha.length > 7) {
                forca += 25;
            }

            if ((senha.length >= 5) && (senha.match(/[a-z]+/))) {
                forca += 10;
            }

            if ((senha.length >= 6) && (senha.match(/[A-Z]+/))) {
                forca += 20;
            }

            if ((senha.length >= 7) && (senha.match(/[@#$%&;*]/))) {
                forca += 25;
            }

            if (senha.match(/([1-9]+)\1{1,}/)) {
                forca += -25;
            }

            mostrarForca(forca);
        }

        function mostrarForca(forca) {

            const metter = document.querySelector('.metter');
            const senha = document.getElementById('senha').value;



            if (forca > 0 && forca < 30) {
                metter.classList.add('fraca');
                metter.classList.remove('media');
                metter.classList.remove('forte');
                metter.classList.remove('excelente');
            } else if ((forca >= 30) && (forca < 50)) {
                metter.classList.add('media');
                metter.classList.remove('fraca');
                metter.classList.remove('forte');
                metter.classList.remove('excelente');
            } else if ((forca >= 50) && (forca < 70)) {
                metter.classList.remove('fraca');
                metter.classList.remove('media');
                metter.classList.add('forte');
                metter.classList.remove('excelente');
            } else if ((forca >= 70) && (forca < 100)) {
                metter.classList.remove('fraca');
                metter.classList.remove('media');
                metter.classList.remove('forte');
                metter.classList.add('excelente');
            } else {
                metter.classList.remove('fraca');
                metter.classList.remove('media');
                metter.classList.remove('forte');
                metter.classList.remove('excelente');
            }

        }
    </script>
    <script src="<?= asset(BOOTJS) ?>"></script>
    <script src="<?= asset(BOOTPOPPER) ?>"></script>
</body>

</html>