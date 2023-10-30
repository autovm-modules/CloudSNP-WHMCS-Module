<?php

use WHMCS\Database\Capsule;

function autovm_config()
{
    return ['name' => 'AutoVM', 'version' => 'dev', 'author' => 'autovm.net'];
}

function autovm_activate()
{
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
