<?php

$path = dirname(__FILE__);

require $path . '/controller.php';

function cloud_config()
{
    return ['name' => 'AutoVM Cloud', 'version' => 'dev', 'author' => 'autovm.net'];
}

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