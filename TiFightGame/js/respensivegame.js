const optionsGame = document.querySelector("#character-stats")

const mediaPhone = window.matchMedia("(max-width:500px)");
const mediaTablette = window.matchMedia("(max-width:900px)");



function gamePhone() {
  return new Promise((resolve, reject) => {
    optionsGame.style.flexDirection = "column";
  })

}


function gameTablette() {
  return new Promise((resolve, reject) => {
    optionsGame.style.flexDirection = "row";
  })

}




window.onload = async function () {

  if (mediaPhone.matches) {
    gamePhone()
      .catch((error) => { })
    
  } else if (mediaTablette.matches) {
    gameTablette()
      .catch((error) => { })
  }
}


window.addEventListener('resize', function (rezsizePage) {

  if (mediaPhone.matches) {
    gamePhone()
      .catch((error) => { })
  } else if (mediaTablette.matches) {
    gameTablette()
      .catch((error) => { })
  }
})

