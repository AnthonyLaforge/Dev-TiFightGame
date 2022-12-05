const optionsFight = document.querySelector("#options")
const html = document.querySelector("html")

const mediaPhone = window.matchMedia("(max-width:500px)");
const mediaTablette = window.matchMedia("(max-width:900px)");



function fightPhone() {
  return new Promise((resolve, reject) => {
    optionsFight.style.fontSize = "0.5em";
    
  })

}




window.onload = async function () {

  if (mediaPhone.matches) {
    fightPhone()
      .catch((error) => { })
    
  } else if (mediaTablette.matches) {

  }
}


window.addEventListener('resize', function (rezsizePage) {

  if (mediaPhone.matches) {
    fightPhone()
      .catch((error) => { })
  } else if (mediaTablette.matches) {

  }
})


