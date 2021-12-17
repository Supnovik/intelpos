var createButton = document.querySelector('.registration-create-user');
var password = document.querySelector('.user-password');
var passwordRepeate = document.querySelector('.user-password-repeate');
createButton.addEventListener('click', function (e) {
    if (password.value !== passwordRepeate.value) {
        e.preventDefault()
        alert("passwords don't match")
    }
})