<h1>Editar</h1>
<?php
use App\Helpers\Sessao;
use App\Libraries\uploads;

Sessao::sms('upload');
Sessao::sms('produto');
?>
<form action="<?=URL?>/admin/produto/edit/<?=$edit['p_id']?>" method="post" enctype="multipart/form-data">
<p>
    escolha a sua imagem 
    <input type="file" name="upload" id="">
</p>
<p>
    escolha o nome do produto <br>
    <input type="text" name="name" id="" value="<?=$edit['p_nome']?>">
</p>
<p>
    valor a ser vendido <br>
    <input type="number" name="value" id="" value="<?=$edit['preco']?>">
</p>
<p>
    codigo de barra <br>
    <input type="text" name="code" id="" value="<?=$edit['cod']?>">
</p>
<p>
    categoria <br>
    <select class="form-select" aria-label="Default select example" name="cat">
        <option selected value="<?=$edit['c_id']?>"><?=$edit['c_nome']?></option>
        <?php foreach($dados['read_c'] as $value):?>
       <option value='<?=$value['id']?>'><?=$value['nome']?></option>
        <?php endforeach;?>
    </select>
</p>

<button type="submit" class="btn btn-primary" name="edit" value="submit" >Submit</button>

</form>