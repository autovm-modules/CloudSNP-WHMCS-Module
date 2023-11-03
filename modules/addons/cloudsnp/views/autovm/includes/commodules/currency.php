<!-- Same as cloud, it wont use anywhere -->
<!-- include adrress is different -->

<?php  include('config.php');   ?>
<?php

// Set a value that can be shown the error
$cloudCurrency = "Ω";


// list of currency symbels
$currenciesList = [ '$' , '€' , '£' , '¥' , '₽' , '₺'];

// Get Default value from Config 
if(isset($CloudDefaulCurrency)){
    $cloudCurrency = $CloudDefaulCurrency;
}



// Set the direction to show currency, if persian and Rial and Toman
$currencyIsRial = false;


if(!in_array($cloudCurrency, $currenciesList)){
    $currencyIsRial = true;
}
  
?>