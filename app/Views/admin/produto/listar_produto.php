<h1>Lista dos produtos</h1>

<?php foreach($dados as $value):?>
<img src="<?=URL?>/<?=$value['imagem']?>" width="100" class="img-fluid rounded" alt=""><br>
<h6>nome do produto: <?=$value['p_nome']?></h6>

<h6>preco do produto: <?=$value['preco']?></h6>

<h6>categoria do produto: <?=$value['c_nome']?></h6>

<h6>codigo de barra do produto: <?=$value['cod']?></h6>

<a  class="btn btn-primary" href="<?=URL?>/admin/produto/edit/<?=$value['p_id']?>" role="button">Edite</a>
    <form action="<?=URL?>/admin/produto/delete/<?=$value['p_id']?>" method="post">
        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
    </form>
    <hr>


<?php endforeach?>