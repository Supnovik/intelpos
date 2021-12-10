var cardTermin = document.querySelector(".learnCards-termin");
var cardDefinition = document.querySelector(".learnCards-definition");
var input = document.querySelector(".learnCards-input");
var check = document.querySelector(".learnCards-check");
var right = document.querySelector(".learnCards-check-right");
var wrong = document.querySelector(".learnCards-check-wrong");
var checkButton = document.querySelector(".learnCards-check-button");
var nextButton = document.querySelector(".learnCards-next-button");
var rightButton = document.querySelector(".learnCards-right-button");
var userAnswer = document.querySelector(".learnCards-userAnswer");
var statisticButton = document.querySelector(".learnCards-statistic-button");
var userAnswerUser = document.querySelector(".learnCards-userAnswer-user");
var userAnswerRight = document.querySelector(".learnCards-userAnswer-right");

var dataLength = data.length;
var currentCard = 0;
var rightAnswerCounter = 0;

cardTermin.innerHTML = data[currentCard].termin;

checkButton.addEventListener("click", function () {
    input.style.display = "none";
    check.style.display = "flex";
    if (currentCard + 1 < dataLength) nextButton.style.display = "block";
    else statisticButton.style.display = "block";
    if (cardDefinition.value == data[currentCard].definition) {
        rightAnswerCounter++;
        wrong.style.display = "none";
        right.style.display = "flex";
    } else {
        userAnswer.style.display = "block";
        userAnswerUser.innerHTML = `Your answer: ${cardDefinition.value}`;
        userAnswerRight.innerHTML = `Right answer: ${data[currentCard].definition}`;
        rightButton.style.display = "block";
        right.style.display = "none";
        wrong.style.display = "flex";
    }
});
nextButton.addEventListener("click", function () {
    currentCard++;
    cardTermin.innerHTML = data[currentCard].termin;
    input.style.display = "flex";
    userAnswer.style.display = "none";

    check.style.display = "none";
    cardDefinition.value = "";
    rightButton.style.display = "none";

    if (currentCard + 1 < dataLength) {
        nextButton.style.display = "block";
        statisticButton.style.display = "none";
    } else {
        nextButton.style.display = "none";
        statisticButton.style.display = "block";
    }
});
var modal = document.querySelector(".user-content-modal");
var statistic = document.querySelector(".learnCards-modal-content-text");
statisticButton.addEventListener("click", function () {
    statistic.innerHTML = `Correct answers - ${rightAnswerCounter} out of ${dataLength}`;
    document.body.style.overflow = "hidden";
    modal.style.opacity = 1;
    modal.style.pointerEvents = "all";
});

rightButton.addEventListener("click", function () {
    rightAnswerCounter++;
    rightButton.style.display = "none";
    wrong.style.display = "none";
    right.style.display = "flex";
    userAnswer.style.display = "block";
    userAnswerUser.innerHTML = `Your answer: ${cardDefinition.value}`;
    userAnswerRight.innerHTML = `Right answer: ${data[currentCard].definition}`;
});

var closemodal = document
    .querySelector(".user-content-close-modal")
    .addEventListener("click", function () {
        document.body.style.overflow = "visible";
        modal.style.opacity = 0;
        modal.style.pointerEvents = "none";
    });
