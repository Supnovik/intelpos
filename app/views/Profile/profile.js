var openmodal = document
  .querySelector(".user-content-open-modal")
  .addEventListener("click", function () {
    document.body.style.overflow = "hidden";
    document.querySelector(".user-content-modal").style.opacity = 1;
    document.querySelector(".user-content-modal").style.pointerEvents = "all";
  });
var closemodal = document
  .querySelector(".user-content-close-modal")
  .addEventListener("click", function () {
    document.body.style.overflow = "visible";
    document.querySelector(".user-content-modal").style.opacity = 0;
    document.querySelector(".user-content-modal").style.pointerEvents = "none";
  });
