<?php

use WHMCS\Database\Capsule;
use PG\Request\Request;

function balance_MetaData()
{
    return ['DisplayName' => 'AutoVM Balance'];
}

function balance_ConfigOptions()
{
    return ['amount' => ['FriendlyName' => 'Amount', 'Type' => 'text'], 'type' => ['FriendlyName' => 'Type', 'Type' => 'dropdown', 'Options' => ['balance' => 'Balance', 'gift' => 'Gift']]];
}

function balance_get_user_token($userId)
{
    $params = ['userId' => $userId];

    $user = Capsule::selectOne('SELECT token FROM autovm_user WHERE user_id = :userId', $params);

    // The first value
    if ($user) {
        return current($user);
    }

    return $user;
}

function balance_login($token)
{
    $params = ['token' => $token];

    $address = [
        AUTOVM_BASE, 'candy', 'frontend', 'auth', 'token', 'login'
    ];

    return Request::instance()->setAddress($address)->setParams($params)->getResponse()->asObject();
}

function balance_create($userId, $amount, $type)
{
    $params = [
        'userId' => $userId, 'amount' => $amount, 'type' => $type, 'status' => 'paid'
    ];

    $headers = ['token' => AUTOVM_ADMIN_TOKEN];

    $address = [
        AUTOVM_BASE, 'candy', 'backend', 'trans', 'create'
    ];

    return Request::instance()->setAddress($address)->setParams($params)->setHeaders($headers)->getResponse()->asObject();
}

function balance_CreateAccount($params)
{
    // Find service
    $service = autovm_get_array('model', $params);

    if (!$service) {

        return 'Could not find service';
    }

    // Find amount
    $amount = autovm_get_array('configoption1', $params);

    if (!$amount) {

        return 'Could not find amount';
    }

    // Find type
    $type = autovm_get_array('configoption2', $params);

    if (!$type) {

        return 'Could not find type';
    }

    // Find token
    $token = balance_get_user_token($service->clientId);

    if (!$token) {

        return 'Could not find token';
    }

    // Find user
    $response = balance_login($token);

    if (empty($response)) {

        return 'Could not get response';
    }

    $message = property_exists($response, 'message');

    if ($message) {

        return $response->message;
    }

    $user = $response->data;

    // Create trans
    $response = balance_create($user->id, $amount, $type);

    if (empty($response)) {

        return 'Could not get response';
    }

    $message = property_exists($response, 'message');

    if ($message) {

        return $response->message;
    }

    return 'success';
}