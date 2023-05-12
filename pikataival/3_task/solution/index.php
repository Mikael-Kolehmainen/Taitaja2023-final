<?php

echo "
<form method='POST' action='index.php'>
<input type='email' name='email'>
<input type='submit' value='submit'>
</form>";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"];

  $domain = explode('@', $email);
  $domain = explode('.', $domain[1]);
  echo $domain[0];
}
