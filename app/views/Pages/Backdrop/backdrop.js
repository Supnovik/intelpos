var cards = document.querySelectorAll(".backdropPage-card");
var backdrop = document.querySelector(".backdropPage-content-backdrop");
var backdropCards = document.querySelectorAll(".card-onBackdrop");
var sidebar = document.querySelector(".backdropPage-sidebar");
var cardsList = document.querySelector(".backdropPage-sidebar-cardsList");
var cardInfo = document.querySelector(".backdropPage-sidebar-cardInfo");
var cardInfoTermin = document.querySelector(
    ".backdropPage-sidebar-cardInfo-termin"
);
var cardInfoDefinition = document.querySelector(
    ".backdropPage-sidebar-cardInfo-definition"
);
var cardInfoClose = document.querySelector(
    ".backdropPage-sidebar-cardInfo-close"
);
var cardInfoRemove = document.querySelectorAll(
    ".backdropPage-sidebar-cardInfo-remove"
);


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
    return {x: x, y: y};
}

if (user == setOwner) {
    cards.forEach((card) => {
        var relcoor;
        card.addEventListener("dragstart", (e) => {
            relcoor = relativeCoords(e);
        });
        card.addEventListener("dragend", (e) => {
            var backdropPos = getCoords(backdrop);
            var left =
                ((e.x - relcoor.x - backdropPos.left) / backdropPos.width) * 100;
            var top =
                ((e.y - relcoor.y - backdropPos.top) / backdropPos.height) * 100;

            if (left >= 0 && left <= 90 && top >= 0 && top <= 90) {
                addCardToBackdrop(card, left, top);
            }

        });

        card.addEventListener('touchmove', function (e) {

            disableScroll();
            var touchLocation = e.targetTouches[0];
            card.classList.add('touchable');
            card.style.left = touchLocation.pageX + 'px';
            card.style.top = touchLocation.pageY + 'px';
        })

        card.addEventListener('touchend', function (e) {
            var backdropPos = getCoords(backdrop);
            enableScroll();
            var left =
                ((card.style.left.substring(0, card.style.left.length - 2) - backdropPos.left) / backdropPos.width) * 100;
            var top =
                ((card.style.top.substring(0, card.style.top.length - 2) - backdropPos.top) / backdropPos.height) * 100;


            card.classList.remove('touchable');
            if (left >= 0 && left <= 90 && top >= 0 && top <= 90) {
                addCardToBackdrop(card, left, top)
            }
        })
    });
}

function addCardToBackdrop(card, left, top) {
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
        <button name="addCardToBackdrop" class="addCardToBackdrop">Save card position</button>`;
    form.style.left = left + "%";
    form.style.top = top + "%";
    backdrop.append(form);
}

document.querySelectorAll(".card-onBackdrop").forEach((card) => {
    if (user == setOwner) {
        var relcoor;
        card.addEventListener("dragstart", (e) => {
            relcoor = relativeCoords(e);
        });
        card.addEventListener("dragend", (e) => {
            var backdropPos = getCoords(backdrop);
            var left =
                ((e.x - relcoor.x - backdropPos.left) / backdropPos.width) * 100;
            var top =
                ((e.y - relcoor.y - backdropPos.top) / backdropPos.height) * 100;

            if (left >= 0 && left <= 90 && top >= 0 && top <= 90) {
                card.style.left = left + "%";
                card.style.top = top + "%";
                card.querySelector(".changeCardPos").style.display = "block";
                card.querySelector(".x_coordinate").value = left;
                card.querySelector(".y_coordinate").value = top;
            }
        });
    }
    card.addEventListener("click", () => {
        cardsList.style.display = "none";
        cardInfo.style.display = "block";
        cardInfo.querySelector("#id").value = card.querySelector("#id").value;
        cardInfoTermin.innerHTML = card.querySelector("#termin").value;
        cardInfoDefinition.innerHTML = card.querySelector("#definition").value;
    });
});

cardInfoClose.addEventListener("click", () => {
    cardsList.style.display = "grid";
    cardInfo.style.display = "none";
    cardInfoTermin.innerHTML = "";
    cardInfoDefinition.innerHTML = "";
});

if (cardInfoRemove.length !== 0) {
    cardInfoRemove[0].addEventListener("click", () => {
        cardsList.style.display = "grid";
        cardInfo.style.display = "none";
        cardInfoTermin.innerHTML = "";
        cardInfoDefinition.innerHTML = "";
    });
}

function disableScroll() {
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

    window.onscroll = function () {
        window.scrollTo(scrollLeft, scrollTop);
    };
}

function enableScroll() {
    window.onscroll = function () {
    };
}