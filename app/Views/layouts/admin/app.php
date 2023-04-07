<?php
$url=filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);
$url=explode("/",$url);
$uri=$url[1];

?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="<?= asset(BOOTCSS) ?>">
  <link rel="stylesheet" href="<?= asset(IZOCSS) ?>">
  <script src="<?= asset(JQUERY) ?>"></script>
  <script src="<?= asset(IZOJS) ?>"></script>
  <!-- <script src="<=asset(NOTIFY)?>"></script> -->
  <link rel="stylesheet" href="<?= asset("css/admin/main.css") ?>">
  <link rel="stylesheet" href="<?= asset("css/admin/datatables.css") ?>">
  <link rel="shortcut icon" href="<?=asset("img/favicon.png")?>" type="image/x-icon">
</head>

<body>



  <!-- sideBar -->
  <div class="container">
    <div class="navigation">
      <ul>
        <li>
          <a href="<?= URL ?>/admin/home">
            <img src="<?= asset("img/logo.png") ?>" alt="Logotipo para um refeitorio gratis" width="200">
          </a>
          <span class="line"></span>
        </li>
        <li class="<?= ucwords($uri)=="Home"?'actived':'' ?>">
          <a href="<?= URL ?>/admin/home">
            <span class="icon">
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.9319 9.7884C12.5648 10.6564 11.9908 11.4212 11.2599 12.0161C10.529 12.6109 9.66346 13.0177 8.73904 13.2008C7.81461 13.3839 6.85941 13.3377 5.95695 13.0664C5.05448 12.795 4.23222 12.3067 3.56207 11.6442C2.89191 10.9816 2.39426 10.165 2.11261 9.26568C1.83097 8.36637 1.77392 7.41176 1.94644 6.4853C2.11896 5.55885 2.5158 4.68876 3.10227 3.95111C3.68874 3.21346 4.44699 2.6307 5.31071 2.25378" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M13.3876 7.5442C13.3876 6.78657 13.2384 6.03636 12.9485 5.33641C12.6585 4.63645 12.2336 4.00046 11.6978 3.46473C11.1621 2.92901 10.5261 2.50405 9.82617 2.21412C9.12621 1.92419 8.376 1.77496 7.61838 1.77496V7.5442H13.3876Z" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </span>
            <span class="title">Dashbord</span>
          </a>
        </li>
        <li>
          <a href="<?= URL ?>/admin/compra">
            <span class="icon">
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.2338 7.07937V4.77168H4.15684C3.85082 4.77168 3.55733 4.65012 3.34094 4.43373C3.12456 4.21734 3.00299 3.92385 3.00299 3.61784C3.00299 2.98322 3.52222 2.46399 4.15684 2.46399H11.0799V4.77168" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M3.00299 3.6178V10.5409C3.00299 11.1755 3.52222 11.6947 4.15684 11.6947H12.2338V9.38703" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11.0799 7.07935C10.7739 7.07935 10.4804 7.20091 10.264 7.4173C10.0477 7.63369 9.92609 7.92717 9.92609 8.23319C9.92609 8.86781 10.4453 9.38704 11.0799 9.38704H13.3876V7.07935H11.0799Z" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </span>
            <span class="title">Compras</span>
          </a>
        </li>
        <li class="<?= ucwords($uri)=="Categoria"?'actived':'' ?>">
          <a href="<?= URL ?>/admin/categoria">
            <span class="icon">
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_4_1617)">
                  <path d="M12.8107 3.07727H2.42609C1.78884 3.07727 1.27225 3.59386 1.27225 4.23112V11.1542C1.27225 11.7914 1.78884 12.308 2.42609 12.308H12.8107C13.448 12.308 13.9646 11.7914 13.9646 11.1542V4.23112C13.9646 3.59386 13.448 3.07727 12.8107 3.07727Z" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M1.27225 6.53882H13.9646" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                </g>
                <defs>
                  <clipPath id="clip0_4_1617">
                    <rect x="0.695312" y="0.769531" width="13.8462" height="13.8462" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </span>
            <span class="title">Categoria</span>
          </a>
        </li>
        <li class="<?= ucwords($uri)=="Produto" || ucwords($uri)=="Prato" || ucwords($uri)=="Estoque"?'actived':'' ?>">
          <a href="<?= URL ?>/admin/produto">
            <span class="icon">
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_4_1617)">
                  <path d="M12.8107 3.07727H2.42609C1.78884 3.07727 1.27225 3.59386 1.27225 4.23112V11.1542C1.27225 11.7914 1.78884 12.308 2.42609 12.308H12.8107C13.448 12.308 13.9646 11.7914 13.9646 11.1542V4.23112C13.9646 3.59386 13.448 3.07727 12.8107 3.07727Z" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M1.27225 6.53882H13.9646" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                </g>
                <defs>
                  <clipPath id="clip0_4_1617">
                    <rect x="0.695312" y="0.769531" width="13.8462" height="13.8462" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </span>
            <span class="title">Produtos</span>
          </a>
        </li>
        <li>
          <a href="<?= URL ?>/admin/venda">
            <span class="icon">
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.0799 12.4565V6.68726" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7.61838 12.4565V3.22571" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4.15686 12.4564V8.99487" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
              </svg>

            </span>
            <span class="title">Vendas</span>
          </a>
        </li>
        <li>
          <a href="<?= URL ?>/admin/caixa">
            <span class="icon">
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_4_1630)">
                  <path d="M7.61838 1.10815V13.8005" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M10.503 3.41589H6.17609C5.64056 3.41589 5.12696 3.62863 4.74828 4.00731C4.3696 4.38599 4.15686 4.89959 4.15686 5.43512C4.15686 5.97066 4.3696 6.48426 4.74828 6.86294C5.12696 7.24162 5.64056 7.45436 6.17609 7.45436H9.06071C9.59624 7.45436 10.1098 7.66709 10.4885 8.04577C10.8672 8.42445 11.0799 8.93805 11.0799 9.47359C11.0799 10.0091 10.8672 10.5227 10.4885 10.9014C10.1098 11.2801 9.59624 11.4928 9.06071 11.4928H4.15686" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                </g>
                <defs>
                  <clipPath id="clip0_4_1630">
                    <rect x="0.695312" y="0.53125" width="13.8462" height="13.8462" fill="white" />
                  </clipPath>
                </defs>
              </svg>

            </span>
            <span class="title">Caixa</span>
          </a>
        </li>
        <li>
          <a href="<?= URL ?>/admin/usuarios">
            <span class="icon">
              <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_4_1604)">
                  <path d="M10.503 12.1232V10.9694C10.503 10.3573 10.2599 9.77037 9.82711 9.33759C9.39433 8.90481 8.80736 8.66168 8.19532 8.66168H3.57994C2.9679 8.66168 2.38093 8.90481 1.94815 9.33759C1.51538 9.77037 1.27225 10.3573 1.27225 10.9694V12.1232" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M5.88762 6.35397C7.16212 6.35397 8.19531 5.32078 8.19531 4.04628C8.19531 2.77178 7.16212 1.73859 5.88762 1.73859C4.61311 1.73859 3.57993 2.77178 3.57993 4.04628C3.57993 5.32078 4.61311 6.35397 5.88762 6.35397Z" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M13.9645 12.1232V10.9693C13.9642 10.458 13.794 9.96131 13.4807 9.5572C13.1674 9.15309 12.7288 8.86446 12.2338 8.73663" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M9.92609 1.8136C10.4225 1.9407 10.8625 2.22939 11.1766 2.63416C11.4908 3.03894 11.6614 3.53677 11.6614 4.04918C11.6614 4.56158 11.4908 5.05942 11.1766 5.46419C10.8625 5.86897 10.4225 6.15766 9.92609 6.28476" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                </g>
                <defs>
                  <clipPath id="clip0_4_1604">
                    <rect x="0.695312" y="0.0078125" width="13.8462" height="13.8462" fill="white" />
                  </clipPath>
                </defs>
              </svg>
            </span>
            <span class="title">Usuários</span>
          </a>

        </li>
        <li>
          <a href="<?= URL ?>/admin/relatorio">
            <span class="icon">
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.06068 1.4585H4.15684C3.85082 1.4585 3.55733 1.58006 3.34094 1.79645C3.12456 2.01284 3.00299 2.30632 3.00299 2.61234V11.8431C3.00299 12.1491 3.12456 12.4426 3.34094 12.659C3.55733 12.8754 3.85082 12.997 4.15684 12.997H11.0799C11.3859 12.997 11.6794 12.8754 11.8958 12.659C12.1122 12.4426 12.2338 12.1491 12.2338 11.8431V4.63157L9.06068 1.4585Z" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8.77225 1.4585V4.92004H12.2338" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9.92608 7.80469H5.3107" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9.92608 10.1124H5.3107" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M6.46454 5.49695H5.3107" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
              </svg>

            </span>
            <span class="title">Relatório</span>
          </a>
          <span class="line"></span>
        </li>
        <li class="<?= ucwords($uri)=="Config"?'actived':'' ?>">
          <a href="<?= URL ?>/admin/config">
            <span class="icon">
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.74533 1.93115H7.49148C7.18546 1.93115 6.89198 2.05272 6.67559 2.26911C6.4592 2.48549 6.33764 2.77898 6.33764 3.085V3.18884C6.33743 3.39119 6.28401 3.58992 6.18275 3.7651C6.08149 3.94028 5.93595 4.08575 5.76071 4.18692L5.51264 4.33115C5.33723 4.43242 5.13825 4.48574 4.93571 4.48574C4.73317 4.48574 4.5342 4.43242 4.35879 4.33115L4.27225 4.285C4.00748 4.13226 3.69293 4.09083 3.39764 4.16979C3.10235 4.24875 2.85045 4.44165 2.69725 4.70615L2.57033 4.92538C2.41759 5.19015 2.37616 5.50471 2.45512 5.8C2.53408 6.09529 2.72698 6.34718 2.99148 6.50038L3.07802 6.55807C3.25241 6.65875 3.39742 6.80332 3.49863 6.9774C3.59984 7.15148 3.65373 7.34902 3.65494 7.55038V7.84461C3.65575 8.04793 3.60282 8.24785 3.50151 8.42414C3.4002 8.60042 3.2541 8.7468 3.07802 8.84846L2.99148 8.90038C2.72698 9.05358 2.53408 9.30548 2.45512 9.60077C2.37616 9.89606 2.41759 10.2106 2.57033 10.4754L2.69725 10.6946C2.85045 10.9591 3.10235 11.152 3.39764 11.231C3.69293 11.3099 4.00748 11.2685 4.27225 11.1158L4.35879 11.0696C4.5342 10.9683 4.73317 10.915 4.93571 10.915C5.13825 10.915 5.33723 10.9683 5.51264 11.0696L5.76071 11.2138C5.93595 11.315 6.08149 11.4605 6.18275 11.6357C6.28401 11.8108 6.33743 12.0096 6.33764 12.2119V12.3158C6.33764 12.6218 6.4592 12.9153 6.67559 13.1317C6.89198 13.348 7.18546 13.4696 7.49148 13.4696H7.74533C8.05135 13.4696 8.34483 13.348 8.56122 13.1317C8.77761 12.9153 8.89917 12.6218 8.89917 12.3158V12.2119C8.89938 12.0096 8.9528 11.8108 9.05406 11.6357C9.15532 11.4605 9.30086 11.315 9.4761 11.2138L9.72417 11.0696C9.89958 10.9683 10.0986 10.915 10.3011 10.915C10.5036 10.915 10.7026 10.9683 10.878 11.0696L10.9646 11.1158C11.2293 11.2685 11.5439 11.3099 11.8392 11.231C12.1345 11.152 12.3864 10.9591 12.5396 10.6946L12.6665 10.4696C12.8192 10.2048 12.8606 9.89029 12.7817 9.595C12.7027 9.29971 12.5098 9.04781 12.2453 8.89461L12.1588 8.84846C11.9827 8.7468 11.8366 8.60042 11.7353 8.42414C11.634 8.24785 11.5811 8.04793 11.5819 7.84461V7.55615C11.5811 7.35283 11.634 7.15291 11.7353 6.97663C11.8366 6.80034 11.9827 6.65396 12.1588 6.5523L12.2453 6.50038C12.5098 6.34718 12.7027 6.09529 12.7817 5.8C12.8606 5.50471 12.8192 5.19015 12.6665 4.92538L12.5396 4.70615C12.3864 4.44165 12.1345 4.24875 11.8392 4.16979C11.5439 4.09083 11.2293 4.13226 10.9646 4.285L10.878 4.33115C10.7026 4.43242 10.5036 4.48574 10.3011 4.48574C10.0986 4.48574 9.89958 4.43242 9.72417 4.33115L9.4761 4.18692C9.30086 4.08575 9.15532 3.94028 9.05406 3.7651C8.9528 3.58992 8.89938 3.39119 8.89917 3.18884V3.085C8.89917 2.77898 8.77761 2.48549 8.56122 2.26911C8.34483 2.05272 8.05135 1.93115 7.74533 1.93115V1.93115Z" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M7.6184 9.43114C8.57428 9.43114 9.34917 8.65625 9.34917 7.70037C9.34917 6.7445 8.57428 5.9696 7.6184 5.9696C6.66253 5.9696 5.88763 6.7445 5.88763 7.70037C5.88763 8.65625 6.66253 9.43114 7.6184 9.43114Z" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </span>
            <span class="title">Configurações</span>
          </a>
        </li>
        <li>
          <a aria-current="page" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <span class="icon">
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.88762 12.7286H3.57993C3.27391 12.7286 2.98043 12.607 2.76404 12.3907C2.54765 12.1743 2.42609 11.8808 2.42609 11.5748V3.49784C2.42609 3.19182 2.54765 2.89834 2.76404 2.68195C2.98043 2.46556 3.27391 2.34399 3.57993 2.34399H5.88762" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9.92609 10.421L12.8107 7.53635L9.92609 4.65173" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12.8107 7.53638H5.88763" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </span>
            <span class="title">Log out</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <main class="main">
    <!-- topbar -->
    <div class="topbar">
      <div class="toggler">
        <span class="btn">
          <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1C0 0.447715 0.447715 0 1 0H23C23.5523 0 24 0.447715 24 1C24 1.55228 23.5523 2 23 2H1C0.447715 2 0 1.55228 0 1ZM0 9C0 8.44772 0.447715 8 1 8H23C23.5523 8 24 8.44772 24 9C24 9.55229 23.5523 10 23 10H1C0.447715 10 0 9.55229 0 9ZM0 17C0 16.4477 0.447715 16 1 16H23C23.5523 16 24 16.4477 24 17C24 17.5523 23.5523 18 23 18H1C0.447715 18 0 17.5523 0 17Z" fill="white" />
          </svg>
        </span>
        <span class="username">Hello, <?= $_SESSION['usuarios_nome'] ?></span>
      </div>
      <!-- user img -->
      <div class="user">
        <!-- button light and dark -->
        <div class="lightdark">
          <span class="light" onclick="SetTheme('light')">
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
          </span>
          <span class="dark" onclick="SetTheme('dark')">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.75 9.5925C15.632 10.8692 15.1529 12.0858 14.3687 13.1001C13.5845 14.1144 12.5276 14.8844 11.3218 15.3199C10.1159 15.7555 8.81098 15.8386 7.55961 15.5596C6.30825 15.2805 5.16223 14.6509 4.25566 13.7443C3.34908 12.8378 2.71944 11.6917 2.44042 10.4404C2.16139 9.18901 2.24452 7.88407 2.68008 6.67822C3.11564 5.47238 3.88561 4.41553 4.8999 3.63132C5.91418 2.84711 7.13083 2.36798 8.40749 2.25C7.66005 3.2612 7.30037 4.50709 7.39389 5.76106C7.4874 7.01504 8.02788 8.1938 8.91704 9.08295C9.80619 9.97211 10.985 10.5126 12.2389 10.6061C13.4929 10.6996 14.7388 10.3399 15.75 9.5925V9.5925Z" stroke="#364A63" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
        </div>
        <div class="notify">
          <a href="#">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M13.5 6C13.5 4.80653 13.0259 3.66193 12.182 2.81802C11.3381 1.97411 10.1935 1.5 9 1.5C7.80653 1.5 6.66193 1.97411 5.81802 2.81802C4.97411 3.66193 4.5 4.80653 4.5 6C4.5 11.25 2.25 12.75 2.25 12.75H15.75C15.75 12.75 13.5 11.25 13.5 6Z" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M10.2975 15.75C10.1657 15.9773 9.9764 16.166 9.74868 16.2971C9.52097 16.4283 9.2628 16.4973 9.00001 16.4973C8.73723 16.4973 8.47906 16.4283 8.25134 16.2971C8.02363 16.166 7.83437 15.9773 7.70251 15.75" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </a>
        </div>
        <span class="img">
          <img src="<?= $_SESSION['usuarios_img']?>" alt="imagem do usuario">
        </span>
        <!-- dropdown -->
        <div class="dropdown">
          <svg class=" dropdown-toggle" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.5 6.75L9 11.25L13.5 6.75" stroke="#DBDFEA" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" />
          </svg>

          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="<?= URL ?>/admin/config">perfil</a></li>
            <li><a class="dropdown-item" aria-current="page" data-bs-toggle="modal" data-bs-target="#staticBackdrop">log out</a></li>
          </ul>
        </div>
      </div>

    </div>
    <?php
    $file = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . str_replace('.php', '', $file) . '.php';
    require_once $file;

    ?>

  </main>

   <!-- Modal -->
   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog        ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Terminar Sessão?</h5>
          <button type="button" class="btn-close bg-white " data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- <div class="modal-body">
          ...
        </div> -->
        <div class="modal-footer">
        <a class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Cancelar</a>
          <a href="<?= URL ?>/admin/login/sair" class="btn btn-primary btn-lg" >Sair</a>
        </div>
      </div>
    </div>
  </div>

  <div id="preloader">
    <img src="<?= asset("img/logo.png") ?>" alt="preloader">
  </div>




  <a id="backToTopButton" class="" href="#">
    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="20" cy="20" r="20" fill="#065E7C" />
      <path d="M20 27V13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      <path d="M13 20L20 13L27 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>

  </a>





  <script src="<?= asset("js/admin/main1.js") ?>"></script>
  <script src="<?= asset(BOOTJS) ?>"></script>
  <script src="<?= asset(BOOTPOPPER) ?>"></script>
  <script src="<?= asset("js/admin/echarts.min.js") ?>"></script>
  <!-- for good tables, the order is that -->
  <script src="<?= asset("js/admin/tinymce.min.js") ?>"></script>
  <script src="<?= asset("js/admin/datatables.js") ?>"></script>
  <script src="<?= asset("js/admin/main.js") ?>"></script>
  <script>
    // toggle button
    let toggle = document.querySelector('.toggler .btn')
    let navigation = document.querySelector('.navigation')
    let main = document.querySelector('.main')
    toggle.onclick = function() {
      navigation.classList.toggle('active')
      main.classList.toggle('active')
    }
    // backToTopButton
    window.addEventListener("scroll", function() {
      backToTopButton.classList.toggle('show', scrollY > 500);
    })
  </script>
</body>

</html>