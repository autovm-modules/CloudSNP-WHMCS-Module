<?php

$path = dirname(__FILE__);

require $path . '/CloudController.php';

// Set Module parameters, name, describ or so ..
function cloud_config()
{
    $configarray = array(
        "name" => "AutoVM SNP",
        "description" => "AutoVM cloud module for SNP",
        "version" => "V01.00.02",
        "author" => "autovm.net",
        "fields" => array(
            "option" => array ("FriendlyName" => "option", "Type" => "text", "Size" => "25", "Description" => "Textbox", "Default" => "Example"),
        ));
        return $configarray;

}

// Run in client Page to start controller class [CloudController]
function cloud_clientarea()
{
    // Find action
    $action = autovm_get_query('action');

    // Find the current logged in client
    $clientId = autovm_get_session('uid');

    if ($clientId) {

        $controller = new CloudController($clientId);

        return $controller->handle($action);
    }
}

// Show in admin panel in addon menu page
function cloud_output($vars) {
    
    $version = $vars['version'];
    $text = '<h5> Version : ' . $version . '</h5>';
    echo($text);
    
    
    $option = $vars['option'];
    $text = '<h5> Option : ' . $option . '</h5>';
    echo($text);


    $description = '
                    <br>
                    <h2>Description : </h2>
                    <p>
                        This module is called SNP Cloud, you can connect to AUTOVM Backend with WHMCS and manage your client and their machines bith in this environment.
                    </p>';
    echo($description);
}