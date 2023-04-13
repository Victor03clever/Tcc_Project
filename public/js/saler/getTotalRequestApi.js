let uri=document.querySelector("#total").getAttribute("url");
let span=document.querySelector("#total");

setInterval(() => {
  fetch(`${uri}/api/countRequestSaler`)
  .then((response) => response.json())
  .then((data) => {
  let total = data.totalpedidos;
  // console.log(total);    
    span.innerHTML='';
    span.innerHTML+=`${total}`;
  }).catch((err) => console.log(err));
}, 1111);