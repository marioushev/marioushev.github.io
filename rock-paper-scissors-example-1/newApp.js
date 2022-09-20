const computerChoiceDisplay = document.getElementById("computer-choice");
const userChoiceDisplay = document.getElementById("user-choice");
const resultDisplay = document.querySelector("#result");
const possibleChoice = document.querySelectorAll("button");
let userChoice;
let computerChoice;
let result;

possibleChoice.forEach((possibleChoice) =>
  possibleChoice.addEventListener("click", (e) => {
    userChoice = e.target.id;
    userChoiceDisplay.innerHTML = userChoice;
    generateComputerChoice();
    getResults();
  })
);
function generateComputerChoice() {
  const randomNumber = Math.floor(Math.random() * possibleChoice.length) + 1; //3
  if (randomNumber === 3) {
    computerChoice = "rock";
  } else if (randomNumber === 2) {
    computerChoice = "paper";
  } else if (randomNumber === 1) {
    computerChoice = "scissors";
  }
  computerChoiceDisplay.innerHTML = computerChoice;
}

function getResults() {
  if (computerChoice === userChoice) {
    result = "draw";
  } else if (computerChoice === "rock" && userChoice === "paper") {
    result = "you win";
  } else if (computerChoice === "rock" && userChoice === "scissors") {
    result = "you lose";
  } else if (computerChoice === "paper" && userChoice === "scissors") {
    result = "you win";
  } else if (computerChoice === "paper" && userChoice === "rock") {
    result = "you lose";
  } else if (computerChoice === "scissors" && userChoice === "rock") {
    result = "you win";
  } else if (computerChoice === "scissors" && userChoice === "paper") {
    result = "you lose";
  }
  resultDisplay.innerHTML = result;
}
