
// metody pro práci s canvasem
var canvas;
var context;
var ctx;
var xaxis = 10;
var yaxis = 10;
var obstacle = [];
var relative;

// při načtení okna se zavolá funkce darkmode a nastaví se canvas, context a ctx + spustí se metoda drawCanv
window.onload = function loadCanv() {
  darkmode();
  canvas = document.getElementById("canvas");
  context = canvas.getContext("2d");
  ctx = canvas.getContext("2d");
  drawCanv();
}

// blok který se zobrazuje v canvasu (není průchodný)
var chad = {
  height: 50,
  width: 50,
  x: 100,
  y: 100,
};

// hráč, který se pohybuje na mapě
var player = {
  height: 10,
  width: 10,
};

// Metoda, která vypisuje canvas + zapisuje souřadnice do <p> tagu
function drawCanv() {
  context.beginPath();
  context.fillStyle = "#ffffff";
  context.fillRect(0, 0, canvas.clientWidth, canvas.clientHeight);

  context.beginPath();
  context.fillStyle = "black";
  context.fillRect(xaxis, yaxis, player.width, player.height);

  var ndx =
    obstacle.push({
      x: chad.x,
      y: chad.y,
      width: chad.width,
      height: chad.height,
    }) - 1;
  ctx.beginPath();
  ctx.fillStyle = "pink";
  ctx.fillRect(
    obstacle[ndx].x,
    obstacle[ndx].y,
    obstacle[ndx].width,
    obstacle[ndx].height
  );

  document.getElementById("souradx").innerHTML = xaxis;
  document.getElementById("sourady").innerHTML = yaxis;
}

// Metoda, která zjišťuje jestli hráč narazil do překážky
function hitObsta(player, array) {
  for (var value of array) {
    if (
      player.x + player.width > value.x &&
      player.x < value.x + value.width &&
      player.y + player.height > value.y &&
      player.y < value.y + value.height
    ) {
      return true;
    }
  }

  return false;
}

// Metoda, která zjistí jaké klávesy se stiskly -> pokud se stiskne W,A,S,D posune se hráč,
// pokud hráč narazil do překážky následnuje alert s hláškou, po vyhodnocení se znovu zavolá metoda drawCanv.
// Hetoda zakazuje hráči "opustit" canvas -> pokud se ho dotkne nepustí ho dále ve směru překážky (border, chad)
function onkeydown(e) {
  if (e.keyCode == 68 && xaxis + 10 < canvas.width) {
    xaxis++;
    document.getElementById("souradx").innerHTML = xaxis;

    var updatedCoords = Object.assign(
      {
        x: xaxis,
        y: yaxis,
      },
      player
    );
    if (hitObsta(updatedCoords, obstacle)) {
      xaxis--;
      alert("Narazili jste do boxu!");
    }
  } else if (e.keyCode == 65 && xaxis > 0) {
    xaxis--;
    document.getElementById("souradx").innerHTML = xaxis;
    var updatedCoords = Object.assign(
      {
        x: xaxis,
        y: yaxis,
      },
      player
    );
    if (hitObsta(updatedCoords, obstacle)) {
      xaxis++;
      alert("Narazili jste do boxu!");
    }
  } else if (e.keyCode == 87 && yaxis > 0) {
    yaxis--;
    document.getElementById("sourady").innerHTML = yaxis;
    var updatedCoords = Object.assign(
      {
        x: xaxis,
        y: yaxis,
      },
      player
    );
    if (hitObsta(updatedCoords, obstacle)) {
      yaxis++;
      alert("Narazili jste do boxu!");
    }
  } else if (e.keyCode == 83 && yaxis + 10 < canvas.height) {
    yaxis++;
    document.getElementById("sourady").innerHTML = yaxis;
    var updatedCoords = Object.assign(
      {
        x: xaxis,
        y: yaxis,
      },
      player
    );
    if (hitObsta(updatedCoords, obstacle)) {
      yaxis--;
      alert("Narazili jste do boxu!");
    }
  }
  drawCanv();
}

// Event Listener který zaznamenává kliknutí na klávesnici
window.addEventListener("keydown", onkeydown);
