var sidebarButtons = document.querySelector(".setofcards-sidebar-buttons");
var sidebarInput = document.querySelector(".setofcards-sidebar-input");

var addNewCard = document
  .querySelector(".setofcards-sidebar-buttons-add")
  .addEventListener("click", function () {
    sidebarButtons.style.display = "none";
    sidebarInput.style.display = "block";
  });

var cancel = document
  .querySelector(".setofcards-sidebar-input-cancel")
  .addEventListener("click", function () {
    sidebarButtons.style.display = "block";
    sidebarInput.style.display = "none";
  });
console.log(1);
