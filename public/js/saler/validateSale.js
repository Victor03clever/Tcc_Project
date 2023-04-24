const formVenda = document.querySelector("#venda");
const totalVenda = document.querySelector("#totalCost");
const mode = document.querySelector("#modepayment");
const payment = document.querySelector("#pay");
const change = document.querySelector("#troco");
const change1 = document.querySelector("#change");


formVenda.addEventListener("submit", (event) => {
  event.preventDefault();
  if (mode.value === "" || payment.value === "") {
    if (mode.value === "") {
      alert("Porfavor informe o modo de pagamento");
      mode.classList.remove("is-valid");
      mode.classList.add("is-invalid");
    } 
    if (payment.value === "") {
      alert("Insira o valor a se pagar");
      payment.classList.remove("is-valid");
      payment.classList.add("is-invalid");
    }
  } 
  else{
    let total = parseFloat(totalVenda.textContent);
    if(total>0){
      if (payment.value >= total) {
        change.innerHTML = "";
        change.innerHTML += `Troco: ${payment.value - total}.00 kz`;
        change1.setAttribute("value",`${payment.value - total}`);
        formVenda.submit();
        clear();
      } else {
        alert("Valor insuficiente");
        payment.classList.remove("is-valid");
        payment.classList.add("is-invalid");
      }

    }else{
      alert("Impossivel reallizar a venda");

    }
  }
});
payment.addEventListener("keyup", () => {
  let total = parseFloat(totalVenda.textContent);
  if (total>0){

    if (payment.value >= total) {
      change.innerHTML = "";
      change.innerHTML += `Troco: ${payment.value - total}.00 kz`;
      payment.classList.add("is-valid");
      payment.classList.remove("is-invalid");
    } else {
      payment.classList.remove("is-valid");
      payment.classList.add("is-invalid");
      change.innerHTML = "";
      change.innerHTML += `Troco: 0.00 kz`;
    }
  }
});
function clear() {
  let clear = localStorage.clear();
  // let clear = localStorage.removeItem("inCart");
  clear;
}
