const gameAnswerBtn = document.getElementById("game-answer-btn");
const gameAdditionSumElement = document.getElementById("addition-sum");
const answersElement = document.getElementById("game-answers");
const endGameBtn = document.getElementById("end-game-btn");
const answers = [];
let startTime;
let amountOfCorrectAnswers = 0;
let amountOfWrongAnswers = 0;
let timerInterval;
let score = 0;

const submitAnswer = () => {
  const firstInputValue = parseInt(document.getElementById("first-input").value);
  const secondInputValue = parseInt(document.getElementById("second-input").value);
  const expectedSum = gameAdditionSumElement.innerText;

  if (isInputValid(firstInputValue) && isInputValid(secondInputValue)) {
    let answer = [firstInputValue, secondInputValue];
    if (!alreadyExistsInAnswers(answer)) {
      if ((firstInputValue + secondInputValue) == expectedSum) {
        answer.push(1);
        amountOfCorrectAnswers++;
      } else {
        answer.push(0);
        amountOfWrongAnswers++;
      }
      answers.push(answer);
    }
  }

  clearInputs();
  updateAnswersElements();
};

const isInputValid = (input) => {
  return input <= 9 && input >= 0;
};

const alreadyExistsInAnswers = (answer) => {
  let alreadyExists = false;

  for (let i = 0; i < answers.length; i++) {
    if (answers[i][0] == answer[0] && answers[i][1] == answer[1]) {
      alreadyExists = true;
    }
  }

  return alreadyExists;
};

const clearInputs = () => {
  document.getElementById("first-input").value = null;
  document.getElementById("second-input").value = null;
};

const updateAnswersElements = () => {
  removeChilds(answersElement);

  /*
    <div class='answer'>
      <p>0 + 9</p>
      <img src='/src/public_site/media/games/check.png' class='icon' />
    </div>
  */
  for (let i = 0; i < answers.length; i++) {
    const answerElement = document.createElement("div");
    answerElement.classList.add("answer");
    const equationElement = document.createElement("p");
    equationElement.innerText = answers[i][0] + " + " + answers[i][1];
    const mark = document.createElement("img");
    mark.classList.add("icon");

    // if answer is correct
    if (answers[i][2] == 1) {
      mark.src = "/src/public_site/media/games/check.png";

      // if answer is wrong
    } else if (answers[i][2] == 0) {
      mark.src = "/src/public_site/media/games/times.png";
    }

    answersElement.appendChild(answerElement);
    answerElement.appendChild(equationElement);
    answerElement.appendChild(mark);
  }
};

const startGame = () => {
  randomizeSum();
  startTimer();
};

const randomizeSum = () => {
  const randomInt = getRandomInt(9);
  gameAdditionSumElement.innerText = randomInt;
};

const startTimer = () => {
  startTime = new Date();
  timerInterval = setInterval(updateTimer, 1000);
};

const updateTimer = () => {
  const currentTime = new Date();
  const elapsedTime = Math.floor((currentTime - startTime) / 1000);

  const timeElement = document.getElementById("time-left");

  const timer = 60 - elapsedTime;

  timeElement.innerText = "00:" + timer;

  // When time runs out
  if (timer < 0) {
    clearInterval(timerInterval);
    endGame();
  }
};

const endGame = () => {
  ElementDisplay.change("game-content", "none");
  ElementDisplay.change("game-end-content", "block");

  const expectedSumElement = document.getElementById("expected-sum");
  expectedSumElement.innerText = gameAdditionSumElement.innerText

  displayTheCorrectAnswers();
  displayScore();
};

const displayTheCorrectAnswers = () => {
  const correctAnswersElement = document.getElementById("game-correct-answers");

  /*
    <div class='answer'>
      <p>0 + 9</p>
      <img src='/src/public_site/media/games/check.png' class='icon' />
    </div>
  */
  const expectedSum = document.getElementById("expected-sum").innerText;
  let j = expectedSum;
  for (let i = 0; i <= expectedSum; i++) {
    const answerElement = document.createElement("div");
    answerElement.classList.add("answer");
    const equationElement = document.createElement("p");
    equationElement.innerText = i + " + " + j;
    const mark = document.createElement("img");
    mark.classList.add("icon");

    correctAnswersElement.appendChild(answerElement);
    answerElement.appendChild(equationElement);
    answerElement.appendChild(mark);

    for (let k = 0; k < answers.length; k++) {
      if (answers[k][0] === i && answers[k][1] === j) {
        mark.src = "/src/public_site/media/games/check.png";
      }
    }

    j--;
  }
};

const displayScore = () => {
  const scoreElement = document.getElementById("game-score");

  const expectedSum = document.getElementById("expected-sum").innerText;
  const scoreBeforeWrongAnswers = ((Math.ceil(expectedSum / 2)) / amountOfCorrectAnswers) * 100;
  const currentTime = new Date();
  const elapsedTime = Math.floor((currentTime - startTime) / 1000);
  const timeScore = 60 - elapsedTime;
  score = timeScore == 0 ? Math.floor(scoreBeforeWrongAnswers - amountOfWrongAnswers) : Math.floor(((scoreBeforeWrongAnswers - amountOfWrongAnswers) * timeScore) / 100);

  scoreElement.innerText = score;
};

gameAnswerBtn.addEventListener("click", submitAnswer);
startGameBtn.addEventListener("click", startGame);
endGameBtn.addEventListener("click", endGame);
