<?php
use WHMCS\Database\Capsule;
use PG\Request\Request;
use WHMCS\User\Client;


add_hook('ClientAreaPrimaryNavbar', 1, function($primaryNavbar) {
    /** @var \WHMCS\View\Menu\Item $primaryNavbar */
    $newMenu = $primaryNavbar->addChild(
        'uniqueMenuItemName',
        array(
            'name' => 'Global Cloud',
            'label' => 'Global Cloud',
            'uri' => '/index.php?m=cloudsnp&action=pageIndex',
            'order' => 99,
            'icon' => '',
        )
    );
});

function admin_create_user($BackendUrl, $ResellerToken, $client)
{
    $params = [
        'name' => $client->fullName, 'email' => $client->email
    ];

    $address = [
        $BackendUrl, 'candy', 'frontend', 'auth', 'token', 'register'
    ];

    return Request::instance()->setAddress($address)->setParams($params)->getResponse()->asObject();
}

function admin_get_user_token_from_database($WhUserId)
{
    $params = ['userId' => $WhUserId];
    $user = Capsule::selectOne('SELECT token FROM autovm_user WHERE user_id = :userId', $params);
    return current($user);
}

function admin_handel_usertoken($BackendUrl, $ResellerToken, $WhUserId)
{
    try {
        // Find client info
        $client = Client::find($WhUserId);
        if (empty($client)) {
            echo('can not find client');
            return false; // We dont need to log anything here
        }

        // Find token in database
        $token = admin_get_user_token_from_database($WhUserId);

        // Create user in AutoVM if there is no token in data base
        if (empty($token)) {
            $response = admin_create_user($BackendUrl, $ResellerToken, $client);

            if (empty($response)) {
                echo('can not connect to backend');
                return false; // We dont need to log anything here
            }

            $message = property_exists($response, 'message');
            if ($message) {
                echo('error accured, Err: ');
                echo($response->message);
                return false; // We dont need to log anything here
            }

            // Save token
            $user = $response->data;
            $params = ['user_id' => $client->id, 'token' => $user->token];

            $answer = Capsule::table('autovm_user')->insert($params);

            if($answer){
                return true;
            } else {
                echo('can not able to insert user token');
                return false;
            }

        } else {
            return true;
        }
    } catch (\Exception $e) {
        echo "handle user token failed : ";
        echo($e);
        return false;
    }
}


add_hook('AdminAreaClientSummaryPage', 1, function($vars) {
    include ('adminsnpcontroller.php');
    $WhUserId = $vars['userid'];


    $BackendUrl = null;
    $ResellerToke = null;


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
    


    
    $response = admin_handel_usertoken($BackendUrl, $ResellerToken, $WhUserId);

    if(!$response){
        echo('handle did not work');
        return false;
    }


    
    // find user token
    try {
        $userTable = Capsule::table('autovm_user')->get();
        foreach ($userTable as $item) {
            if($item->user_id == $WhUserId){
                $userToken = $item->token;
            }
        }
    } catch (\Exception $e) {
        echo "Can not find autovm_user table in database";
    }
    
    
    if(isset($WhUserId) && isset($userToken) && isset($BackendUrl) && isset($ResellerToken)){
        $controller = new AdminSnpController($WhUserId, $userToken, $BackendUrl, $ResellerToken);
        if(isset($_GET['method'])){
            $controller->handle($_GET['method']);
        }
    } else {
        echo "Can not find token in database";
    }

    

    
    $link = '/modules/addons/cloudsnp/views/autovm/adminpanel.php?userid=' . $WhUserId;

    $value = '<iframe src="' . $link . '" class="autovm"></iframe><style type="text/css"> .autovm{width: 1200px;height: 600px;border: none;}</style>';
    
    return $value;
}); 
 

