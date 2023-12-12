<?php

use WHMCS\Database\Capsule;

function traffic_MetaData()
{
    return ['DisplayName' => 'AutoVM Traffic'];
}

function traffic_ConfigOptions()
{
    return ['traffic' => ['FriendlyName' => 'Traffic', 'Type' => 'text'], 'type' => ['FriendlyName' => 'Type', 'Type' => 'dropdown', 'Options' => ['main' => 'Main', 'refresh' => 'Refresh', 'plus' => 'Plus']]];
}

function traffic_CreateAccount($params)
{
    // Find service
    $serviceId = autovm_get_array('serviceid', $params);

    if (empty($serviceId)) {

        return 'Could not find service';
    }

    $controller = new AVMController($serviceId);

    // Find machine
    $machineId = $controller->getMachineIdFromService();

    if (empty($machineId)) {

        return 'Could not find machine';
    }

    $traffic = autovm_get_array('configoption1', $params);

    if (empty($traffic)) {

        return 'Could not find traffic';
    }

    $type = autovm_get_array('configoption2', $params);

    if (empty($type)) {

        return 'Could not find type';
    }

    // Remaining
    $remaining = $controller->getServiceRemaining();

    if (empty($remaining)) {

        // Its not required
    }

    // Duration
    $duration = $controller->getServiceDuration();

    if (empty($duration)) {

        return 'Could not find duration';
    }

    // Send request
    $response = $controller->sendTrafficRequest($machineId, $traffic, $remaining, $duration, $type);

    if (empty($response)) {

        return 'Could not get response';
    }

    $message = property_exists($response, 'message');

    if ($message) {
        return $response->message;
    }

    // Unsuspend
    $suspended = $controller->getServiceSuspended();

    if ($suspended) {

        $params = ['domainstatus' => 'Active'];

        Capsule::table('tblhosting')
            ->whereId($serviceId)
            ->update($params);
    }

    return 'success';
}