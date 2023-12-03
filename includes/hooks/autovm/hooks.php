<?php

use WHMCS\Database\Capsule;
use PG\Request\Request;
use WHMCS\User\Client;

function autovm_create_user($client)
{
    $infos = autovm_get_ResellerToken_baseurl_client();
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
    return current($user);
}


function autovm_get_ResellerToken_baseurl_client(){
    $response = [];

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
        $error = 'Database ERR ===> Client: Can not find module params table in database';
        $response['error'] = $error;
        return $response;
    }

    if(empty($BackendUrl)){
        $message = 'Backend URL ERR ===> Go to addons module and insert your backend adrress';
        $response['message'] = $message;
        return $response;
    }
    
    if(empty($ResellerToken)){
        $message = 'Reseller Token ERR ===> Go to addons module and insert your Token';
        $response['message'] = $message;
        return $response;
    }
   
    if(empty($DefLang)){
        $message = 'Defaul Language ERR ===> Go to addons module and select a language';
        $response['message'] = $message;
        return $response;
    }

    if(isset($ResellerToken) && isset($BackendUrl) && isset($DefLang)){
        $response['ResellerToken'] = $ResellerToken;
        $response['BackendUrl'] = $BackendUrl;
        $response['DefLang'] = $DefLang;
        return $response;
    } 
}


add_hook('ClientAreaPage', 100, function($params) {
    $response =  autovm_get_ResellerToken_baseurl_client();
    
    if(!empty($response['error'])){
        return false;
    }
    
    if(!empty($response['message'])){
        return false;
    }

    if(isset($response['ResellerToken']) && isset($response['BackendUrl'])){
        $ResellerToken = $response['ResellerToken'];
        $BackendUrl = $response['BackendUrl'];
    }

    // create token if have infos
    if(!empty($ResellerToken) && !empty($BackendUrl)){
        
        $clientId = autovm_get_session('uid');
        if (empty($clientId)) {
            return false;
        }

        $client = Client::find($clientId);
        if (empty($client)) {
            echo('can not find the client');
            return false;
        }

        // Find token
        $token = autovm_get_user_token($clientId);
        if ($token) {
            return false;
        }

        // create new user if can not find Token
        $CreateResponse = autovm_create_user($client);
        if (empty($CreateResponse)) {
            return false;
        }

        $message = property_exists($CreateResponse, 'message');
        if ($message) {
            return false;
        }

        $user = $CreateResponse->data;

        // Save token in WHMCS
        $params = ['user_id' => $client->id, 'token' => $user->token];

        Capsule::table('autovm_user')
            ->insert($params);

    } else {
        return false;
    }















    
});




