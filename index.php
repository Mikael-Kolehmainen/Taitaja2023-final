<?php

use public_site\controller\ErrorController;
use public_site\controller\GameController;
use public_site\controller\HomeController;
use api\manager\ServerRequestManager;
use public_site\controller\UserController;

require __DIR__ . "/src/inc/bootstrap.php";

session_start();

$uri = ServerRequestManager::getUriParts();

/*
  We want to have a clean file if we're doing an AJAX request from JavaScript
  because otherwise it will throw an error.
*/
if ($uri[2] != "ajax") {

  // These could be considered general configurations that we want on every page.
  echo "
    <!DOCTYPE html>
    <html>
      <head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='icon' type='image/x-icon' href='/src/public_site/media/icons/favicon.svg'>
        <link href='/src/public_site/styles/css/main.css' rel='stylesheet' type='text/css'>
        <script src='/src/public_site/js/ElementDisplay.js' defer></script>
  ";
}

// We can determine which page to show from the url like this: index.php/$uri[2].
switch ($uri[2]) {
  /*
    We call a function that is defind below depending on how the url looks,
    then the function will call a controller for that specific page and show
    the page from there.
  */
  case "":
    showHome();
    break;
  case "game":
    showGame();
    break;
  case "login":
    showLogInPage();
    break;
  case "create":
    showCreateUserPage();
    break;
  case "create-user":
    if (ServerRequestManager::isPost()) {
      createUser();
    }
    break;
  case "login-user":
    if (ServerRequestManager::isPost()) {
      logInUser();
    }
    break;
  case "logout-user":
    logOutUser();
    break;
  case "peli_1":
    showPlayableGame();
    break;
  case "intra":
    showIntraPage();
    break;
  case "edit-user-details":
    editUserDetails();
    break;
  case "delete-user":
    deleteUser();
    break;
  case "soft-delete-user":
    softDeleteUser();
    break;
  case "error":
    showError("Error title", "This is the error page.", "/index.php");
    break;
  default:
    showError(
      "404 Not Found",
      "The page you're looking for doesn't exist.",
      "/index.php"
    );
    exit();
}

if ($uri[2] != "ajax") {
  echo "
      </body>
    </html>
  ";
}

/* THE FUNCTIONS */

function showHome(): void
{
  $homeController = new HomeController();
  $homeController->showHomePage();
}

function showGame(): void
{
  $gameController = new GameController();
  $gameController->showGamePage();
}

function showLogInPage(): void
{
  $userController = new UserController();
  $userController->showLogin();
}

function showCreateUserPage(): void
{
  $userController = new UserController();
  $userController->showCreate();
}

function createUser(): void
{
  $userController = new UserController();
  $userController->createUser();
}

function logInUser(): void
{
  $userController = new UserController();
  $userController->logInUser();
}

function logOutUser(): void
{
  $userController = new UserController();
  $userController->logOutUser();
}

function showPlayableGame(): void
{
  $gameController = new GameController();
  $gameController->showPlayableGame();
}

function showIntraPage(): void
{
  $userController = new UserController();
  $userController->showIntra();
}

function editUserDetails(): void
{
  $userController = new UserController();
  $userController->editUserDetail();
}

function deleteUser(): void
{
  $userController = new UserController();
  $userController->deleteUser();
}

function softDeleteUser(): void
{
  $userController = new UserController();
  $userController->softDeleteUser();
}

/**
 * @param string $title
 * @param string $message
 * @param string $link
 */
function showError($title, $message, $link): void
{
  $errorController = new ErrorController($title, $message, $link);
  $errorController->showErrorPage();
}
