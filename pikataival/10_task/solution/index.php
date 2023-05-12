<?php

function primeNumberChecker($num)
{
  if ($num == 1)
  return 0;
  for ($i = 2; $i <= $num/2; $i++)
  {
    if ($num % $i == 0)
    return 0;
  }
  return 1;
}

echo primeNumberChecker(4);
