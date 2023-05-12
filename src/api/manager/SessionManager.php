<?php

namespace api\manager;

class SessionManager
{
  private const USER_SESSION = "user_session";

  public static function getUserSession(): string|null
  {
    return $_SESSION[self::USER_SESSION];
  }

  public static function saveUserSession($userSession): void
  {
    $_SESSION[self::USER_SESSION] = $userSession;
  }

  public static function clearUserSession(): void
  {
    unset($_SESSION[self::USER_SESSION]);
  }
}
