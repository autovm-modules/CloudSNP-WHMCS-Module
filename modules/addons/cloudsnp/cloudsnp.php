<?php

$path = dirname(__FILE__);

require $path . '/CloudSnpController.php';

// Set Module parameters, name, describ or so ..
function cloudsnp_config()
{
    $configarray = array(
        "name" => "Cloud SNP",
        "description" => "Cloud SNP Module By AutoVM",
        "version" => "V01.00.00",
        "author" => "autovm.net",
        "fields" => array(
            "BackendUrl" => array ("FriendlyName" => "Backend Url", "Type" => "text", "Size" => "45", "Description" => "insert backedn Url with http", "Default" => "http://backend.autovm.online"),
            "ResellerToken" => array ("FriendlyName" => "Admin Token", "Type" => "text", "Size" => "25", "Description" => "you should insert your token here", "Default" => ""),
            "DefLang" => array ("FriendlyName" => "Default Language", "Type" => "dropdown", "Options" => "English, Farsi, Turkish, Russian, Deutsch, French", "Description" => "Select a language as default language for admin and users panel", "Default" => "en",),
        ));
        return $configarray;

}

// Run in client Page to start controller class [CloudController]
function cloudsnp_clientarea($vars)
{

    // get BackendUrl from admin
    if (array_key_exists('BackendUrl', $vars)) {
        $BackendUrl = $vars['BackendUrl'];
        if($BackendUrl == ''){
            echo('Base Url is empty');
        }
    } else {
        echo('go to addons module and insert your backend adrress');
    }
    
    // get ResellerToken from admin
    if (array_key_exists('ResellerToken', $vars)) {
        $ResellerToken = $vars['ResellerToken'];
        if($ResellerToken == ''){
            echo('token is empty');
        }
    } else {
        echo('go to addons module and insert your Token');
    }

    // get Default Language
    $DefLang = 'English';
    if (array_key_exists('DefLang', $vars)) {
        $DefLang = $vars['DefLang'];
        if($DefLang != ''){
            if (!isset($_COOKIE['temlangcookie'])) {
                 setcookie('temlangcookie', $DefLang, time() + (86400 * 30 * 12), '/');
            }
        } else {
            setcookie('temlangcookie', 'English', time() + (86400 * 30 * 12), '/');
        }
    } else {
        setcookie('temlangcookie', 'English', time() + (86400 * 30 * 12), '/');
    }


    
    // Find action
    $action = autovm_get_query('action');

    // Find the current logged in client
    $clientId = autovm_get_session('uid');

    if ($clientId) {
        $controller = new CloudSnpController($clientId, $ResellerToken, $BackendUrl);
        return $controller->handle($action);
    }
}

// Show in admin panel in addon menu page
function cloudsnp_output($vars) {

    $description = '
                    <p>
                        Cloud SNP is a module to facilitate connection to AUTOVM Backend from WHMCS to have a smart way to easily manage your clients and their machines within WHMCS environment.
                    </p>';
    echo($description);

    $version = $vars['version'];
    $text = '<h5> Version : ' . $version . '</h5>';
    echo($text);
    
    
    $BackendUrl = $vars['BackendUrl'];
    $text = '<h5> Backend URL : ' . $BackendUrl . '</h5>';
    echo($text);
    
    $Token = $vars['ResellerToken'];
    $text = '<h5> Admin Token : ' . $Token . '</h5>';
    echo($text);
    
    $lang = $vars['DefLang'];
    $text = '<h5> Default Language : ' . $lang . '</h5>';
    echo($text);
    
}