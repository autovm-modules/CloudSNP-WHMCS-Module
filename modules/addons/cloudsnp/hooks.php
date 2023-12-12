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
            if($item->module == 'cloudsnp'){
                if($item->setting == 'ResellerBackendUrl'){
                    $ResellerBackendUrl = $item->value;
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

    if(empty($ResellerBackendUrl)){
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

    if(isset($ResellerToken) && isset($ResellerBackendUrl) && isset($DefLang)){
        $response['ResellerToken'] = $ResellerToken;
        $response['ResellerBackendUrl'] = $ResellerBackendUrl;
        $response['DefLang'] = $DefLang;
        return $response;
    } 
}

// Create user and record user token
function cloudsnp_create_user($ResellerBackendUrl, $ResellerToken, $client)
{
    $params = [
        'name' => $client->fullName, 'email' => $client->email
    ];

    $headers = ['token' =>  $ResellerToken];

    $address = [
        $ResellerBackendUrl, 'admin', 'reseller', 'user', 'create'
    ];

    return Request::instance()->setAddress($address)->setHeaders($headers)->setParams($params)->getResponse()->asObject();

}


function cloudsnp_get_user_token_from_database($WhUserId)
{
    $params = ['userId' => $WhUserId];
    $user = Capsule::selectOne('SELECT token FROM autovm_snp_user WHERE user_id = :userId', $params);
    return current($user);
}


function admin_handel_usertoken($ResellerBackendUrl, $ResellerToken, $WhUserId)
{
    try {
        // Find client info
        $client = Client::find($WhUserId);
        if (empty($client)) {
            return false; // We dont need to log anything here
        }

        // Find token in database
        $token = cloudsnp_get_user_token_from_database($WhUserId);

        // Create user in AutoVM if there is no token in data base
        if (empty($token)) {
            $response = cloudsnp_create_user($ResellerBackendUrl, $ResellerToken, $client);

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

            $answer = Capsule::table('autovm_snp_user')->insert($params);

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


function admin_autovm_set_language($lang){
    if(empty($lang)){
        $lang = 'English';
    }

    if(($lang != 'English' && $lang != 'Farsi' && $lang != 'Turkish' && $lang != 'Russian' && $lang != 'Deutsch' && $lang != 'French' && $lang != 'Brizilian' && $lang != 'Italian')){
        $lang = 'English';
    }

    if(!empty($lang)){
        if(empty($_COOKIE['temlangcookie']) && !headers_sent()) {
            setcookie('temlangcookie', $lang, time() + (86400 * 30 * 12), '/');
        }
    }
}


// Admin side: Hook to generate user and token in data base for cloud
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

    if(isset($response['ResellerToken']) && isset($response['ResellerBackendUrl']) && isset($response['DefLang'])){
        $ResellerToken = $response['ResellerToken'];
        $ResellerBackendUrl = $response['ResellerBackendUrl'];
        $DefLang = $response['DefLang'];
    }

    // get Default Language
    admin_autovm_set_language($DefLang);



    // Writing user token
    $WhUserId = $vars['userid'];
    if(isset($WhUserId) && isset($ResellerBackendUrl)){
        $response = admin_handel_usertoken($ResellerBackendUrl, $ResellerToken, $WhUserId);
    }

    if(!$response){
        echo('handle did not work');
        return false;
    }


    $userToken = cloudsnp_get_user_token_from_database($WhUserId);

    if(isset($WhUserId) && isset($userToken) && isset($ResellerBackendUrl) && isset($ResellerToken)){
        $controller = new AdminSnpController($WhUserId, $userToken, $ResellerBackendUrl, $ResellerToken);
        if(isset($_GET['method'])){
            $controller->handle($_GET['method']);
        }
    } else {
        echo "Can not find token in database";
    }


    $PersonalRootDirectoryURL = '';
    $link = $PersonalRootDirectoryURL . '/modules/addons/cloudsnp/views/autovm/admin.php?userid=' . $WhUserId;

    $value = '<iframe src="' . $link . '" class="autovm"></iframe><style type="text/css"> .autovm{width: 100%; height: 400px;border: none;}</style>';
    
    return $value;
}); 
 


// Client side: Hook to generate user and token in data base for cloud
add_hook('ClientAreaPage', 100, function($params) {
    $response =  autovm_get_ResellerToken_baseurl_admin();
    if(!empty($response['error'])){
        return false;
    } 

    if(!empty($response['message'])){
        return false;
    }
    
    if(isset($response['ResellerToken']) && isset($response['ResellerBackendUrl'])){
        $ResellerToken = $response['ResellerToken'];
        $ResellerBackendUrl = $response['ResellerBackendUrl'];
    }
    
    admin_autovm_set_language($DefLang);

    // create token if cloud is active
    if(!empty($ResellerToken) && !empty($ResellerBackendUrl)){
        
        $clientId = autovm_get_session('uid');
        if (empty($clientId)) { 
            return false;
        }
    

        $client = Client::find($clientId);
        if(empty($client)) {
            echo('can not find the client');
            return false;
        }


        $token = cloudsnp_get_user_token_from_database($clientId);
        if($token) {
            return false;
        }


        // create new user if can not find Token
        $CreateResponse = cloudsnp_create_user($ResellerBackendUrl, $ResellerToken, $client);
        if(empty($CreateResponse)) {
            return false;
        }


        $message = property_exists($CreateResponse, 'message');
        if($message) {
            return false;
        }


        $user = $CreateResponse->data;

        // Save token in WHMCS
        $params = ['user_id' => $client->id, 'token' => $user->token];

        Capsule::table('autovm_snp_user')
            ->insert($params);
            
    } else {
        return false;
    }
});