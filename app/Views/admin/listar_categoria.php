<?php
use App\Helpers\Sessao;
Sessao::sms('lista');
?>

<h1>LISTA</h1>
<?php foreach($dados as $value):?>
    <h6><?=$value['nome']?></h6>
    <h6><?=$value['descricao']?></h6>
    <h6><?=$value['status']?></h6>
    <h6><?=$value['id']?></h6>
    
    <a  class="btn btn-primary" href="<?=URL?>/admin/categoria/edit/<?=$value['id']?>" role="button">Edite</a>
    <form action="<?=URL?>/admin/categoria/delete/<?=$value['id']?>" method="post">
        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
    </form>
    <hr>
<?php endforeach?>
