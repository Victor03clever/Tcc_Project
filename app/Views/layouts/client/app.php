<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta http-equiv="refresh" content="10;"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refeitorio | Cliente</title>
    <link rel="stylesheet" href="<?= asset(BOOTCSS) ?>">
    <link rel="stylesheet" href="<?= asset(IZOCSS) ?>">
    <script src="<?= asset(JQUERY) ?>"></script>
    <script src="<?= asset(IZOJS) ?>"></script>
    <link rel="stylesheet" href="<?= asset("css/client/main.css") ?>">
    <link rel="shortcut icon" href="<?= asset("img/favicon.png") ?>" type="image/x-icon">

</head>

<body>

    <nav id="nav" class="navbar navbar-expand-lg navbar-light ">

        <div style="padding: 0;" class="container-fluid wrapper">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="desapear()" id="burger">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <span class="">
                    <svg class="open" width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1C0 0.447715 0.447715 0 1 0H23C23.5523 0 24 0.447715 24 1C24 1.55228 23.5523 2 23 2H1C0.447715 2 0 1.55228 0 1ZM0 9C0 8.44772 0.447715 8 1 8H23C23.5523 8 24 8.44772 24 9C24 9.55229 23.5523 10 23 10H1C0.447715 10 0 9.55229 0 9ZM0 17C0 16.4477 0.447715 16 1 16H23C23.5523 16 24 16.4477 24 17C24 17.5523 23.5523 18 23 18H1C0.447715 18 0 17.5523 0 17Z" fill="white" />
                    </svg>
                    <svg class="close" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.263604 0.263604C0.615076 -0.0878679 1.18492 -0.0878679 1.5364 0.263604L9 7.72721L16.4636 0.263604C16.8151 -0.0878679 17.3849 -0.0878679 17.7364 0.263604C18.0879 0.615076 18.0879 1.18492 17.7364 1.5364L10.2728 9L17.7364 16.4636C18.0879 16.8151 18.0879 17.3849 17.7364 17.7364C17.3849 18.0879 16.8151 18.0879 16.4636 17.7364L9 10.2728L1.5364 17.7364C1.18492 18.0879 0.615076 18.0879 0.263604 17.7364C-0.0878679 17.3849 -0.0878679 16.8151 0.263604 16.4636L7.72721 9L0.263604 1.5364C-0.0878679 1.18492 -0.0878679 0.615076 0.263604 0.263604Z" fill="white" />
                    </svg>

                </span>
            </button>
            <a class="navbar-brand" href="<?= URL ?>/client"><img src="<?= asset("img/logo.png") ?>" alt="Lotipo para os refeitorio" width="140"> </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <form class="d-flex">
                        <label for="search">
                            <img src="<?= asset("img/client/search.svg") ?>" alt="icone de pesquisar">
                            <input type="text" name="search" id="search" placeholder="Busque por pratos ou produtos"></label>
                        <button class="btn " type="submit">search</button>
                    </form>
                    <?php if (isset($_SESSION['usuarioC_id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link p-0" href="pedido.html">
                                <button class="pedidos" style="position: relative;">
                                    <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.96094 13C8.96094 12.4477 9.40865 12 9.96094 12H22.9609C23.5132 12 23.9609 12.4477 23.9609 13C23.9609 13.5523 23.5132 14 22.9609 14H9.96094C9.40865 14 8.96094 13.5523 8.96094 13Z" fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.96094 17C8.96094 16.4477 9.40865 16 9.96094 16H22.9609C23.5132 16 23.9609 16.4477 23.9609 17C23.9609 17.5523 23.5132 18 22.9609 18H9.96094C9.40865 18 8.96094 17.5523 8.96094 17Z" fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.04672 5.58579C4.4218 5.21071 4.9305 5 5.46094 5H27.4609C27.9914 5 28.5001 5.21071 28.8751 5.58579C29.2502 5.96086 29.4609 6.46957 29.4609 7V26C29.4609 26.3466 29.2815 26.6684 28.9867 26.8506C28.6918 27.0329 28.3237 27.0494 28.0137 26.8944L24.4609 25.118L20.9081 26.8944C20.6266 27.0352 20.2952 27.0352 20.0137 26.8944L16.4609 25.118L12.9081 26.8944C12.6266 27.0352 12.2952 27.0352 12.0137 26.8944L8.46094 25.118L4.90815 26.8944C4.59816 27.0494 4.23002 27.0329 3.93521 26.8506C3.64039 26.6684 3.46094 26.3466 3.46094 26V7C3.46094 6.46957 3.67165 5.96086 4.04672 5.58579ZM27.4609 7L5.46094 7L5.46094 24.382L8.01372 23.1056C8.29525 22.9648 8.62662 22.9648 8.90815 23.1056L12.4609 24.882L16.0137 23.1056C16.2952 22.9648 16.6266 22.9648 16.9081 23.1056L20.4609 24.882L24.0137 23.1056C24.2952 22.9648 24.6266 22.9648 24.9081 23.1056L27.4609 24.382V7Z" fill="white" />
                                    </svg>
                                    <h6><span class="cart" style="position: absolute; left: 2.8rem; top: .5rem; font-size: small; color: var(--tomato);">0</span>Pedidos</h6>
                                </button></a>
                        </li>
                    <?php else : ?>

                        <li class="nav-item">
                            <a class="nav-link p-0" href="<?= URL ?>/client/login">
                                <button class="pedidos">
                                    <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.96094 13C8.96094 12.4477 9.40865 12 9.96094 12H22.9609C23.5132 12 23.9609 12.4477 23.9609 13C23.9609 13.5523 23.5132 14 22.9609 14H9.96094C9.40865 14 8.96094 13.5523 8.96094 13Z" fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.96094 17C8.96094 16.4477 9.40865 16 9.96094 16H22.9609C23.5132 16 23.9609 16.4477 23.9609 17C23.9609 17.5523 23.5132 18 22.9609 18H9.96094C9.40865 18 8.96094 17.5523 8.96094 17Z" fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.04672 5.58579C4.4218 5.21071 4.9305 5 5.46094 5H27.4609C27.9914 5 28.5001 5.21071 28.8751 5.58579C29.2502 5.96086 29.4609 6.46957 29.4609 7V26C29.4609 26.3466 29.2815 26.6684 28.9867 26.8506C28.6918 27.0329 28.3237 27.0494 28.0137 26.8944L24.4609 25.118L20.9081 26.8944C20.6266 27.0352 20.2952 27.0352 20.0137 26.8944L16.4609 25.118L12.9081 26.8944C12.6266 27.0352 12.2952 27.0352 12.0137 26.8944L8.46094 25.118L4.90815 26.8944C4.59816 27.0494 4.23002 27.0329 3.93521 26.8506C3.64039 26.6684 3.46094 26.3466 3.46094 26V7C3.46094 6.46957 3.67165 5.96086 4.04672 5.58579ZM27.4609 7L5.46094 7L5.46094 24.382L8.01372 23.1056C8.29525 22.9648 8.62662 22.9648 8.90815 23.1056L12.4609 24.882L16.0137 23.1056C16.2952 22.9648 16.6266 22.9648 16.9081 23.1056L20.4609 24.882L24.0137 23.1056C24.2952 22.9648 24.6266 22.9648 24.9081 23.1056L27.4609 24.382V7Z" fill="white" />
                                    </svg>
                                    <h6>Pedidos</h6>
                                </button></a>
                        </li>

                    <?php endif; ?>
                    <li class="nav-item">

                        <button class="cfg light" onclick="SetTheme('light')">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 12C10.6569 12 12 10.6569 12 9C12 7.34315 10.6569 6 9 6C7.34315 6 6 7.34315 6 9C6 10.6569 7.34315 12 9 12Z" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 1.5V3" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 15V16.5" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.75 3.75L4.875 4.875" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13.125 13.125L14.25 14.25" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M1.5 9H3" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15 9H16.5" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.75 14.25L4.875 13.125" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13.125 4.875L14.25 3.75" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <h6>light</h6>
                        </button>
                        <button class="cfg dark" onclick="SetTheme('dark')" style="display: none;">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.75 9.5925C15.632 10.8692 15.1529 12.0858 14.3687 13.1001C13.5845 14.1144 12.5276 14.8844 11.3218 15.3199C10.1159 15.7555 8.81098 15.8386 7.55961 15.5596C6.30825 15.2805 5.16223 14.6509 4.25566 13.7443C3.34908 12.8378 2.71944 11.6917 2.44042 10.4404C2.16139 9.18901 2.24452 7.88407 2.68008 6.67822C3.11564 5.47238 3.88561 4.41553 4.8999 3.63132C5.91418 2.84711 7.13083 2.36798 8.40749 2.25C7.66005 3.2612 7.30037 4.50709 7.39389 5.76106C7.4874 7.01504 8.02788 8.1938 8.91704 9.08295C9.80619 9.97211 10.985 10.5126 12.2389 10.6061C13.4929 10.6996 14.7388 10.3399 15.75 9.5925V9.5925Z" stroke="#364A63" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <h6>dark</h6>
                        </button>

                    </li>

                    <?php if (isset($_SESSION['usuarioC_id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link last" aria-current="page" href="<?= URL ?>/client/config">
                                <button class="cfg">
                                    <img src="<?= asset("img/settings.png") ?>" alt="icone de settings">

                                    <h6>Cfg</h6>
                                </button>
                            </a>
                        </li>

                        <li class="nav-item" onclick="clearCart()">
                            <a class="nav-link last" aria-current="page" href="<?= URL ?>/client/sair">
                                <button class="logout">
                                    <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22.2891 11.75L27.5391 17M27.5391 17L22.2891 22.25M27.5391 17H13.5391M13.5391 28H6.53906C6.27385 28 6.01949 27.8946 5.83196 27.7071C5.64442 27.5196 5.53906 27.2652 5.53906 27V7C5.53906 6.73478 5.64442 6.48043 5.83196 6.29289C6.01949 6.10536 6.27385 6 6.53906 6H13.5391" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <h6>Sair</h6>
                                </button></a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link last" aria-current="page" href="<?= URL ?>/client/login">
                                <button class="logout">
                                    <h6>→</h6>
                                    Entrar
                                </button>
                            </a>
                        </li>

                    <?php endif; ?>
                </ul>

            </div>
        </div>

    </nav>

    <?php
    $file = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'client' . DIRECTORY_SEPARATOR . str_replace('.php', '', $file) . '.php';
    require_once $file;

    ?>

    <footer>
        <div class="wrapper">
            <img src="<?= asset("img/logo.png") ?>" alt="Logotipo para refeitorio" width="100">
            <span>
                &copy; 2023 - Anherc#victor_clever
            </span>
        </div>
    </footer>
    <a id="backToTopButton" class="" href="#">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="20" fill="#065E7C" />
            <path d="M20 27V13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M13 20L20 13L27 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

    </a>

    <script>
        // operacao com o burger
        var operation = document.querySelector('.operation');

        function desapear() {
            burger.classList.toggle('clicked')
        }
        // botao paara cima
        window.addEventListener("scroll", function() {
            backToTopButton.classList.toggle('show', scrollY > 500);
        })
        // operacoes adicionar e subtrair
        window.addEventListener("load", () => {
            let plus = document.querySelectorAll(".btn-plus");
            let subt = document.querySelectorAll(".btn-subtract");


            let a = 1;
            plus.forEach((plu) => {

                plu.addEventListener("click", () => {
                    a = plu.previousElementSibling.value
                    if (a < 10) {
                        a++;
                        a = (a < 10) ? "0" + a : a;

                        let input = plu.previousElementSibling
                        input.value = a
                        a = input.value
                    }
                });
            });
            subt.forEach((sub) => {
                sub.addEventListener("click", () => {
                    a = sub.nextElementSibling.value
                    //   console.log(a);

                    if (a > 1) {
                        a--;
                        a = (a < 10) ? "0" + a : a;
                        let input = sub.nextElementSibling
                        input.value = a
                    }
                });
            });

        });
    </script>

    <script src="<?= asset("js/client/main.js") ?>"></script>
    <script src="<?= asset(BOOTJS) ?>"></script>
    <script src="<?= asset(BOOTPOPPER) ?>"></script>

    <!-- <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"async defer></script> -->

</body>

</html>