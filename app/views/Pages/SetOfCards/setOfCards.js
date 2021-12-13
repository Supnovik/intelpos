var sidebarButtons = document.querySelector(".setofcards-sidebar-buttons");
var sidebarInput = document.querySelector(".setofcards-sidebar-input");
var sidebarComments = document.querySelector(".setofcards-sidebar-comments");
var sidebarButtonSaveDelete = document.querySelector(".save-delete-card");
var sidebarButtonCreate = document.querySelector(".create-card");
var openSidebarButton = document.querySelector('.setofcards-sidebar-open');
var sidebar = document.querySelector('.setofcards-sidebar');

var sidebarInputTermin = document.querySelector(
    ".setofcards-sidebar-input-termin"
);
var sidebarInputOldId = document.querySelector(
    ".setofcards-sidebar-input-oldId"
);
var sidebarInputDefinition = document.querySelector(
    ".setofcards-sidebar-input-definition"
);

function allDisplayNone() {
    sidebarButtons.style.display = "none";
    sidebarButtonCreate.style.display = "none";
    sidebarButtonSaveDelete.style.display = "none";
    sidebarInput.style.display = "none";
    sidebarComments.style.display = "none";
}

document.querySelector(".setofcards-sidebar-buttons-add")
    .addEventListener("click", function () {
        allDisplayNone();
        sidebarInput.style.display = "block";
        sidebarButtonCreate.style.display = "block";
    });

var cancel = document.querySelectorAll(".setofcards-sidebar-input-cancel");
cancel.forEach((element) => {
    element.addEventListener("click", function () {
        allDisplayNone();
        sidebarButtons.style.display = "block";
        sidebarInputTermin.value = "";
        sidebarInputDefinition.value = "";
    });
});

var card = document.querySelectorAll(".setofcards-table-card");
card.forEach((element) => {
    element.addEventListener("click", function () {

        setSidebar();
        allDisplayNone();
        sidebarInput.style.display = "block";
        sidebarButtonSaveDelete.style.display = "block";
        sidebarInputOldId.value = element.childNodes[5].innerHTML.toString();
        sidebarInputTermin.value = element.childNodes[1].innerHTML.toString();
        sidebarInputDefinition.value = element.childNodes[3].innerHTML.toString();
    });
});

document.querySelector(".setofcards-sidebar-buttons-comments")
    .addEventListener("click", function () {
        allDisplayNone();
        sidebarComments.style.display = "block";
    });

openSidebarButton.addEventListener('click', setSidebar)

function setSidebar(){
    if (openSidebarButton.classList.contains('change')) {
        openSidebarButton.classList.remove("change");
    } else
        openSidebarButton.classList.add("change");

    if (sidebar.style.marginLeft === '0px') {
        sidebar.style.marginLeft = '-30%';
    } else
        sidebar.style.marginLeft = '0';
}

