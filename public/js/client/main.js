var root = document.querySelector(":root");
const body = document.querySelector("body");
var gcs = getComputedStyle(root);
let dark = document.querySelector(".dark");
let light = document.querySelector(".light");
const url = document.querySelector(".cards").getAttribute("data-url");
const idClient = document.querySelector("span#notificar").getAttribute("user");

// notify me
setInterval(() => {
  fetch(`${url}/api/notify/${idClient}`)
    .then((response) => response.json())
    .then((data) => {
      let not = data.notify;
      // console.log(not);
      if (not == "ON") {
        alert("O seu pedido já está feito, se dirija ao refeitório por favor");
        async function init() {
          const permission = await Notification.requestPermission();
          if (permission !== "granted") {
            throw new Error("Notificação negada pelo navegador!");
          }
        }

        function browserNotify({ title, body, icon }) {
          new Notification(title, {
            body,
            icon,
          });
        }
        async function start() {
          try {
            await init()
            browserNotify({
              title: "Refeitório Anherc",
              body: "Seu pedido está pronto...",
              icon: "http://localhost:8080/refeitorio/public/img/favicon.png"
            })
          } catch (error) {
            console.log(error.message)
          }
        }
        start()
      }
    })
    .catch((err) => console.log(err));
}, 30000);

// setInterval(() => {

// pratos ou refeicoes
fetch(`${url}/api/getDishes`)
  .then((response) => response.json())
  .then((data) => {
    let products = data;

    let currentProducts = products;

    function createElement(element) {
      return document.createElement(element);
    }

    function appendChild(element, children) {
      element.appendChild(children);
    }

    function handleProducts() {
      const cards = document.querySelector(".cards-dishes");
      cards.innerHTML = "";
      for (let i = 0; i < currentProducts.length; i++) {
        const card = createElement("div");
        const title = createElement("h6");
        const price = createElement("h6");
        const image = createElement("img");
        const add = createElement("div");
        const btnLess = createElement("svg");
        const btnMore = createElement("svg");
        const input = createElement("input");
        const btnInclude = createElement("button");
        const a = createElement("a");
        const inputGo = createElement("input");
        const form = createElement("form");

        form.action = `${url}/client/makeRequest`;
        form.setAttribute("method", "post");

        inputGo.type = "text";
        inputGo.value = products[i].id;
        inputGo.setAttribute("hidden", "");
        inputGo.setAttribute("name", "idgiven");

        input.style =
          "width: 2rem; background: transparent; color: var(--text); border: none; outline: none";
        add.style = " width: initial; margin-bottom: 1rem;";
        input.setAttribute("name", "qtd");
        input.value = "01";
        input.setAttribute("readonly", "");

        image.src = url + "/public/" + currentProducts[i].image;
        // image.style.width = "100px";
        // image.style.height = "200px";
        image.setAttribute("width", "100");
        image.setAttribute("height", "100");

        title.innerHTML = currentProducts[i].title;
        price.innerHTML = `Kz ${currentProducts[i].price}`;
        btnLess.innerHTML = "-";
        btnMore.innerHTML = "+";
        btnLess.style = "font-size:4rem";
        btnMore.style = "font-size:4rem";
        btnInclude.innerHTML = "Adicionar";
        btnInclude.setAttribute("type", "submit");
        btnInclude.setAttribute("name", "statusR1");
        btnInclude.setAttribute("value", "submit");
        a.setAttribute(
          "href",
          `${cards.getAttribute("data-url")}/client/login`
        );

        card.classList.add("card");
        title.classList.add("title");
        price.classList.add("price");
        btnLess.classList.add("btn-subtract");
        btnMore.classList.add("btn-plus");
        add.classList.add("add");
        btnInclude.classList.add("include");

        appendChild(card, image);
        appendChild(card, title);
        appendChild(card, price);
        appendChild(form, add);
        appendChild(add, btnLess);
        appendChild(add, input);
        appendChild(add, btnMore);
        appendChild(card, form);
        if (cards.getAttribute("data-authenticated") === "false") {
          appendChild(card, a);
          appendChild(a, btnInclude);
        } else {
          appendChild(form, inputGo);
          appendChild(form, btnInclude);
        }

        appendChild(cards, card);
      }
    }
    function addLess() {
      let plus = document.querySelectorAll(".btn-plus");
      let subt = document.querySelectorAll(".btn-subtract");

      let a = 1;
      plus.forEach((plu) => {
        plu.addEventListener("click", () => {
          a = plu.previousElementSibling.value;
          if (a < 10) {
            a++;
            a = a < 10 ? "0" + a : a;

            let input = plu.previousElementSibling;
            input.value = a;
            a = input.value;
          }
        });
      });
      subt.forEach((sub) => {
        sub.addEventListener("click", () => {
          a = sub.nextElementSibling.value;
          //   console.log(a);

          if (a > 1) {
            a--;
            a = a < 10 ? "0" + a : a;
            let input = sub.nextElementSibling;
            input.value = a;
          }
        });
      });
    }

    handleProducts();
    addLess();
  })
  .catch((err) => console.log(err));
// operacoes adicionar e subtrair

// });

// // Produtos
// fetch(`${url}/api`)
//   .then((response) => response.json())
//   .then((data) => {
//     let products = data;
//     const buttonCats = document.querySelectorAll("button.cat");
//     let currentProducts = products;

//     function productsFilters(category_id) {
//       if (Number(category_id) !== 0) {
//         currentProducts = products.filter(
//           (product) => product.category_id === Number(category_id)
//         );
//         let cards = document.querySelector(".cards-products");
//         cards.innerHTML = "";
//         handleFilter();
//         addLess();
//       } else {
//         currentProducts = products;

//         handleFilter();
//         addLess();
//       }
//     }
//     function addLess() {
//       let plus = document.querySelectorAll(".plus");
//       let subt = document.querySelectorAll(".subtract");
//       let a = 1;
//       plus.forEach((plu) => {
//         plu.addEventListener("click", () => {
//           a = plu.previousElementSibling.value;
//           if (a < 10) {
//             a++;
//             a = a < 10 ? "0" + a : a;

//             let input = plu.previousElementSibling;
//             input.value = a;
//             a = input.value;
//           }
//         });
//       });
//       subt.forEach((sub) => {
//         sub.addEventListener("click", () => {
//           a = sub.nextElementSibling.value;
//           //   console.log(a);

//           if (a > 1) {
//             a--;
//             a = a < 10 ? "0" + a : a;
//             let input = sub.nextElementSibling;
//             input.value = a;
//           }
//         });
//       });
//     }

//     for (let index = 0; index < buttonCats.length; index++) {
//       buttonCats[index].addEventListener("click", () => {
//         toggle(buttonCats[index]);
//         productsFilters(buttonCats[index].getAttribute("data-category"));
//       });
//     }

//     function handleProducts() {
//       const cards = document.querySelector(".cards-products");
//       cards.innerHTML = "";
//       for (let i = 0; i < currentProducts.length; i++) {
//         const card = createElement("div");
//         const title = createElement("h6");
//         const price = createElement("h6");
//         const image = createElement("img");
//         const add = createElement("div");
//         const btnLess = createElement("svg");
//         const btnMore = createElement("svg");
//         const input = createElement("input");
//         const btnInclude = createElement("button");
//         const a = createElement("a");
//         const inputGo = createElement("input");
//         const form = createElement("form");

//         form.action = `${url}/client/makeRequest`;
//         form.setAttribute("method", "post");

//         inputGo.type = "text";
//         inputGo.value = currentProducts[i].id;
//         inputGo.setAttribute("hidden", "");
//         inputGo.setAttribute("name", "idGo");

//         input.style =
//           "width: 2rem; background: transparent; color: var(--text); border: none; outline: none";
//         add.style = " width: initial; margin-bottom: 1rem;";
//         input.setAttribute("name", "qtdP");
//         input.value = "01";
//         input.setAttribute("readonly", "");

//         image.src =
//           cards.getAttribute("data-url") +
//           "/public/" +
//           currentProducts[i].image;
//         // image.style.width = "100px";
//         // image.style.height = "200px";
//         image.setAttribute("width", "100");
//         image.setAttribute("height", "100");

//         title.innerHTML = currentProducts[i].title;
//         price.innerHTML = currentProducts[i].price;
//         btnLess.innerHTML = "-";
//         btnMore.innerHTML = "+";
//         btnLess.style = "font-size:4rem";
//         btnMore.style = "font-size:4rem";
//         btnInclude.innerHTML = "Adicionar";
//         btnInclude.setAttribute("type", "submit");
//         btnInclude.setAttribute("name", "statusP1");
//         btnInclude.setAttribute("value", "submit");
//         a.setAttribute(
//           "href",
//           `${cards.getAttribute("data-url")}/client/login`
//         );

//         card.classList.add("card");
//         title.classList.add("title");
//         price.classList.add("price");
//         btnLess.classList.add("btn-subtract");
//         btnMore.classList.add("btn-plus");
//         btnLess.classList.add("subtract");
//         btnMore.classList.add("plus");
//         add.classList.add("add");
//         btnInclude.classList.add("include");

//         appendChild(card, image);
//         appendChild(card, title);
//         appendChild(card, price);
//         appendChild(form, add);
//         appendChild(add, btnLess);
//         appendChild(add, input);
//         appendChild(add, btnMore);
//         appendChild(card, form);
//         if (cards.getAttribute("data-authenticated") === "false") {
//           appendChild(card, a);
//           appendChild(a, btnInclude);
//         } else {
//           appendChild(form, inputGo);
//           appendChild(form, btnInclude);
//         }

//         appendChild(cards, card);
//       }
//     }
//     function handleFilter() {
//       const cards = document.querySelector(".cards-products");
//       cards.innerHTML = "";
//       for (let i = 0; i < currentProducts.length; i++) {
//         const card = createElement("div");
//         const title = createElement("h6");
//         const price = createElement("h6");
//         const image = createElement("img");
//         const add = createElement("div");
//         const btnLess = createElement("svg");
//         const btnMore = createElement("svg");
//         const input = createElement("input");
//         const btnInclude = createElement("button");
//         const a = createElement("a");
//         const inputGo = createElement("input");
//         const form = createElement("form");

//         form.action = `${url}/client/makeRequest`;
//         form.setAttribute("method", "post");

//         inputGo.type = "text";
//         inputGo.value = currentProducts[i].id;
//         inputGo.setAttribute("hidden", "");
//         inputGo.setAttribute("name", "idGo");

//         input.style =
//           "width: 2rem; background: transparent; color: var(--text); border: none; outline: none";
//         add.style = " width: initial; margin-bottom: 1rem;";
//         input.setAttribute("name", "qtdP");
//         input.value = "01";
//         input.setAttribute("readonly", "");

//         image.src =
//           cards.getAttribute("data-url") +
//           "/public/" +
//           currentProducts[i].image;
//         // image.style.width = "100px";
//         // image.style.height = "200px";
//         image.setAttribute("width", "100");
//         image.setAttribute("height", "100");

//         title.innerHTML = currentProducts[i].title;
//         price.innerHTML = currentProducts[i].price;
//         btnLess.innerHTML = "-";
//         btnMore.innerHTML = "+";
//         btnLess.style = "font-size:4rem";
//         btnMore.style = "font-size:4rem";
//         btnInclude.innerHTML = "Adicionar";
//         btnInclude.setAttribute("type", "submit");
//         btnInclude.setAttribute("name", "statusP1");
//         btnInclude.setAttribute("value", "submit");
//         a.setAttribute(
//           "href",
//           `${cards.getAttribute("data-url")}/client/login`
//         );

//         card.classList.add("card");
//         title.classList.add("title");
//         price.classList.add("price");
//         btnLess.classList.add("subtract");
//         btnMore.classList.add("plus");
//         add.classList.add("add");
//         btnInclude.classList.add("include");

//         appendChild(card, image);
//         appendChild(card, title);
//         appendChild(card, price);
//         appendChild(form, add);
//         appendChild(add, btnLess);
//         appendChild(add, input);
//         appendChild(add, btnMore);
//         appendChild(card, form);
//         if (cards.getAttribute("data-authenticated") === "false") {
//           appendChild(card, a);
//           appendChild(a, btnInclude);
//         } else {
//           appendChild(form, inputGo);
//           appendChild(form, btnInclude);
//         }

//         appendChild(cards, card);
//       }
//     }

//     function toggle(button) {
//       let isCurrentCategory = button.getAttribute("data-category");
//       if (
//         Number(isCurrentCategory) ===
//         Number(button.getAttribute("data-category"))
//       ) {
//         button.classList.add("active");
//       }

//       for (let index = 0; index < buttonCats.length; index++) {
//         if (
//           buttonCats[index].getAttribute("data-category") !==
//           button.getAttribute("data-category")
//         ) {
//           buttonCats[index].classList.remove("active");
//         }
//       }
//     }

//     function createElement(element) {
//       return document.createElement(element);
//     }

//     function appendChild(element, children) {
//       element.appendChild(children);
//     }

//     handleProducts();
//     includeButton();
//   })
//   .catch((err) => console.log(err));

// funcao para modo light e dark do sistema
function SetTheme(theme) {
  if (theme == "light") {
    light.style.display = "none";
    dark.style.display = "flex";
    useColorModeLight(theme);
  }
  if (theme == "dark") {
    dark.style.display = "none";
    light.style.display = "flex";
    useColorModeDark(theme);
  }
}

function useColorModeLight(theme) {
  localStorage.setItem("PanelTheme", theme);
  light.style.display = "none";
  dark.style.display = "flex";

  if (localStorage.getItem("PanelTheme") == "light") {
    body.classList.remove("dark");
    body.classList.add("light");

    root.style.setProperty("--primary-color", "#C4C4CC");
    root.style.setProperty("--text", "#000204");
    root.style.setProperty("--dark300", "#FFFFFF");
    root.style.setProperty("--darkshadow", "#4D585E");
    root.style.setProperty("--border", "#E1E1E6");
    root.style.setProperty("--blue3", "#7C7C8A");
    root.style.setProperty("--grey", "#FFFFFF");
    root.style.setProperty("--scroll", "#7C7C8A");
  }
}

function useColorModeDark(theme) {
  localStorage.setItem("PanelTheme", theme);
  dark.style.display = "none";
  light.style.display = "flex";
  if (localStorage.getItem("PanelTheme") == "dark") {
    body.classList.remove("light");
    body.classList.add("dark");

    root.style.setProperty("--primary-color", "#000d0f");
    root.style.setProperty("--text", "#e0e0e5");
    root.style.setProperty("--dark300", "#00070a");
    root.style.setProperty("--darkshadow", "#0d1e26");
    root.style.setProperty("--border", "#000305");
    root.style.setProperty("--blue3", "#00111a");
    root.style.setProperty("--grey", "#7b7b8a");
    root.style.setProperty("--scroll", "#770311");
  }
}

function setDefault() {
  const theme = localStorage.getItem("PanelTheme");
  let inCart = localStorage.getItem("inCart") ?? 0;

  if (theme == "light") {
    light.style.display = "none";
    dark.style.display = "flex";
    useColorModeLight(theme);
  }
  if (theme == "dark") {
    dark.style.display = "none";
    light.style.display = "flex";
    useColorModeDark(theme);
  }
  if (inCart) {
    // console.log("inCart")
    document.querySelector(".cart").textContent = inCart;
  }
}

function includeButton() {
  let includes = document.querySelectorAll(".include");
  includes.forEach((include) => {
    include.addEventListener("click", () => {
      let inCart = localStorage.getItem("inCart");
      inCart = parseInt(inCart);
      if (inCart) {
        inCart = inCart + 1;
        localStorage.setItem("inCart", inCart);
        document.querySelector(".cart").textContent = inCart;
      } else {
        localStorage.setItem("inCart", 1);
        document.querySelector(".cart").textContent = 1;
      }
    });
  });
}
function excluidButton() {
  let excluids = document.querySelectorAll(".ter");
  excluids.forEach((excluid) => {
    excluid.addEventListener("click", () => {
      let inCart = localStorage.getItem("inCart");
      inCart = parseInt(inCart);
      if (inCart) {
        inCart = inCart - 1;
        localStorage.setItem("inCart", inCart);
        document.querySelector(".cart").textContent = inCart;
      }
    });
  });
}

function clearCart() {
  // let clear = localStorage.clear();
  let clear = localStorage.removeItem("inCart");
  clear;
  document.querySelector(".cart").textContent = 0;
}

// =============================================================================
// preloader
// =============================================================================
let preloader = document.querySelector("#preloader");
if (preloader) {
  window.addEventListener("load", () => {
    setTimeout(() => removePreloader(), 2000);
  });
}
function removePreloader() {
  preloader.remove();
}

// =============================================================================

// // operacoes adicionar e subtrair
// window.addEventListener("load", () => {
//   let plus = document.querySelectorAll(".btn-plus");
//   let subt = document.querySelectorAll(".btn-subtract");

//   let a = 1;
//   plus.forEach((plu) => {
//     plu.addEventListener("click", () => {
//       a = plu.previousElementSibling.value;
//       if (a < 10) {
//         a++;
//         a = a < 10 ? "0" + a : a;

//         let input = plu.previousElementSibling;
//         input.value = a;
//         a = input.value;
//       }
//     });
//   });
//   subt.forEach((sub) => {
//     sub.addEventListener("click", () => {
//       a = sub.nextElementSibling.value;
//       //   console.log(a);

//       if (a > 1) {
//         a--;
//         a = a < 10 ? "0" + a : a;
//         let input = sub.nextElementSibling;
//         input.value = a;
//       }
//     });
//   });
// });
// handleProducts();
excluidButton();
setDefault();
