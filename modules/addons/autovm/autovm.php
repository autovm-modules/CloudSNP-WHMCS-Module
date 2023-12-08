<?php

use WHMCS\Database\Capsule;

function autovm_config()
{  
    $BackendUrlLabel = '<span style="padding-left: 30px">Insert your Backend Address, started with http, default is "https://api.cloudsnp.net"</span>';
    $ResellerTokenLabel = '<span style="padding-left: 30px">Insert your Reseller Token here, as an Example "de8fs953k49ho3ellg9x", You can request for your Reseller Token on "https://my.cloudsnp.net/"</span>';
    $DefLangLabel = '<span style="padding-left: 30px">Select a language as default language for admin and users panel, this language setting is for AutoVM Module and has nothing to do with WHMCS language setting</span>';    
    
    $configarray = array(
        "name" => "AutoVM",
        "description" => "Main AutoVM Module",
        "version" => "V05.10.02",
        "author" => "autovm.net",
        "fields" => array(
            "BackendUrl" => array ("FriendlyName" => "Backend Url", "Type" => "text", "Size" => "31", "Description" => $BackendUrlLabel, "Default" => "https://api.cloudsnp.net"),
            "ResellerToken" => array ("FriendlyName" => "Reseller Token", "Type" => "text", "Size" => "31", "Description" => $ResellerTokenLabel, "Default" => "xxxx"),
            "DefLang" => array ("FriendlyName" => "Default Language", "Type" => "dropdown", "Options" => "English, Farsi, Turkish, Russian, Deutsch, French, Brizilian, Italian", "Description" => $DefLangLabel, "Default" => "English"),
        ));
        return $configarray;
}


function autovm_activate()
{
    autovm_get_ResellerToken_baseurl_autovm();

    $hasTable = Capsule::schema()->hasTable('autovm_user');

    if (empty($hasTable)) {

        Capsule::schema()->create('autovm_user', function ($table) {

            $table->increments('id');
            $table->string('user_id');
            $table->string('token');
        });
    }

    $hasTable = Capsule::schema()->hasTable('autovm_order');

    if (empty($hasTable)) {

        Capsule::schema()->create('autovm_order', function ($table) {

            $table->increments('id');
            $table->string('order_id');
            $table->string('machine_id');
        });
    }
}


// Get Token From AutoVm module
function autovm_get_ResellerToken_baseurl_autovm(){
    $response = [];

    // find Module aparams
    try {
        $moduleparams = Capsule::table('tbladdonmodules')->get();
        foreach ($moduleparams as $item) {
            if($item->module == 'autovm'){
                if($item->setting == 'BackendUrl'){
                    $BackendUrl = $item->value;
                }
                
                if($item->setting == 'ResellerToken'){
                    $ResellerToken = $item->value;
                }
                
                if($item->setting == 'DefLang'){
                    $DefLang = $item->value;
                }
            }
        }
    } catch (\Exception $e) {
        $message = "Database ERR ===> AutoVM: Can not find module params table in database";
        $response['message'] = $message;
        return $response;
    }

    if(empty($BackendUrl)){
        $message = "Backend URL ERR ===> Go to addons module and insert your backend adrress";
        $response['message'] = $message;
        return $response;
    }
    
    if(empty($ResellerToken)){
        $message = "Admin Token ERR ===> Go to addons module and insert your Token";
        $response['message'] = $message;
        return $response;
    }

    // get Default Language
    if(empty($DefLang)){
        $DefLang = 'English';
    }
    
    if(($DefLang != 'English' && $DefLang != 'Farsi' && $DefLang != 'Turkish' && $DefLang != 'Russian' && $DefLang != 'Deutsch' && $DefLang != 'French' && $DefLang != 'Brizilian' && $DefLang != 'Italian')){
        $DefLang = 'English';
    }

    if(!empty($DefLang)){
        if(empty($_COOKIE['temlangcookie'])) {
            setcookie('temlangcookie', $DefLang, time() + (86400 * 30 * 12), '/');
        }
    }

    
    if($ResellerToken && $BackendUrl && $DefLang){
        $response['ResellerToken'] = $ResellerToken;
        $response['BackendUrl'] = $BackendUrl;
        $response['DefLang'] = $DefLang;
        return $response;
    }
    
}


// Show in admin panel in addon menu page
function autovm_output($vars) {
 
    $response = autovm_get_ResellerToken_baseurl_autovm();    
    
    if(!empty($response['DefLang'])){
        $DefLang = $response['DefLang'];
    } else {
        $DefLang = 'English';
    }
 
    
    $version = $vars['version'];
    if(!empty($version)){
        $text = '<h2> Version : ' . $version . '</h2><h3>Language : ' .  $DefLang . '</h3>';
        echo($text);
    }


    $text = '
        <p style="padding: 50px 0px 0px 0px; !important">
        <span style="font-weight: 800 !important;">AutoVM Module</span> is a specialized module designed by <a href="https://AutoVM.net/" style="font-weight: 800 !important;" target="_blank">AutoVM</a> to streamline the connection between the AutoVM Backend and WHMCS.
        </p>';
    echo($text);

    
    
    $text = '
        <p>
        You can always get the latest version from the <a href="https://github.com/AutoVM-modules/AutoVM-WHMCS-Modules" style="font-weight: 800 !important;" target="_blank">AutoVM git repository</a>
        </p>
        <p>
        To learn how to use AutoVM modules, please check out the <a href="https://AutoVM.net/docs/" style="font-weight: 800 !important;" target="_blank"> AutoVM documentation page</a>
        </p>
        ';
    echo($text);

    
    if(!empty($response['message'])){
        echo('<pre style="padding: 20px 20px 20px 20px; margin: 30px 0px 30px 0px">');
        print_r($response['message']);
        echo('</pre>');
    } 
}

add_hook('AddonConfigSave', 1, function($vars) {
    autovm_get_ResellerToken_baseurl_autovm();
});
