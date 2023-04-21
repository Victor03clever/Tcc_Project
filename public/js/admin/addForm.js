// caddaastrar compras
var count = 1;
function addForm() {
  count++;
  console.log(count);
  document.getElementById("form").insertAdjacentHTML(
    "beforeend",
    `
      <fieldset id='remove'>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do produto</label>
            <input type="text" class="form-control <?= $dados['err_nome'] ? 'is-invalid' : '' ?>" id="nome" aria-describedby="textHelp" name="nome[]">
            <div id="nomeError" class="invalid-feedback"><?= $dados['err_nome'] ?></div>
        </div>

        <div class="row mb-3">
            <div class=" col-6">
              <label for="email" class="form-label">Preço</label>
              <input type="number" class="form-control  <?= $dados['err_preco'] ? 'is-invalid' : '' ?>" id="preco" aria-describedby="emailHelp" name="preco[]">
              <div id="precoError" class="invalid-feedback"><?= $dados['err_preco'] ?></div>
            </div>
            <div class=" col-6">
              <label for="contacto" class="form-label">Quantidade</label>
              <input type="number" class="form-control <?= $dados['err_qtd'] ? 'is-invalid' : '' ?>" id="qtd" aria-describedby="numberhelp" name="qtd[]" >
              <div id="qtdError" class="invalid-feedback"><?= $dados['err_qtd'] ?></div>
            </div>
        </div>  
        <button type='button' class="fs-2 btn btn-primary p-0 mb-3" onclick="remove(${count})" title="remover este campo">-</button>
      </fieldset>

    `
  );
}
function remove(c) {
  console.log("remover" + c);
  document.getElementById("remove").remove();
}

// Validacao dos campos
const form= document.querySelector('#formCompras');
const nome= document.querySelectorAll('#nome');
const preco= document.querySelectorAll('#preco');
const qtd= document.querySelectorAll('#qtd');

// var errors
const error_nome= document.querySelectorAll('#nomeError');
const error_preco= document.querySelectorAll('#precoError');
const error_qtd= document.querySelectorAll('#qtdError');

form.addEventListener('submit',(event)=>{
event.preventDefault();
for (let index = 0; index < 10; index++) {
 

if(nome[index].value==='' || preco[index].value==='' || qtd[index].value===''){
  if(nome[index].value===''){
    nome[index].classList.add('is-invalid');
    error_nome[index].innerHTML='';
    error_nome[index].innerHTML+='Preencha este campo';
  }else{
    nome[index].classList.remove('is-invalid');
    nome[index].classList.add('is-valid');
    error_nome[index].innerHTML='';
  }
  if(preco[index].value===''){
    preco[index].classList.add('is-invalid');
    error_preco[index].innerHTML='';
    error_preco[index].innerHTML+='Preencha este campo';
  }else{
    preco[index].classList.remove('is-invalid');
    preco[index].classList.add('is-valid');
    error_preco[index].innerHTML='';
  }
  if(qtd[index].value===''){
    qtd[index].classList.add('is-invalid');
    error_qtd[index].innerHTML='';
    error_qtd[index].innerHTML+='Preencha este campo';
  }else{
    qtd[index].classList.remove('is-invalid');
    qtd[index].classList.add('is-valid');
    error_qtd[index].innerHTML='';
  }
}else{
  form.submit();
}}
})

