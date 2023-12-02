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


function autovm_get_ResellerToken_baseurl_admin(){
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

// Create user and record user token
function admin_create_user($BackendUrl, $ResellerToken, $client)
{
    $params = [
        'name' => $client->fullName, 'email' => $client->email
    ];

    $headers = ['token' =>  $ResellerToken];

    $address = [
        $BackendUrl, 'admin', 'reseller', 'user', 'create'
    ];

    return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();

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
    
    $response = autovm_get_ResellerToken_baseurl_admin();
    if(!empty($response['error'])){
        echo($response['error']);
        return false;
    }
    
    if(!empty($response['message'])){
        echo($response['message']);
        return false;
    }

    if(isset($response['ResellerToken']) && isset($response['BackendUrl']) && isset($response['DefLang'])){
        $ResellerToken = $response['ResellerToken'];
        $BackendUrl = $response['BackendUrl'];
        $DefLang = $response['DefLang'];
    }






    // get Default Language
    if(empty($DefLang)){
        $DefLang = 'English';
    }

    if(($DefLang != 'English' && $DefLang != 'Farsi' && $DefLang != 'Turkish' && $DefLang != 'Russian' && $DefLang != 'Deutsch' && $DefLang != 'French' && $DefLang != 'Brizilian' && $DefLang != 'Italian')){
        $DefLang = 'English';
    }

    if(!empty($DefLang)){
        if(empty($_COOKIE['temlangcookie']) && !headers_sent()) {
            setcookie('temlangcookie', $DefLang, time() + (86400 * 30 * 12), '/');
        }
    }


    





    // Writing user token
    $WhUserId = $vars['userid'];
    if(isset($WhUserId) && isset($BackendUrl)){
        $response = admin_handel_usertoken($BackendUrl, $ResellerToken, $WhUserId);
    }

    if(!$response){
        echo('handle did not work');
        return false;
    }




    $userToken = admin_get_user_token_from_database($WhUserId);

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
 

