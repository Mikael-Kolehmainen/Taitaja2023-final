<?php

namespace api\manager;

/*
  This is the ServerRequestManager which serves function that use $_SERVER, $_POST,
  $_GET, etc. constants. For example isPost() which returns a true/false depending
  on if the REQUEST_METHOD is POST or not.
*/
class ServerRequestManager
{
  private const REQUEST_METHOD = "REQUEST_METHOD";
  private const POST = "POST";
  private const GET = "GET";
  private const USER_ID = "userid";
  private const IS_GAME = "isgame";
  private const USERNAME = "username";
  private const PASSWORD = "password";
  private const FLName = "flname";
  private const EMAIL = "email";
  private const PHONE = "phone";
  private const REQUEST_URI = "REQUEST_URI";

  public static function isPost(): bool
  {
    return $_SERVER[self::REQUEST_METHOD] == self::POST;
  }

  public static function isGet(): bool
  {
    return $_SERVER[self::REQUEST_METHOD] == self::GET;
  }

  public static function issetUserId(): bool
  {
    return isset($_GET[self::USER_ID]);
  }

  public static function getUserId(): int
  {
    return $_GET[self::USER_ID];
  }

  public static function issetIsGame(): bool
  {
    return isset($_GET[self::IS_GAME]);
  }

  public static function issetUsername(): bool
  {
    return isset($_POST[self::USERNAME]);
  }

  public static function postUsername(): string
  {
    return $_POST[self::USERNAME];
  }

  public static function postPassword(): string
  {
    return $_POST[self::PASSWORD];
  }

  public static function postFLName(): string
  {
    return $_POST[self::FLName];
  }

  public static function issetEmail(): bool
  {
    return isset($_POST[self::EMAIL]);
  }

  public static function postEmail(): string
  {
    return $_POST[self::EMAIL];
  }

  public static function issetPhone(): bool
  {
    return isset($_POST[self::PHONE]);
  }

  public static function postPhone(): string
  {
    return $_POST[self::PHONE];
  }

  /**
   * @return array<string>|bool
   */
  public static function getUriParts()
  {
    $uri = parse_url($_SERVER[self::REQUEST_URI], PHP_URL_PATH);
    return explode('/', $uri);
  }
}
