<?php 

// Defaul if hook does not not work
$defLangadmin = 'English';


// Check the cookies
if (isset($_COOKIE['temlangcookie'])) {
    $templatelang = $_COOKIE['temlangcookie'];
} else {
    setcookie('temlangcookie', $defLangadmin, time() + (86400 * 30 * 12), '/');     
    $templatelang = $defLangadmin;
}



?>