const startGameBtn = document.getElementById("start-game-btn");
const noLogInBtn = document.getElementById("no-log-in-btn");

const switchToGameView = () => {
  ElementDisplay.change("welcome-content", "none");
  ElementDisplay.change("game-content", "block");
};

const switchToWelcomeView = () => {
  ElementDisplay.change("game-login", "none");
  ElementDisplay.change("welcome-content", "block");
};

startGameBtn.addEventListener("click", switchToGameView);
noLogInBtn.addEventListener("click", switchToWelcomeView);
