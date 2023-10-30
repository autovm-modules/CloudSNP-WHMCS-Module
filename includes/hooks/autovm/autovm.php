<?php

use WHMCS\Service\Service;
use WHMCS\User\Client;

$path = dirname(__FILE__);

require $path . '/vendor/autoload.php';

function autovm_has_array($name, $array)
{
    if (array_key_exists($name, $array)) {

        return true;
    }

    return false;
}

function autovm_get_array($name, $array)
{
    if (autovm_has_array($name, $array)) {

        return $array[$name];
    }

    return null;
}

function autovm_has_query($name)
{
    if (autovm_has_array($name, $_GET)) {

        return true;
    }

    return false;
}

function autovm_get_query($name)
{
    if (autovm_has_query($name)) {

        return $_GET[$name];
    }

    return null;
}

function autovm_has_post($name)
{
    if (autovm_has_array($name, $_POST)) {

        return true;
    }

    return false;
}

function autovm_get_post($name)
{
    if (autovm_has_post($name)) {

        return $_POST[$name];
    }

    return null;
}

function autovm_get_post_array($names)
{
    $params = [];

    foreach($names as $name) {

        $params[$name] = autovm_get_post($name);
    }

    return $params;
}

function autovm_has_session($name)
{
    if (array_key_exists($name, $_SESSION)) {

        return true;
    }

    return false;
}

function autovm_get_session($name)
{
    if (autovm_has_session($name)) {

        return $_SESSION[$name];
    }

    return null;
}

function autovm_generate_string($length = 10)
{
    $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';

    $result = '';

    for ($i=0; $i<$length; $i++) {

        $result .= $chars[mt_rand(0, strlen($chars)-1)];
    }

    return $result;
}

// Find the service identity
$serviceId = autovm_get_query('avmServiceId');

// Find action
$action = autovm_get_query('avmAction');

// Find the current logged in client
$client = autovm_get_session('uid');

if ($client) {

    $client = Client::find($client);

    if ($client) {

        $service = $client->services()->find($serviceId);
    }
}

// Find the current logged in admin
$admin = autovm_get_session('adminid');

if ($admin) {

    $service = Service::find($serviceId);
}

// Handle AutoVM requests
if ($service) {

    $controller = new AVMController($service->id);

    $controller->handle($action);
}
