<?php
use WHMCS\Database\Capsule;
use PG\Request\Request;
use WHMCS\User\Client;


add_hook('ClientAreaPrimaryNavbar', 1, function($primaryNavbar) {
    /** @var \WHMCS\View\Menu\Item $primaryNavbar */
    $newMenu = $primaryNavbar->addChild(
        'uniqueMenuItemName',
        array(
            'name' => 'Cloud SNP',
            'label' => 'Cloud SNP',
            'uri' => '/index.php?m=cloud&action=pageIndex',
            'order' => 99,
            'icon' => '',
        )
    );
});


add_hook('AdminAreaClientSummaryPage', 1, function($vars) {
    include ('admincontroller.php');
    
    $WhUserId = $vars['userid'];
    
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
    
    
    if(isset($userToken)){
        $controller = new admincontroller($userToken, $WhUserId);
        if(isset($_GET['method'])){
            $controller->handle($_GET['method']);
        }
    } else {
        echo "Can not find token in database";
    }

    
    $link = '/modules/addons/cloud/views/autovm/adminpanel.php?userid=' . $WhUserId;

    $value = '<iframe src="' . $link . '" class="autovm"></iframe><style type="text/css"> .autovm{width: 1200px;height: 600px;border: none;}</style>';
    
    return $value;
}); 
 

