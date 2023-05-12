<?php

namespace public_site\controller;
use api\manager\SessionManager;

/*
  This is the HeaderController, its main function is to show the header of the
  website.
*/
class HeaderController
{
  public function showHeader(): void
  {
    echo "
        <script src='/src/public_site/js/mobileResponsiveFooter.js' defer></script>
        <script src='/src/public_site/js/mobileResponsiveness.js' defer></script>
      </head>
      <header>
        <div class='col'>
          <div class='row'>
            <a href='/index.php'>
              <img src='/src/public_site/media/logo/oppidoo_logo.png' alt='The logo of Oppidoo' />
            </a>
          </div>
          <div class='row'>
            <nav>
              <a href='#'>Opetus</a>
              <a href='#'>Blogi</a>
              <a href='/index.php/game'>Pelit</a>
            </nav>
          </div>
        </div>
      </header>
    ";
  }

  public function showGamesHeader(): void
  {
    echo "
        <script src='/src/public_site/js/mobileResponsiveFooter.js' defer></script>
      </head>
      <header class='games-header'>
        <div class='col'>
          <div class='row'>
            <a href='/index.php'>
              <img src='/src/public_site/media/logo/oppidoo_logo_white.png' alt='The logo of Oppidoo' />
            </a>
          </div>
          <div class='row'>
            <nav>
              <a href='#'>Opetus</a>
              <a href='#'>Blogi</a>
              <a href='/index.php/game' class='active'>Pelit</a>";

    $this->showLoggedInOrNot();

    echo   "</nav>
          </div>
        </div>
      </header>
    ";
  }

  // Header should show if user is logged in or not & name if logged in.
  private function showLoggedInOrNot(): void
  {
    $userController = new UserController();

    if (!$userController->isValidSession()) {
      echo "<a href='/index.php/login' class='btn'>Kirjaudu</a>";
    } else {
      $user = $userController->getUserWithSession();
      echo "
        <p>$user->username</p>
        <a href='/index.php/logout-user' class='btn'>Kirjaudu ulos</a>
      ";
    }
  }
}
