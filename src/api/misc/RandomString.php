<?php

namespace api\misc;

/*
  This class has a static function that returns a chosen length random string
  from alphanumeric values.
*/
class RandomString
{
  /**
   * @param int $lengthOfString
   * @return string
   */
  public static function getRandomString($lengthOfString): string
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $lengthOfString; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $randomString .= $characters[$index];
    }

    return $randomString;
  }
}
