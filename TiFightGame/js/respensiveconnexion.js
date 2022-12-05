const connexion = document.querySelector("#connexion");
const connexionForm = document.querySelector("form");
const submitButton = document.querySelector("form input[type='submit']");
const noAccountButton = document.querySelector("#connexion > span")
const registerForm = document.querySelector("body > div.register > form");

const mediaPhone = window.matchMedia("(max-width:500px)");
const mediaTablette = window.matchMedia("(max-width:900px)");


function connexionPhone() {
  return new Promise((resolve, reject) => {
    connexion.style.margin = "20px";
    connexionForm.style.display = "flex";
    connexionForm.style.flexDirection = "column";
    connexionForm.style.flexWrap = "wrap";
    submitButton.style.margin = "20px";
  })

}


function connexionTablette() {
  return new Promise((resolve, reject) => {
    connexion.style.position = "relative";
    connexion.style.left = "85px";
    connexion.style.margin = "auto";
    connexion.style.width = "70%";
    connexion.style.fontSize = "1.5em";
    connexionForm.style.display = "flex";
    connexionForm.style.width = "70%";
    connexionForm.style.flexDirection = "column";
    connexionForm.style.flexWrap = "wrap";
    connexionForm.style.justifyItems = "center";
    submitButton.style.margin = "20px";
    noAccountButton.style.position = "relative";
    noAccountButton.style.right = "80px";

  })
}


function registerPhone() {
  return new Promise((resolve, reject) => {
    registerForm.style.display = "flex";
    registerForm.style.flexDirection = "column"
  })
}

function registerTablette() {
  return new Promise((resolve, reject) => {
    registerForm.style.display = "flex";
    registerForm.style.flexDirection = "column"
    registerForm.style.fontSize = "1.5em";
    registerForm.style.width = "80%";
    registerForm.style.margin = "auto";
  })
}



window.onload = async function () {

  if (mediaPhone.matches) {
    connexionPhone()
      .catch((error) => { })
    registerPhone()
      .catch((error) => { })
    
  } else if (mediaTablette.matches) {
    connexionTablette()
      .catch((error) => { })
    registerTablette()
      .catch((error) => { })
  }
}


window.addEventListener('resize', function (rezsizePage) {

  if (mediaPhone.matches) {
    connexionPhone()
      .catch((error) => { })
    registerPhone()
      .catch((error) => { })
  } else if (mediaTablette.matches) {
    connexionTablette()
      .catch((error) => { })
    registerTablette()
      .catch((error) => { })
  }
})