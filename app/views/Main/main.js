const leftButton = document.querySelector(".ip-nav-left")
const rightButton = document.querySelector(".ip-nav-right")
var background = document.querySelector(".ip-slideshow")
const navbar = document.querySelector(".navbar")

var currentPicture = 1;
 
background.style.backgroundImage = `url(app/views/Main/slider_imgs/${currentPicture}.jpg)`

const buttonsVisibility = () =>
{
    if (currentPicture <= 1)
        leftButton.style.display = "none";
    else 
    if (currentPicture >= 4)
        rightButton.style.display = "none";
    else
    {
        leftButton.style.display = "block";
        rightButton.style.display = "block";
    }
}

const setLeftImg = () =>{
    if (currentPicture > 1)
    {
        currentPicture --;
        background.style.backgroundImage = `url(app/views/Main/slider_imgs/${currentPicture}.jpg)`
    }
    buttonsVisibility()
}


const setRightImg = () =>{

    if (currentPicture < 4)
    {
        currentPicture ++;
        background.style.backgroundImage = `url(app/views/Main/slider_imgs/${currentPicture}.jpg)`
    }
    buttonsVisibility()
}




buttonsVisibility()
leftButton.addEventListener( "click" , setLeftImg);
rightButton.addEventListener( "click" , setRightImg);