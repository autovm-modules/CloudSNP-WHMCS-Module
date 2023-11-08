<?php

use WHMCS\Database\Capsule;
use PG\Request\Request;
use WHMCS\User\Client;

function autovm_get_resselertoken_baseurl(){
    // find Module aparams
    try {
        $moduleparams = Capsule::table('tbladdonmodules')->get();
        foreach ($moduleparams as $item) {
            if($item->module == 'cloudsnp'){
                if($item->setting == 'BackendUrl'){
                    $BackendUrl = $item->value;
                }
                
                if($item->setting == 'ResellerToken'){
                    $ResellerToken = $item->value;
                }
            }
        }
    } catch (\Exception $e) {
        echo "Can not find module params table in database";
    }

    $arr = array(
        'ResellerToken' => $ResellerToken,
        'BackendUrl' => $BackendUrl
    );

    return $arr;
}


function autovm_create_user($client)
{
    $infos = autovm_get_resselertoken_baseurl();
    $ResellerToken = $infos['ResellerToken'];
    $BackendUrl = $infos['BackendUrl'];

    $params = [
        'name' => $client->fullName, 'email' => $client->email
    ];

    $headers = ['token' =>  $ResellerToken];

    $address = [
        $BackendUrl, 'admin', 'reseller', 'user', 'create'
    ];

    return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();
}


function autovm_get_user_token($userId)
{
    $params = ['userId' => $userId];

    $user = Capsule::selectOne('SELECT token FROM autovm_user WHERE user_id = :userId', $params);

    // The first value
    return current($user);
}

add_hook('ClientAreaPage', 100, function($params) {

    // Find client
    $clientId = autovm_get_session('uid');

    if (empty($clientId)) {
        return false; // We dont need to log anything here
    }

    // Find client
    $client = Client::find($clientId);

    if (empty($client)) {
        return false; // We dont need to log anything here
    }

    // Find token
    $token = autovm_get_user_token($clientId);

    if ($token) {
        return false; // We dont need to log anything here
    }

    // Create user in AutoVM
    $response = autovm_create_user($client);

    if (empty($response)) {
        return false; // We dont need to log anything here
    }

    $message = property_exists($response, 'message');

    if ($message) {
        return false; // We dont need to log anything here
    }

    $user = $response->data;

    // Save token in WHMCS
    $params = ['user_id' => $client->id, 'token' => $user->token];

    Capsule::table('autovm_user')
        ->insert($params);
});




