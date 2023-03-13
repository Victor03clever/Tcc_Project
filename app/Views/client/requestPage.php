<?php

use App\Helpers\Sessao;

?>
<?= Sessao::izitoast('request'); ?>
<link rel="stylesheet" href="<?= asset("css/client/style2.css") ?>">
<main class="wrapper">
    <div class="d-flex flex-wrap justify-content-around align-items-center">
        <div id="all">
            <h1>Meus pedido/Refeições</h1>
            <div class="pedidos">
                <?php $total = 0;
                foreach ($allRequest as $key => $value) : ?>
                    <div class="pedido">
                        <img src="<?= asset($value['re_img']) ?>" alt="">
                        <span class="pri">
                            <span class="seg">
                                <h4 class="qtd"><?= $value['qtd'] ?>x</h4>
                                <h4><?= $value['re_nome'] ?></h4>
                                <small>KZ <?= $value['pe_preco']*$value['qtd'] ?></small>
                                <?php $total += $value['pe_preco']*$value['qtd']?>
                            </span>
                            <form action="<?= URL ?>/request/deleteRequest/<?= $value['pe_id'] ?>" method="post">
                                <button type="submit" name="delete" value="submit" class="ter">Excluir</button>
                            </form>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
            <h3>Total: KZ <?= $total ?></h3>
        </div>

        <div id="all">
            <h1>Meus pedido/Produtos</h1>
            <div class="pedidos">
                <div class="pedido">
                    <img src="./assets/prato3.svg" alt="">
                    <span class="pri">
                        <span class="seg">
                            <h4 class="qtd">1x</h4>
                            <h4> Salada Rodish</h4>
                            <small>R$ 25,97</small>
                        </span>
                        <button class="ter">Excluir</button>
                    </span>
                </div>
                <div class="pedido">
                    <img src="./assets/prato3.svg" alt="">
                    <span class="pri">
                        <span class="seg">
                            <h4 class="qtd">1x</h4>
                            <h4> Salada Rodish</h4>
                            <small>R$ 25,97</small>
                        </span>
                        <button class="ter">Excluir</button>
                    </span>
                </div>
                <div class="pedido">
                    <img src="./assets/prato3.svg" alt="">
                    <span class="pri">
                        <span class="seg">
                            <h4 class="qtd">1x</h4>
                            <h4> Salada Rodish</h4>
                            <small>R$ 25,97</small>
                        </span>
                        <button class="ter">Excluir</button>
                    </span>
                </div>
                <div class="pedido">
                    <img src="./assets/prato3.svg" alt="">
                    <span class="pri">
                        <span class="seg">
                            <h4 class="qtd">1x</h4>
                            <h4> Salada Rodish</h4>
                            <small>R$ 25,97</small>
                        </span>
                        <button class="ter"> Excluir</button>
                    </span>
                </div>
            </div>
            <h3>Total: R$ 125,97</h3>
        </div>
    </div>
    <h2 class=" mt-5">Total: KZ 1000.00</h2>
    <button onclick="clearCart()">
        Avançar
    </button>

    <a href="historico.html" class="btn btn-dark p-3">Historico</a>

</main>