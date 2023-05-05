<?php

use App\Helpers\Sessao;
?>

<link rel="stylesheet" href="<?= asset("css/admin/style.css") ?>">

<?= Sessao::izitoast('loginS'); ?>

<!-- cards Boxes -->
<div class="cardBox">
  <!-- cash -->
  <div class="cards" title='mensalmente'>
    <div>
      <div class="cardName">Quantidade total recebido</div>
      <div class="number">AOA <?=$money + $moneyP?></div>
    </div>
    <div class="iconBox">
      <svg width="196" height="92" viewBox="0 0 196 92" fill="none" xmlns="http://www.w3.org/2000/svg">
        <mask id="mask0_4_1839" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="196" height="92">
          <rect width="196" height="92" rx="10" transform="matrix(1 0 0 -1 0 92)" fill="#24263A" />
        </mask>
        <g mask="url(#mask0_4_1839)">
          <path d="M78.7486 77.5818C74.324 82.8943 70.6369 87.4478 64 86.6889V92H196V42.6705C195.508 42.1645 193.64 41.4562 190.101 42.6705C185.676 44.1883 176.089 58.6079 167.24 63.1614C158.391 67.7149 148.804 57.0893 139.955 56.3304C131.106 55.5714 127.419 69.991 119.307 71.5088C111.196 73.0267 105.296 68.4747 97.1844 66.9569C89.0726 65.439 83.1732 72.2694 78.7486 77.5818Z" fill="url(#paint0_linear_4_1839)" />
        </g>
        <path d="M76 80.6522C76.7346 81.4454 78.9383 82.2386 81.8765 79.0658C85.5494 75.0997 87.7531 65.5811 96.5679 63.9946C105.383 62.4082 107.586 71.1336 118.605 73.5133C129.623 75.8929 133.296 73.5139 139.173 69.5478C145.049 65.5817 151.66 50.5106 161.944 50.5106C172.228 50.5106 175.901 53.6835 183.247 61.6157C189.123 67.9614 193.531 69.5478 195 69.5478" stroke="#894BA9" stroke-width="0.5" />
        <defs>
          <linearGradient id="paint0_linear_4_1839" x1="170.19" y1="45.0357" x2="168.628" y2="94.3629" gradientUnits="userSpaceOnUse">
            <stop stop-color="#7B4397" />
            <stop offset="1" stop-color="#7B4397" stop-opacity="0" />
          </linearGradient>
        </defs>
      </svg>
    </div>
  </div>
  <!-- vendas -->
  <div class="cards" title='mensalmente'>
    <div>
      <div class="cardName">Total de Vendas</div>
      <div class="number"><?=$sales?> ✓</div>
    </div>
    <div class="iconBox">
      <svg width="196" height="92" viewBox="0 0 196 92" fill="none" xmlns="http://www.w3.org/2000/svg">
        <mask id="mask0_4_1851" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="196" height="92">
          <rect width="196" height="92" rx="10" transform="matrix(1 0 0 -1 0 92)" fill="#24263A" />
        </mask>
        <g mask="url(#mask0_4_1851)">
          <path d="M78.7483 77.5818C74.3238 82.8943 70.6367 87.4478 64 86.6889V92H195.997V42.6705C195.506 42.1645 193.638 41.4562 190.098 42.6705C185.674 44.1883 176.087 58.6079 167.238 63.1614C158.389 67.7149 148.803 57.0893 139.954 56.3304C131.105 55.5714 127.418 69.991 119.306 71.5088C111.195 73.0267 105.295 68.4747 97.1837 66.9569C89.0721 65.439 83.1728 72.2694 78.7483 77.5818Z" fill="url(#paint0_linear_4_1851)" />
          <path d="M77.207 81.055C77.9403 81.8363 80.1403 82.6175 83.0736 79.4925C86.7402 75.5863 88.9401 66.2113 97.7399 64.6488C106.54 63.0863 108.74 71.68 119.74 74.0238C130.739 76.3675 134.406 74.0244 140.272 70.1182C146.139 66.2119 152.739 51.3682 163.005 51.3682C173.272 51.3682 176.938 54.4932 184.272 62.3057C190.138 68.5557 194.538 70.1182 196.005 70.1182" stroke="#894BA9" stroke-width="0.5" />
        </g>
        <defs>
          <linearGradient id="paint0_linear_4_1851" x1="170.188" y1="45.0357" x2="168.626" y2="94.3629" gradientUnits="userSpaceOnUse">
            <stop stop-color="#DB2379" />
            <stop offset="1" stop-color="#DB2379" stop-opacity="0" />
          </linearGradient>
        </defs>
      </svg>
    </div>
  </div>
  <!-- compras -->
  <div class="cards" title='mensalmente'>
    <div>
      <div class="cardName">Total de compras</div>
      <div class="number"><?=$compras?> ✓</div>
    </div>
    <div class="iconBox">
      <svg width="196" height="92" viewBox="0 0 196 92" fill="none" xmlns="http://www.w3.org/2000/svg">
        <mask id="mask0_4_1816" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="196" height="92">
          <rect width="196" height="92" rx="10" transform="matrix(1 0 0 -1 0 92)" fill="#24263A" />
        </mask>
        <g mask="url(#mask0_4_1816)">
          <path d="M78.7486 77.5818C74.324 82.8943 70.6369 87.4478 64 86.6889V92H196V42.6705C195.508 42.1645 193.64 41.4562 190.101 42.6705C185.676 44.1883 176.089 58.6079 167.24 63.1614C158.391 67.7149 148.804 57.0893 139.955 56.3304C131.106 55.5714 127.419 69.991 119.307 71.5088C111.196 73.0267 105.296 68.4747 97.1844 66.9569C89.0726 65.439 83.1732 72.2694 78.7486 77.5818Z" fill="url(#paint0_linear_4_1816)" />
          <path d="M77.1982 81.054C77.9315 81.8353 80.1315 82.6165 83.0648 79.4915C86.7315 75.5853 88.9315 66.2103 97.7315 64.6478C106.531 63.0853 108.731 71.679 119.732 74.0228C130.732 76.3665 134.398 74.0234 140.265 70.1172C146.132 66.2109 152.732 51.3672 162.998 51.3672C173.265 51.3672 176.932 54.4922 184.265 62.3047C190.132 68.5547 194.532 70.1172 195.998 70.1172" stroke="#894BA9" stroke-width="0.5" />
        </g>
        <defs>
          <linearGradient id="paint0_linear_4_1816" x1="170.19" y1="45.0357" x2="168.628" y2="94.3629" gradientUnits="userSpaceOnUse">
            <stop stop-color="#DC2430" />
            <stop offset="1" stop-color="#DC2430" stop-opacity="0" />
          </linearGradient>
        </defs>
      </svg>

    </div>
  </div>
  <!-- estoque, pedido -->
  <div class="cards" title="mensalmente">
    <div>
      <div class="cardName">Pedidos</div>
      <div class="number"><?=$pedidos?> ✓</div>
    </div>
    <div class="iconBox">
      <svg width="196" height="92" viewBox="0 0 196 92" fill="none" xmlns="http://www.w3.org/2000/svg">
        <mask id="mask0_4_1839" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="196" height="92">
          <rect width="196" height="92" rx="10" transform="matrix(1 0 0 -1 0 92)" fill="#24263A" />
        </mask>
        <g mask="url(#mask0_4_1839)">
          <path d="M78.7486 77.5818C74.324 82.8943 70.6369 87.4478 64 86.6889V92H196V42.6705C195.508 42.1645 193.64 41.4562 190.101 42.6705C185.676 44.1883 176.089 58.6079 167.24 63.1614C158.391 67.7149 148.804 57.0893 139.955 56.3304C131.106 55.5714 127.419 69.991 119.307 71.5088C111.196 73.0267 105.296 68.4747 97.1844 66.9569C89.0726 65.439 83.1732 72.2694 78.7486 77.5818Z" fill="url(#paint0_linear_4_1839)" />
        </g>
        <path d="M76 80.6522C76.7346 81.4454 78.9383 82.2386 81.8765 79.0658C85.5494 75.0997 87.7531 65.5811 96.5679 63.9946C105.383 62.4082 107.586 71.1336 118.605 73.5133C129.623 75.8929 133.296 73.5139 139.173 69.5478C145.049 65.5817 151.66 50.5106 161.944 50.5106C172.228 50.5106 175.901 53.6835 183.247 61.6157C189.123 67.9614 193.531 69.5478 195 69.5478" stroke="#894BA9" stroke-width="0.5" />
        <defs>
          <linearGradient id="paint0_linear_4_1839" x1="170.19" y1="45.0357" x2="168.628" y2="94.3629" gradientUnits="userSpaceOnUse">
            <stop stop-color="#7B4397" />
            <stop offset="1" stop-color="#7B4397" stop-opacity="0" />
          </linearGradient>
        </defs>
      </svg>

    </div>
  </div>

</div>
<!-- charts and recent activities -->
<div class="charts">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Gráfico Analítico</h5>

        <!-- Donut Chart -->
        <div id="donutChart" style="min-height: 300px; " class="echart"></div>

        <script>
          document.addEventListener("DOMContentLoaded", () => {
            echarts.init(document.querySelector("#donutChart")).setOption({
              tooltip: {
                trigger: 'item'
              },
              legend: {
                top: '5%',
                left: 'center'
              },
              series: [{
                name: 'Total',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                label: {
                  show: false,
                  position: 'center'
                },
                emphasis: {
                  label: {
                    show: true,
                    fontSize: '18',
                    fontWeight: 'bold'
                  }
                },
                labelLine: {
                  show: false
                },
                data: [{
                    value: <?=$funcionarios?>,
                    name: 'Funcionarios'
                  },
                  {
                    value: <?=$clients?>,
                    name: 'Clientes'
                  },
                  {
                    value: <?=$fornecedor?>,
                    name: 'Fornecedores'
                  },
                  {
                    value: <?=$category?>,
                    name: 'Categoria de Produtos'
                  }
                ]
              }]
            });
          });
        </script>
        <!-- End Donut Chart -->

      </div>
    </div>
  </div>
  <div class="col-md-4 recent">
    <span class="span">Pedidos recentes</span>
    <div class="pedidos">

      <?php if ($recent) : ?>
        <?php foreach ($recent as $key => $value) : ?>
          <span class="span1">
                <img src="<?=asset($value['imagem'])?>" alt="">
                <?=$value['nome']?>
          </span>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </div>
</div>

<!-- bar chart -->
<div class="w-90 m-1">
  <div class="card ">
    <div class="card-body">
      <h5 class="card-title">Vendas Semanais</h5>

      <!-- Bar Chart -->
      <div id="barChart" style="min-height: 300px;" class="echart"></div>

      <script>
        document.addEventListener("DOMContentLoaded", () => {
          echarts.init(document.querySelector("#barChart")).setOption({
            xAxis: {
              type: 'category',
              data: ['Seg', 'Ter', 'Quart', 'Quint', 'Sext', 'Sab', 'Dom']
            },
            yAxis: {
              type: 'value'
            },
            series: [{
              data: [<?=$sales2?>, <?=$sales3?>, <?=$sales4?>, <?=$sales5?>, <?=$sales6?>, <?=$sales7?>, <?=$sales1?>],
              type: 'bar'
            }]
          });
        });
      </script>
      <!-- End Bar Chart -->
    </div>
  </div>
</div>