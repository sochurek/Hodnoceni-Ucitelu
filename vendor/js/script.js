function modeChange() {
  var body = document.body;
  var header = document.header;
  var menu = document.getElementsByClassName("menu");
  const btn = document.getElementById("drkmd");

  if (btn.innerText == "Tmavý režim") {
    btn.innerText = "Světlý režim";
    body.className = "dark-mode-body";
    header.className = "dark-mode-header";
    menu.className = "dark-mode-menu";
  } else if (btn.innerText == "Světlý režim") {
    btn.innerText = "Tmavý režim";
    body.className = "light-mode-body";
    header.className = "light-mode-header";
    menu.className = "light-mode-menu";
  }
}

window.onscroll = function () {
  myFunction();
};

var navbar = document.getElementById("menu");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky");
  } else {
    navbar.classList.remove("sticky");
  }
}
