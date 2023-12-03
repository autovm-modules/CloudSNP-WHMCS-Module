<?php 

// Check the cookies
if (isset($_COOKIE['temlangcookie'])) {
    $langFromCookies = $_COOKIE['temlangcookie'];
    if($langFromCookies == 'English' || $langFromCookies == 'Farsi' || $langFromCookies == 'Turkish' || $langFromCookies == 'Russian' || $langFromCookies == 'Deutsch' || $langFromCookies == 'French' || $langFromCookies == 'Brizilian' || $langFromCookies == 'Italian'){
      $templatelang = $langFromCookies;
    } else {
      $templatelang = 'English';
    }
  }


?>