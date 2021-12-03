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
  });
  card.addEventListener(`dragend`, (e) => {
    e.target.classList.remove(`selected`);

    var backdropPos = getCoords(backdrop);
    var left = ((e.x - relcoor.x - backdropPos.left) / backdropPos.width) * 100;
    var top = ((e.y - relcoor.y - backdropPos.top) / backdropPos.height) * 100;

    if (left >= 0 && left <= 90 && top >= 0 && top <= 90) {
      var termin = card.querySelector(".backdropPage-card-termin").innerHTML;
      var definition = card.querySelector(
        ".backdropPage-card-definition"
      ).innerHTML;
      var form = document.createElement("form");
      form.method = "post";
      form.draggable = "true";
      form.className = "card-onBackdrop";
      form.innerHTML = `
        <div class="backdropPage-card-termin">${termin}</div>
        <input type="text" style="display: none" name="termin" value="${termin}">
        <input type="text" style="display: none" name="definition" value="${definition}">
        <input type="text" style="display: none" name="x_coordinate" value="${left}">
        <input type="text" style="display: none" name="y_coordinate" value="${top}">
        <button name="addCardToBackdrop">click to save</button>`;
      form.style.left = left + "%";
      form.style.top = top + "%";
      backdrop.append(form);
    }
  });
});

document.querySelectorAll(".card-onBackdrop").forEach((card) => {
  var relcoor;
  card.addEventListener(`dragstart`, (e) => {
    e.target.classList.add(`selected`);
    relcoor = relativeCoords(e);
  });
  card.addEventListener(`dragend`, (e) => {
    e.target.classList.remove(`selected`);

    var backdropPos = getCoords(backdrop);
    var left = ((e.x - relcoor.x - backdropPos.left) / backdropPos.width) * 100;
    var top = ((e.y - relcoor.y - backdropPos.top) / backdropPos.height) * 100;

    if (left >= 0 && left <= 90 && top >= 0 && top <= 90) {
      card.style.left = left + "%";
      card.style.top = top + "%";
      card.querySelector(".changeCardPos").style.display = "block";
      card.querySelector(".x_coordinate").value = left;
      card.querySelector(".y_coordinate").value = top;
    }
  });
});
