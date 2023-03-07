var root = document.querySelector(":root");
const body = document.querySelector("body");
var gcs = getComputedStyle(root);
let dark = document.querySelector(".dark");
let light = document.querySelector(".light");

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
  let inCart = localStorage.getItem("inCart");

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

includeButton();
excluidButton();
setDefault();
