<!-- Same as cloud -->
<!-- include adrress is different -->

<?php  include('config.php');   ?>
<?php 

$defLangadmin = 'en';

// Defaul value from Config 
if(isset($CloudDefaulLanguage)){
  $defLangadmin = $CloudDefaulLanguage;
} else {
  $defLangadmin = 'en';
}

// Acceptable language list
$LangList = [ 'en' , 'fa' , 'tr' , 'fr' , 'ru' , 'du'];


// Change def language of is not valid
if(!in_array($defLangadmin, $LangList)){

  $defLangadmin = 'en';
  
} 


// set a default for page language
$templatelang = $defLangadmin; 



// Check the cookies
if (isset($_COOKIE['temlangcookie'])) {

    $templatelang = $_COOKIE['temlangcookie'];
    
} else {
    
    setcookie('temlangcookie', $defLangadmin, time() + (86400 * 30 * 12), '/'); 
    
}





// redirect the page with new language
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $thisid = $_POST['thisid'];

  // Handle the form submission and update the cookie
  $newLanguage = $_POST['language'];
  setcookie('temlangcookie', $newLanguage, time() + (86400 * 30), '/');
  
  // Reload the page to reflect the updated cookie
  header('Location: ' . $_SERVER['PHP_SELF']. '?id=' . $thisid);
  
  exit;
}



?>