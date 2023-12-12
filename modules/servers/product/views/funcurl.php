<?php
include_once('config.php');

$id=0;

if(isset($service['id'])){
    $id = $service['id'];
}

if($id == 0){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    
    if(isset($_GET['productselect'])){
        $id = $_GET['productselect'];
    }
}


$u = 'client';

if(isset($_GET['u']) && $_GET['u'] == 'admin'){
    $u = 'admin';
} else {
    $u = 'client';
}





// create Backlink URL Client from config
if($DefaultClientBackLink){
    $BackLinkClient = $DefaultClientBackLink;
} else {
    $BackLinkClient = '/clientarea.php?action=productdetails';
}

// create Backlink URL Admin
if($DefaultAdminBackLink){
    $BackLinkAdmin = $DefaultAdminBackLink;
} else {
    $BackLinkAdmin = '/admin/clientsservices.php';
}
?>