<?php 
use App\Helpers\Sessao;
?>
<h1>bora cadastrar</h1>
<?= Sessao::sms('upload')?>
<?= Sessao::sms('produto')?>

<form action="<?=URL?>/admin/produto/create" method="post" enctype="multipart/form-data">
<p>
    escolha a sua imagem 
    <input type="file" name="upload" id="">
</p>
<p>
    escolha o nome do produto <br>
    <input type="text" name="name" id="">
</p>
<p>
    valor a ser vendido <br>
    <input type="number" name="value" id="">
</p>
<p>
    codigo de barra <br>
    <input type="text" name="code" id="">
</p>
<p>
    categoria <br>
    <select class="form-select" aria-label="Default select example" name="cat">
        <option selected>Open this select menu</option>
        <?php foreach($dados['read_c'] as $value):?>
       <option value='<?=$value['id']?>'><?=$value['nome']?></option>
        <?php endforeach;?>
    </select>
</p>

<button type="submit" class="btn btn-primary" name="store" value="submit" >Submit</button>

</form>