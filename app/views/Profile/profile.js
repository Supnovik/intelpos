var modal = document.querySelector(".user-content-modal");
var openmodal = document
  .querySelector(".user-content-open-modal")
  .addEventListener("click", function () {
    document.body.style.overflow = "hidden";
    modal.style.opacity = 1;
    modal.style.pointerEvents = "all";
  });
var closemodal = document
  .querySelector(".user-content-close-modal")
  .addEventListener("click", function () {
    document.body.style.overflow = "visible";
    modal.style.opacity = 0;
    modal.style.pointerEvents = "none";
  });
