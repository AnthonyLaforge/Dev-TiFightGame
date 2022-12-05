const title = document.querySelector("#title");
const userPanel = document.querySelector(".userpanel");
const gameStats = document.querySelector("#games-stats");
const playButton = document.querySelector("#launchgame h1 a");

const mediaPhone = window.matchMedia("(max-width:500px)");
const mediaTablette = window.matchMedia("(max-width:900px)");




window.onload = function () {

  if (mediaPhone.matches) {
    this.document.body.style.width = "90%";
    this.document.body.style.margin = "0"
    this.document.body.style.textAlign = "center"
    this.document.body.style.justifyItems = "center";
    title.style.size = "1em";
    title.style.position = "relative";
    title.style.left = "15px";
    userPanel.style.position = "relative";
    userPanel.style.left = "15px";
    userPanel.style.width = "80%";
    userPanel.style.margin = "auto";
    gameStats.style.width = "80%";
    gameStats.style.margin = "0 auto";
    playButton.style.width = "80%";
    playButton.style.fontSize = "0.7em"
    playButton.style.position = "relative";
    playButton.style.left = "15px";
  } else if (mediaTablette.matches) {

    this.document.body.style.width = "90%";
    this.document.body.style.margin = "0"
    this.document.body.style.textAlign = "center"
    this.document.body.style.justifyItems = "center";
    title.style.size = "1em";
    title.style.position = "relative";
    title.style.left = "35px";
    userPanel.style.position = "relative";
    userPanel.style.left = "35px";
    userPanel.style.width = "80%";
    userPanel.style.margin = "auto";
    gameStats.style.width = "80%";
    gameStats.style.margin = "0 auto";
    playButton.style.width = "80%";
    playButton.style.fontSize = "1em"
    playButton.style.position = "relative";
    playButton.style.left = "35px";

  }
}



window.addEventListener('resize', function (rezsizePage) {

  if (mediaPhone.matches) {
    this.document.body.style.width = "90%";
    this.document.body.style.margin = "0"
    this.document.body.style.textAlign = "center"
    this.document.body.style.justifyItems = "center";
    title.style.size = "1em";
    title.style.position = "relative";
    title.style.left = "15px";
    userPanel.style.position = "relative";
    userPanel.style.left = "15px";
    userPanel.style.width = "80%";
    userPanel.style.margin = "auto";
    gameStats.style.width = "80%";
    gameStats.style.margin = "0 auto";
    playButton.style.width = "80%";;
    playButton.style.fontSize = "0.7em"
    playButton.style.position = "relative";
    playButton.style.left = "15px";
  } else if (mediaTablette.matches) {

    this.document.body.style.width = "90%";
    this.document.body.style.margin = "0"
    this.document.body.style.textAlign = "center"
    this.document.body.style.justifyItems = "center";
    title.style.size = "1em";
    title.style.position = "relative";
    title.style.left = "35px";
    userPanel.style.position = "relative";
    userPanel.style.left = "35px";
    userPanel.style.width = "80%";
    userPanel.style.margin = "auto";
    gameStats.style.width = "80%";
    gameStats.style.margin = "0 auto";
    playButton.style.width = "80%";;
    playButton.style.fontSize = "1em"
    playButton.style.position = "relative";
    playButton.style.left = "35px";

  }
});

console.debug()