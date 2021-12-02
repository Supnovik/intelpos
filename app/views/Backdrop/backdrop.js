var cards = document.querySelectorAll(".backdropPage-card");
var backdrop = document.querySelector(".backdropPage-content-backdrop");
var backdropCards = document.querySelectorAll(".card-onBackdrop");
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
    div.className = "card-onBackdrop";
    div.innerHTML = `<div class="backdropPage-card-termin">${termin}</div>
    <div style="display: none" class="backdropPage-card-definition">${definition}</div>`;

    var backdropPos = getCoords(backdrop);

    div.style.left =
      ((e.x - relcoor.x - backdropPos.left) / backdropPos.width) * 100 + "%";
    div.style.top =
      ((e.y - relcoor.y - backdropPos.top) / backdropPos.height) * 100 + "%";
    backdrop.append(div);
  });
});

backdropCards.forEach((card) => {
  card.addEventListener("click", function () {
    console.log(1);
  });
});
