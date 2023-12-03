<!-- Different -->

<?php

// Include the configuration file
$configFilePath = __DIR__ . '/vitalvariable.php';
$configArray = file_exists($configFilePath) ? include($configFilePath) : array();




// Show both currency from client side and cloud side
if(isset($configArray['ShowExchange'])){
    if($configArray['ShowExchange'] == 'option1'){
        $ShowExchange = 'on';
    } else {
        $ShowExchange = 'off';
    }
} else {
    $ShowExchange = 'off';
}



// Use Charge module to handle user credit and balance
if(isset($configArray['ChargeModuleEnable'])){
    if($configArray['ChargeModuleEnable'] == 'option1'){
        $ChargeModuleEnable = 'on';
    } else {
        $ChargeModuleEnable = 'off';
    }
} else {
    $ChargeModuleEnable = 'off';
}




/* TopUp Link */
if(isset($configArray['TopupLink'])){
    $CloudTopupLink = $PersonalRootDirectoryURL . $configArray['TopupLink'];
} else {
    $CloudTopupLink = $PersonalRootDirectoryURL . '/clientarea.php?action=addfunds';
}



// Define config variables
if(isset($ChargeModuleEnable) && $ChargeModuleEnable == 'off'){
    $DefaultChargeModuleEnable = false;
} else {
    $DefaultChargeModuleEnable = true;
}


if(isset($ShowExchange) && $ShowExchange == 'on'){
    $DefaultChargeModuleDetailsViews = true;
} else {
    $DefaultChargeModuleDetailsViews = false;
}

?>