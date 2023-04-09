const url = document.querySelector(".cards-products").getAttribute("data-url");

fetch(`${url}/api`)
  .then((response) => response.json())
  .then((data) => {
    let products = data;

    const buttonCats = document.querySelectorAll("button.cat");

    let currentProducts = products;
    for (let index = 0; index < buttonCats.length; index++) {
      buttonCats[index].addEventListener("click", () => {
        toggle(buttonCats[index]);
        productsFilters(buttonCats[index].getAttribute("data-category"));
      });
    }

    function toggle(button) {
      let isCurrentCategory = button.getAttribute("data-category");
      if (
        Number(isCurrentCategory) ===
        Number(button.getAttribute("data-category"))
      ) {
        button.classList.add("active");
      }

      for (let index = 0; index < buttonCats.length; index++) {
        if (
          buttonCats[index].getAttribute("data-category") !==
          button.getAttribute("data-category")
        ) {
          buttonCats[index].classList.remove("active");
        }
      }
    }

    function createElement(element) {
      return document.createElement(element);
    }

    function appendChild(element, children) {
      element.appendChild(children);
    }

    function handleProducts() {
      const cards = document.querySelector(".cards-products");
      cards.innerHTML = "";
      for (let i = 0; i < currentProducts.length; i++) {
        const btnInclude = createElement("button");
        const card = createElement("div");
        const image = createElement("img");
        const title = createElement("h3");
        const price = createElement("span");

        image.src =
          cards.getAttribute("data-url") +
          "/public/" +
          currentProducts[i].image;
        image.setAttribute("width", "100");
        image.setAttribute("height", "100");

        title.innerHTML = currentProducts[i].title;
        price.innerHTML = currentProducts[i].price;
        btnInclude.innerHTML = "Add+";
        // btnInclude.setAttribute("type", "submit");
        // btnInclude.setAttribute("value", "submit");

        card.classList.add("card");
        title.classList.add("title");
        price.classList.add("price");
        btnInclude.classList.add("btn");
        btnInclude.classList.add("btn-primary");
        btnInclude.classList.add("include");

        appendChild(card, image);
        appendChild(card, title);
        appendChild(card, price);
        appendChild(card, btnInclude);

        appendChild(cards, card);
      }
    }

    function productsFilters(category_id) {
      if (Number(category_id) !== 0) {
        currentProducts = products.filter(
          (product) => product.category_id === Number(category_id)
        );
        handleProducts();
      } else {
        currentProducts = products;
        handleProducts();
      }
    }

    function includeButton() {
      let includes = document.querySelectorAll("button.include");
      for (let i = 0; i < includes.length; i++) {
        includes[i].addEventListener("click", () => {
          cartNumbers(products[i]);
          totalCost(products[i]);
        });
      }
    }

    function cartNumbers(product) {
      let inCart = localStorage.getItem("inCart");
      inCart = parseInt(inCart);
      if (inCart) {
        inCart = inCart + 1;
        localStorage.setItem("inCart", inCart);
        document.querySelector(".badge").textContent = inCart;
      } else {
        localStorage.setItem("inCart", 1);
        document.querySelector(".badge").textContent = 1;
      }
      setItem(product);
    }
    function setItem(product) {
      let cartItems = localStorage.getItem("productsInCart");
      cartItems = JSON.parse(cartItems);
      if (cartItems != null) {
        if (cartItems[product.title] == undefined) {
          cartItems = {
            ...cartItems,
            [product.title]: product,
          };
        }
        cartItems[product.title].inCart += 1;
      } else {
        product.inCart = 1;
        cartItems = {
          [product.title]: product,
        };
      }
      localStorage.setItem("productsInCart", JSON.stringify(cartItems));
    }
    function totalCost(product) {
      let price = JSON.parse(product.price);
      let totalCost = parseInt(localStorage.getItem("totalCost"));

      if (totalCost) {
        totalCost = totalCost + price;
        localStorage.setItem("totalCost", totalCost);
      } else {
        localStorage.setItem("totalCost", price);
      }
    }
    function showCartProducts() {
      let table = document.querySelector("table");
      let tbody = document.querySelector("tbody");
      let totalTag = document.querySelector("#totalCost");
      let cartItems = localStorage.getItem("productsInCart");
      let totalCost = localStorage.getItem("totalCost");
      cartItems = JSON.parse(cartItems);
      if (cartItems && tbody) {
        tbody.innerHTML = "";
        Object.values(cartItems).map((item) => {
          tbody.innerHTML += `<tr>
          <th scope='row'>
            <i class='bi bi-dash btn-subtract'></i>
            <input type='text' name='qtd' class='operations' value='${item.inCart}' readonly>
            <i class='bi bi-plus btn-plus'></i>
          </th>
          <td>
          <img src='${url}/${item.image}' alt='produto no carrinho' width='30' height='30'/>
          </td>
          <td>${item.title}</td>
          <td>${item.price}</td>
          <td>${item.inCart * item.price}.00</td>
          <td><a href='#'>
              <i class='bi bi-x-circle'></i>
            </a></td>

        </tr>`;
        });
      }
      if(totalCost && totalTag){
        totalTag.innerHTML = "";
        totalTag.innerHTML += `${totalCost}.00Kz`;

       
        
      }
    }
    handleProducts();
    includeButton();
    showCartProducts();
    // setInterval(() => {
    //   showCartProducts();
    // }, 1111);
  })
  .catch((err) => console.log(err));

function setDefault() {
  let inCart = localStorage.getItem("inCart") ?? 0;

  if (inCart) {
    // console.log("inCart")
    document.querySelector(".badge").textContent = inCart;
  }
}

// function excluidButton() {
//   let excluids = document.querySelectorAll(".ter");
//   excluids.forEach((excluid) => {
//     excluid.addEventListener("click", () => {
//       let inCart = localStorage.getItem("inCart");
//       inCart = parseInt(inCart);
//       if (inCart) {
//         inCart = inCart - 1;
//         localStorage.setItem("inCart", inCart);
//         document.querySelector(".cart").textContent = inCart;
//       }
//     });
//   });
// }

// function clearCart() {
//   // let clear = localStorage.clear();
//   let clear = localStorage.removeItem("inCart");
//   clear;
//   document.querySelector(".cart").textContent = 0;
// }

// // =============================================================================

// includeButton();
setDefault();
// excluidButton();
