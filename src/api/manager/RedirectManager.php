<?php

namespace api\manager;

class RedirectManager
{
  public static function redirectToLogin(): void
  {
    echo "
      <script>
        alert('Salasana tai käyttäjätunnus on väärin');
        window.location.replace('/index.php/login');
      </script>
    ";
  }

  public static function redirectToLoginIfNotAdmin(): void
  {
    echo "
      <script>
        alert('Ette ole ylläpitäjä, joten ette voi poistaa käyttäjää.');
        window.location.repalce('/index.php/login');
      </script>
    ";
  }

  public static function redirectToIntraIfNoUserId(): void
  {
    echo "
      <script>
        alert('Käyttäjä id:että ei olle määritelty.');
        window.location.replace('/index.php/intra');
      </script>
    ";
  }

  public static function redirectToIntraIfUserRemoved(): void
  {
    echo "
      <script>
        alert('Käyttäjä poistettu tietokannasta.');
        window.location.replace('/index.php/intra');
      </script>
    ";
  }

  public static function redirectToIntraOnCreation(): void
  {
    echo "
      <script>
        alert('Käyttäjä on luotu.');
        window.location.replace('/index.php/intra');
      </script>
    ";
  }

  public static function redirectToIntraOnUpdateOfUserDetails(): void
  {
    echo "
      <script>
        alert('Tiedot on päivitetty tietokannassa.');
        window.location.replace('/index.php/intra');
      </script>
    ";
  }

  public static function redirectToIntra(): void
  {
    echo "
      <script>
        window.location.replace('/index.php/intra');
      </script>
    ";
  }

  public static function redirectToLoginInvalidSession(): void
  {
    echo "
      <script>
        alert('Istuntosi on vanhentunut, kirjaudu sisään uudestaan.');
        window.location.replace('/index.php/login');
      </script>
    ";
  }

  public static function redirectToHomePageAfterLogOut(): void
  {
    echo "
      <script>
        alert('Ulos kirjautuminen onnistui.');
        window.location.replace('/index.php/');
      </script>
    ";
  }

  public static function redirectToHomePageAfterSoftDelete(): void
  {
    echo "
      <script>
        alert('Käyttäjä on poistettu.');
        window.location.replace('/index.php/');
      </script>
    ";
  }

  public static function redirectToGame(): void
  {
    echo "
      <script>
        alert('Kirjautuminen onnistui.');
        window.location.replace('/index.php/peli_1/?gameid=1');
      </script>
    ";
  }
}
