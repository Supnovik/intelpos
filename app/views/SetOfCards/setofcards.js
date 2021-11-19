var sidebarButtons = document.querySelector(".setofcards-sidebar-buttons");
var sidebarInput = document.querySelector(".setofcards-sidebar-input");
var sidebarButtonSaveDelete = document.querySelector(".save-delete-card");
var sidebarButtonCreate = document.querySelector(".create-card");
var sidebarInputTermin = document.querySelector(
  ".setofcards-sidebar-input-termin"
);
var sidebarInputOldTermin = document.querySelector(
  ".setofcards-sidebar-input-oldtermin"
);
var sidebarInputDefinition = document.querySelector(
  ".setofcards-sidebar-input-definition"
);

var addNewCard = document
  .querySelector(".setofcards-sidebar-buttons-add")
  .addEventListener("click", function () {
    sidebarButtons.style.display = "none";
    sidebarButtonSaveDelete.style.display = "none";
    sidebarInput.style.display = "block";
    sidebarButtonCreate.style.display = "block";
  });

var cancel = document
  .querySelector(".setofcards-sidebar-input-cancel")
  .addEventListener("click", function () {
    sidebarButtons.style.display = "block";
    sidebarInput.style.display = "none";
    sidebarInputTermin.value = "";
    sidebarInputDefinition.value = "";
  });

var card = document.querySelectorAll(".setofcards-table-card");
card.forEach((element) => {
  element.addEventListener("click", function () {
    sidebarButtons.style.display = "none";
    sidebarButtonCreate.style.display = "none";
    sidebarInput.style.display = "block";
    sidebarButtonSaveDelete.style.display = "block";
    sidebarInputOldTermin.value = element.childNodes[1].innerHTML.toString();
    sidebarInputTermin.value = element.childNodes[1].innerHTML.toString();
    sidebarInputDefinition.value = element.childNodes[3].innerHTML.toString();
  });
});
