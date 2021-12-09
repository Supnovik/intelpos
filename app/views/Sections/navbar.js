var signUser = document.querySelector(".sign-user");
var myProfile = document.querySelector(".my-profile");
var signOut = document.querySelector(".sign-out");
var signUserImg = document.querySelector(".sign-user-img");

if (signUserImg) {
    signUserImg.addEventListener("click", function () {
        if (signUser.classList.contains("active")) {
            signUser.classList.remove("active");
            myProfile.style.display = "none";
            signOut.style.display = "none";
        } else {
            signUser.classList.add("active");
            myProfile.style.display = "block";
            signOut.style.display = "block";
        }
    });
}
