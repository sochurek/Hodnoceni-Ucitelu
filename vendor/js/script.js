
// Při načtení stránky se spustí metoda darkmode
window.onload = function () {
  darkmode();
};

// Metoda, která checkne cookie (když je vytvořené a rovná se "true", změní se stránka automatiky na darkmode) 
function darkmode() {
  let DrkMd = getCookie("DrkMd");
  var body = document.body;
  const bigBoy = document.getElementsByTagName("h1");
  const smallBoy = document.getElementsByTagName("h2");
  const preklik = document.getElementsByTagName("a");
  const text = document.getElementsByTagName("p");
  const lab = document.getElementsByTagName("label");
  const btn = document.getElementById("drkmd");

  if (DrkMd === "true") {
    btn.innerText = "Světlý režim";
    body.className = "dark-mode-body";

    for (let i = 0; i < bigBoy.length; i++) {
      bigBoy[i].className = "dark-mode-h1";
    }

    for (let i = 0; i < smallBoy.length; i++) {
      smallBoy[i].className = "dark-mode-h2";
    }

    for (let i = 0; i < preklik.length; i++) {
      preklik[i].className = "dark-mode-a";
    }

    for (let i = 0; i < lab.length; i++) {
      lab[i].className = "dark-mode-p";
    }


    for (let i = 0; i < text.length; i++) {
      text[i].className = "dark-mode-p";
    }
  }
}

// Metoda, která po kliku na tlačítko, které mění darkmode / lightmode, změní na určitý mód
// darkmode -> vytvoří cookie DrkMd = true, lightmode -> vymaže cookie DrkMd a změní classy tagů na light mode
function modeChange() {
  var body = document.body;
  const bigBoy = document.getElementsByTagName("h1");
  const smallBoy = document.getElementsByTagName("h2");
  const preklik = document.getElementsByTagName("a");
  const lab = document.getElementsByTagName("label");
  const text = document.getElementsByTagName("p");
  const btn = document.getElementById("drkmd");

  if (btn.innerText == "Tmavý režim") {
    setCookie("DrkMd", "true");
    btn.innerText = "Světlý režim";
    body.className = "dark-mode-body";

    for (let i = 0; i < bigBoy.length; i++) {
      bigBoy[i].className = "dark-mode-h1";
    }

    for (let i = 0; i < smallBoy.length; i++) {
      smallBoy[i].className = "dark-mode-h2";
    }

    for (let i = 0; i < preklik.length; i++) {
      preklik[i].className = "dark-mode-a";
    }

    for (let i = 0; i < lab.length; i++) {
      lab[i].className = "dark-mode-p";
    }

    for (let i = 0; i < text.length; i++) {
      text[i].className = "dark-mode-p";
    }


  } else if (btn.innerText == "Světlý režim") {
    delete_cookie("DrkMd");
    btn.innerText = "Tmavý režim";
    body.className = "";

    for (let i = 0; i < bigBoy.length; i++) {
      bigBoy[i].className = "h1";
    }

    for (let i = 0; i < smallBoy.length; i++) {
      smallBoy[i].className = "h2";
    }

    for (let i = 0; i < preklik.length; i++) {
      preklik[i].className = "a";
    }

    for (let i = 0; i < lab.length; i++) {
      lab[i].className = "p";
    }

    for (let i = 0; i < text.length; i++) {
      text[i].className = "p";
    }
  }
}

// Metoda, která získá cookie
function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

// Metoda, která nastaví cookie
function setCookie(cname, cvalue) {
  const d = new Date();
  d.setTime(d.getTime() + 365 * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// Metoda, která vymaže cookie
function delete_cookie(name) {
  if (getCookie(name)) {
    document.cookie =
      name + "=;path=/;domain=localhost;expires=Thu, 01 Jan 1970 00:00:01 GMT";
  }
}
