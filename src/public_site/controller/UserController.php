<?php

namespace public_site\controller;

use api\manager\RedirectManager;
use api\manager\ServerRequestManager;
use api\manager\SessionManager;
use api\misc\RandomString;
use api\model\Database;
use api\model\UserModel;

/*
  This is the UserController, it handles the users both admin & player, the
  controller also handles showing the login page & create user page.
*/
class UserController
{
  /** @var int */
  public $id;

  /** @var Database */
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  // Shows login form.
  public function showLogin(): void
  {
    echo "
      <div class='login-bg'>
        <section class='box'>
          <div class='content'>
            <form method='POST' action='/index.php/login-user'>
              <input type='text' name='username' minlength=4 maxlength=60 placeholder='käyttäjätunnus' required />
              <input type='password' name='password' minlength=8 maxlength=65536 placeholder='salasana' required />
              <input type='submit' value='Kirjaudu' class='btn' />
            </form>
            <p>Uusi käyttäjä?</p>
            <a href='/index.php/create' class='btn'>Luo uusi käyttäjä</a>
          </div>
        </section>
      </div>
    ";
  }

  // Shows create user form.
  public function showCreate(): void
  {
    echo "
      <div class='login-bg'>
        <section class='box'>
          <div class='content'>
            <h1>Luo uusi käyttäjä</h1>
            <form method='POST' action='/index.php/create-user'>
              <input type='text' name='username' minlength=4 maxlength=60 placeholder='käyttäjätunnus' required />
              <input type='text' name='flname' placeholder='etu ja sukunimi' />
              <input type='text' name='email' placeholder='email' />
              <input type='text' name='phone' placeholder='puhelinnumero' />
              <input type='password' name='password' minlength=8 maxlength=65536 placeholder='salasana' required />
              <input type='submit' value='Luo käyttäjä' class='btn' />
            </form>
          </div>
        </section>
      </div>
    ";
  }

  // Creates user, inserts user to database & redirects user to intra.
  public function createUser(): void
  {
    if (ServerRequestManager::issetUsername()) {
      $userModel = new UserModel($this->db);
      $userModel->username = ServerRequestManager::postUsername();
      $userModel->phone = ServerRequestManager::postPhone();
      $userModel->email = ServerRequestManager::postEmail();
      $userModel->password = password_hash(ServerRequestManager::postPassword(), PASSWORD_DEFAULT);
      // The first name & last name are given like "Ano Nyymi"
      $firstLastName = preg_split('/\s+/', ServerRequestManager::postFLName());
      $userModel->firstName = $firstLastName[0];
      $userModel->lastName = $firstLastName[1];
      $userModel->userRole = "player";
      $userModel->userSession = RandomString::getRandomString(15);

      $userModel->create();

      SessionManager::saveUserSession($userModel->userSession);

      RedirectManager::redirectToIntraOnCreation();
    }
  }

  public function getUserWithId(): UserModel
  {
    $userModel = new UserModel($this->db);
    $userModel->id = $this->id;

    return $userModel->load();
  }

  public function getUserWithSession(): UserModel
  {
    $userModel = new UserModel($this->db);
    $userModel->userSession = SessionManager::getUserSession();

    return $userModel->loadWithSession();
  }

  // Checks if the username & password exist in the database and redirects the user to the intranet.
  public function logInUser(): void
  {
    if (ServerRequestManager::issetUsername()) {
      $userModel = new UserModel($this->db);
      $userModel->username = ServerRequestManager::postUsername();
      $user = $userModel->loadWithUsername();

      // If user is soft deleted
      if ($user->deleted === 1) {
        RedirectManager::redirectToLogin();
        exit();
      }

      $givenPassword = ServerRequestManager::postPassword();

      if (password_verify($givenPassword, $user->password)) {
        // Save a session for the user
        $userModel->userSession = RandomString::getRandomString(15);
        $userModel->updateUserSession();

        SessionManager::saveUserSession($userModel->userSession);

        if (ServerRequestManager::issetIsGame()) {
          RedirectManager::redirectToGame();
        } else {
          RedirectManager::redirectToIntra();
        }
      }
    }

    // If username couldn't be found or the password is wrong
    RedirectManager::redirectToLogin();
  }

  // Clears the session & redirects to home page.
  public function logOutUser(): void
  {
    SessionManager::clearUserSession();
    RedirectManager::redirectToHomePageAfterLogOut();
  }

  // Deletes the user completely with the id (only allowed with admin rights)
  public function deleteUser(): void
  {
    // If session is invalid, we redirect the user to login again.
    if (!$this->isValidSession()) {
      RedirectManager::redirectToLoginInvalidSession();
      exit();
    }

    $userModel = new UserModel($this->db);
    $userModel->userSession = SessionManager::getUserSession();

    $user = $userModel->loadWithSession();

    // If not admin, we redirect the user to login again.
    if ($user->userRole !== "admin") {
      RedirectManager::redirectToLoginIfNotAdmin();
      exit();
    }

    // If no user Id in url, we redirect to admin page.
    if (!ServerRequestManager::issetUserId()) {
      RedirectManager::redirectToIntraIfNoUserId();
      exit();
    }

    $userModel->id = ServerRequestManager::getUserId();
    $userModel->delete();

    RedirectManager::redirectToIntraIfUserRemoved();
  }

  // Soft deletes the user from the db, adds a marker that it's deleted
  public function softDeleteUser(): void
  {
    // If session is invalid, we redirect the user to login again.
    if (!$this->isValidSession()) {
      RedirectManager::redirectToLoginInvalidSession();
    }

    $userModel = new UserModel($this->db);
    $userModel->userSession = SessionManager::getUserSession();

    $userModel->insertSoftDeleteMarker();

    RedirectManager::redirectToHomePageAfterSoftDelete();
  }

  public function showIntra(): void
  {
    // If session is invalid, we redirect the user to login again.
    if (!$this->isValidSession()) {
      RedirectManager::redirectToLoginInvalidSession();
    }

    $userModel = new UserModel($this->db);
    $userModel->userSession = SessionManager::getUserSession();

    $user = $userModel->loadWithSession();

    if ($user->userRole === "admin") {
      $this->showAdminPage();
    } else if ($user->userRole === "player") {
      $this->showPlayerPage();
    }
  }

  public function isValidSession(): bool
  {
    $userModel = new UserModel($this->db);
    $userModel->userSession = SessionManager::getUserSession();

    $user = $userModel->loadWithSession();

    // If the user doesn't exist in the db
    if (is_null($user->id)) {
      return false;
    }

    // If the user exists but is soft deleted
    if ($user->deleted == 1) {
      return false;
    }

    return true;
  }

  private function showAdminPage(): void
  {
    echo "
        <script src='/src/public_site/js/exportAsCSV.js' defer></script>
      </head>
      <section class='intra'>
        <a href='/index.php/logout-user' class='btn'>Kirjaudu ulos</a>
        <h1>Kaikki käyttäjät</h1>";
        $this->displayAllUsers();
    echo "
        <a href='#' id='export-as-csv-btn' class='btn'>Vie CSV-tiedostona</a>
        <h1>Kaikki peli tulokset</h1>
      </section>
    ";
  }

  // Gets all the users from the UserModel which gets all the users from the db.
  private function displayAllUsers(): void
  {
    $userModel = new UserModel($this->db);
    $users = $userModel->loadAll();

    echo "
      <table id='users-table'>
        <tr>
          <td>id</td>
          <td>username</td>
          <td>first name</td>
          <td>last name</td>
          <td>email</td>
          <td>phone number</td>
          <td>user role</td>
          <td>Pehmeästi poistettu</td>
        </tr>
    ";

    foreach ($users as $user) {
      $userSoftDeleted = $user->deleted === 1 ? "Kyllä" : "Ei";

      echo "
        <tr>
          <td>$user->id</td>
          <td>$user->username</td>
          <td>$user->firstName</td>
          <td>$user->lastName</td>
          <td>$user->email</td>
          <td>$user->phone</td>
          <td>$user->userRole</td>
          <td>$userSoftDeleted</td>
          <td><a href='/index.php/delete-user?userid=$user->id'>Poista käyttäjä</a></td>
        </tr>
      ";
    }

    echo "</table>";
  }

  private function showPlayerPage(): void
  {
    echo "
      <section class='intra'>
        <a href='/index.php/logout-user' class='btn'>Kirjaudu ulos</a>
        <h1>Muokkaa omia tietoja</h1>";
        $this->displayUserDetails();
    echo "
        <a href='/index.php/soft-delete-user'>Poista käyttäjä</a>
      </section>
    ";
  }

  // Shows the details of the currently logged in user
  private function displayUserDetails(): void
  {
    $userModel = new UserModel($this->db);
    $userModel->userSession = SessionManager::getUserSession();

    $user = $userModel->loadWithSession();

    echo "
      <table>
        <tr>
          <td>Käyttäjätunnus</td>
          <td>Sähköposti</td>
          <td>Puhelinnumero</td>
        </tr>
        <tr>
          <td>$user->username</td>
          <td>$user->email</td>
          <td>$user->phone</td>
        </tr>
        <tr>
          <td>
            <form action='/index.php/edit-user-details' method='POST'>
              <input type='text' name='username' placeholder='Uusi käyttäjätunnus' minlength=4 maxlength=60 required />
              <input type='submit' value='Vaihda' />
            </form>
          </td>
          <td>
            <form action='/index.php/edit-user-details' method='POST'>
              <input type='text' name='email' placeholder='Uusi sähköposti' required />
              <input type='submit' value='Vaihda' />
            </form>
          </td>
          <td>
            <form action='/index.php/edit-user-details' method='POST'>
              <input type='text' name='phone' placeholder='Uusi puhelinnumero' required />
              <input type='submit' value='Vaihda' />
            </form>
          </td>
        </tr>
      </table>
    ";
  }

  // Updates the user detail in the db based on which form the user filled then redirects back to the intra page
  public function editUserDetail(): void
  {
    // If session is invalid, we redirect the user to login again.
    if (!$this->isValidSession()) {
      RedirectManager::redirectToLoginInvalidSession();
      exit();
    }

    $userModel = new UserModel($this->db);
    $userModel->userSession = SessionManager::getUserSession();

    if (ServerRequestManager::issetUsername()) {
      $userModel->username = ServerRequestManager::postUsername();
      $userModel->updateUsername();
    } else if (ServerRequestManager::issetEmail()) {
      $userModel->email = ServerRequestManager::postEmail();
      $userModel->updateEmail();
    } else if (ServerRequestManager::issetPhone()) {
      $userModel->phone = ServerRequestManager::postPhone();
      $userModel->updatePhone();
    }

    RedirectManager::redirectToIntraOnUpdateOfUserDetails();
  }
}
