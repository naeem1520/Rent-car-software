<?php

// Function for generate random no
function generateCode ($length = 6)
{
  $vCode = "";
  $possible = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $i = 0;
  while ($i < $length)
  {
   $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
   if (!strstr($vCode, $char))
   {
    $vCode .= $char;
    $i++;
   }
  }
  $vCode = "CAR-".$vCode;
  return $vCode;
}


?>
