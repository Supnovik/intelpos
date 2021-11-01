const leftButton = document.querySelector(".ip-nav-left")
const rightButton = document.querySelector(".ip-nav-right")
var background = document.querySelector(".ip-slideshow")

var currentPicture = 1;

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
        background.style.backgroundImage = `url(src/imgs/mainPage_slider/${currentPicture}.jpeg)`
    }
    buttonsVisibility()
}


const setRightImg = () =>{

    if (currentPicture < 4)
    {
        currentPicture ++;
        background.style.backgroundImage = `url(src/imgs/mainPage_slider/${currentPicture}.jpeg)`
    }
    buttonsVisibility()
}


buttonsVisibility()
leftButton.addEventListener( "click" , setLeftImg);
rightButton.addEventListener( "click" , setRightImg);
