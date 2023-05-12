<?php

namespace public_site\controller;
use api\model\Database;
use api\model\GameModel;

/*
  This is the GameController, its main function is to show the math games on the
  website and the game itself.
*/
class GameController
{
  /** @var Database */
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function showGamePage(): void
  {
    $headerController = new HeaderController();
    $headerController->showGamesHeader();

  echo "
      <section class='game'>
        <article class='intro'>
          <h1>Make Learning Math Fun and Easy with our Engaging Collection of Games.</h1>
          <img src='/src/public_site/media/games-hero.jpg' alt='' />
        </article>
        <article class='games'>
          <div class='search'>
            <input type='text' id='games-search-bar' placeholder='Hae' />
            <select>
              <option value='class-one'>Luokka 1</option>
              <option value='class-two'>Luokka 2</option>
              <option value='class-three'>Luokka 3</option>
              <option value='class-four'>Luokka 4</option>
            </select>
          </div>
          <div class='games-grid'>";

            $this->displayGames();

    echo "
          </div>
          <div class='games-page-switcher'>

          </div>
        </article>
      </section>
    ";

    $footerController = new FooterController();
    $footerController->showFooter();
  }

  private function displayGames(): void
  {
    $gameModel = new GameModel($this->db);
    $games = $gameModel->loadAll();

    foreach ($games as $game) {
      echo "
        <a href='/index.php/peli_1/?gameid=$game->id' class='game-card'>
          <img src='$game->gameImage' alt='Game' />
          <h2>$game->title</h2>
          <p>$game->class</p>
        </a>
      ";
    }
  }

  public function showPlayableGame(): void
  {
    echo "
          <script src='/src/public_site/js/utils.js' defer></script>
          <script src='/src/public_site/js/game/contentHandler.js' defer></script>
          <script src='/src/public_site/js/game/gameHandler.js' defer></script>
        </head>
    ";

    $headerController = new HeaderController();
    $headerController->showGamesHeader();

    echo "
      <section class='playable-game'>
        <article class='game-view'>";

    $this->showLogInFormIfNotLoggedIn();

    echo  "
            <div class='welcome-content'>
              <p>Welcome to the addition challenge game!</p>
              <p>In this game, you will be given a random number between 1 and 10, and your goal is to come up with as many additions with two numbers that add up to the given number. The more additions you can come up with, the higher your score will be! You'll have a limited amount of time to think of as many addition variations as possible, so get ready to put your math skills to the test. </p>
              <p>Are you up for the challenge? Let's begin!</p>
              <a href='#' class='btn' id='start-game-btn'>Start game</a>
            </div>
          </div>
          <div class='addition-game' id='game-content' style='display: none;'>
            <div class='inputs'>
              <input type='number' min='0' max='9' id='first-input' />
              <p class='operator'>+</p>
              <input type='number' min='0' max='9' id='second-input' />
              <p class='operator'>=</p>
              <p id='addition-sum'>9</p>
              <a href='#' class='btn' id='game-answer-btn'>Answer</a>
            </div>
            <div class='side-panel'>
              <p>Your answers</p>
              <div class='answers' id='game-answers'>

              </div>
              <div class='time'>
                <p>Time left</p>
                <p id='time-left'>00:60</p>
              </div>
              <a href='#' class='btn' id='end-game-btn'>STOP</a>
            </div>
          </div>
          <div class='game-end-content' id='game-end-content' style='display: none;'>
            <div class='side-panel'>
              <p>All variations</p>
              <h1 id='expected-sum'></h1>
              <div class='answers' id='game-correct-answers'>

              </div>
              <p>Your score</p>
              <p id='game-score'></p>
            </div>
            <div class='results'>";
    $this->displayScores();
    echo     "
              <a href='/index.php/peli_1/?gameid=1' class='btn' >Play again</a>
              <a href='/index.php/game' class='btn'>Back to games</a>
            </div>
          </div>
        </article>
      </section>
    ";

    $footerController = new FooterController();
    $footerController->showFooter();
  }

  // Shows log in form if session is not vaild.
  private function showLogInFormIfNotLoggedIn(): void
  {
    $userController = new UserController();

    if (!$userController->isValidSession()) {
      echo "
        <section class='box' id='game-login'>
          <div class='content'>
            <form method='POST' action='/index.php/login-user?isgame=true'>
              <input type='text' name='username' minlength=4 maxlength=60 placeholder='käyttäjätunnus' required />
              <input type='password' name='password' minlength=8 maxlength=65536 placeholder='salasana' required />
              <input type='submit' value='Kirjaudu' class='btn' />
            </form>
            <p>Uusi käyttäjä?</p>
            <a href='/index.php/create' class='btn'>Luo uusi käyttäjä</a><br>
            <a href='#' class='btn' id='no-log-in-btn'>En halua kirjautua sisään</a>
          </div>
        </section>
        <div class='welcome-box' id='welcome-content' style='display: none;'>
      ";
    } else {
      echo "<div class='welcome-box' id='welcome-content'>";
    }
  }

  // Displays the top-10 scores in order.
  private function displayScores(): void
  {
    $resultsController = new ResultsController();
    $results = $resultsController->getAll();

    // Sorts based on score
    usort($results, function($a, $b) {return strcmp($a->score, $b->score);});

    echo "<table>";

    $i = 1;
    foreach($results as $result) {
      if ($i <= 10) {
        $userController = new UserController();
        $userController->id = $result->usersId;
        $user = $userController->getUserWithId();

        echo "
        <tr>
          <td>$user->username</td>
          <td>$result->score</td>
        </tr>
        ";
        $i++;
      }
    }

    echo "</table>";
  }
}
