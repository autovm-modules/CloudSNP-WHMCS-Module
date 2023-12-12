<?php

add_hook('ClientAreaPageProductsServices', 101, function($params) {

    // Find services
    $services = autovm_get_array('services', $params);

    if (empty($services)) {

        return []; // There are not any services
    }

    // Hide services
    $params['services'] = [];

    foreach($services as $service) {

        $module = autovm_get_array('module', $service);

        if ($module <> 'balance') {

            $params['services'][] = $service;
        }
    }

    return $params;
});
