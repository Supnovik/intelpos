var cards = document.querySelectorAll(".backdropPage-card");
var backdrop = document.querySelector(".backdropPage-content-backdrop");
var sidebar = document.querySelector(".backdropPage-sidebar");

function getCoords(elem) {
  var box = elem.getBoundingClientRect();
  return {
    top: box.top + window.pageYOffset,
    left: box.left + window.pageXOffset,
    height: elem.offsetHeight,
    width: elem.offsetWidth,
  };
}

function relativeCoords(e) {
  var bounds = e.target.getBoundingClientRect();
  var x = e.clientX - bounds.left;
  var y = e.clientY - bounds.top;
  return { x: x, y: y };
}

cards.forEach((card) => {
  var relcoor;
  card.addEventListener(`dragstart`, (e) => {
    e.target.classList.add(`selected`);
    relcoor = relativeCoords(e);
    console.log(window.innerWidth);
  });
  card.addEventListener(`dragend`, (e) => {
    e.target.classList.remove(`selected`);
    var termin = card.querySelector(".backdropPage-card-termin").innerHTML;
    var definition = card.querySelector(
      ".backdropPage-card-definition"
    ).innerHTML;

    var div = document.createElement("div");
    div.className = "onBackdrop";
    div.innerHTML = `<div class="backdropPage-card-termin">${termin}</div>
    <div style="display: none" class="backdropPage-card-definition">${definition}</div>`;

    var backdropPos = getCoords(backdrop);

    div.style.left =
      ((e.x - relcoor.x - backdropPos.left) / backdropPos.width) * 100 + "%";

    //div.style.setProperty("left", `calc(100% + 224px)`);
    div.style.top =
      ((e.y - relcoor.y - backdropPos.top) / backdropPos.height) * 100 + "%";
    backdrop.append(div);

    /*var xCord = e.clientX;
    var yCord = e.clientY;
    var xPercent = (xCord / window.innerWidth) * 100;
    var yPercent = (yCord / window.innerHeight) * 100;*/
  });
});
