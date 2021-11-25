var modal = document.querySelector(".page_of_backdrops-modal");
var openmodal = document
  .querySelector(".page_of_backdrops-open-modal")
  .addEventListener("click", function () {
    document.body.style.overflow = "hidden";
    modal.style.opacity = 1;
    modal.style.pointerEvents = "all";
  });
var closemodal = document
  .querySelector(".page_of_backdrops-close-modal")
  .addEventListener("click", function () {
    document.body.style.overflow = "visible";
    modal.style.opacity = 0;
    modal.style.pointerEvents = "none";
  });
