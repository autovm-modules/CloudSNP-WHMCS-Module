<?php  include('./includes/commodules/config.php');   ?>
<?php  include('./includes/commodules/lang.php');   ?>

<!doctype html>    
    <html lang="<?php echo($templatelang) ?>" <?php if($templatelang == 'Farsi'){ echo("dir='rtl'"); } ?> style="font-size: 0.8em !important; background-color: #ff000000" !important;>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Global Cloud</title>
        <script src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        

        <style>
            [v-cloak] { display: none; }
            .border {border-color: #ededed !important;}
            @media (min-width: 1400px) { .mycontainer{padding: 77px 51px !important;} }
        </style>

        
        <!-- RTL Persian BOOTSTRAP -->
        <?php if ($templatelang == 'Farsi'): ?>
            <link href="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/css/bootstrap.rtl.min.css" rel="stylesheet">
            <link href="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/style.css" rel="stylesheet">
            <style> * {font-family: 'Vazirmatn' !important;}</style>
        
        <?php else: ?> 
            <link href="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/css/bootstrap.min.css" rel="stylesheet">    
            <!-- FONT: Plus Jakarta Sans  -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300&display=swap" rel="stylesheet">
            <style> * {font-family: 'Plus Jakarta Sans', sans-serif !important;}</style>
        <?php endif ?>
        <!-- END RTL  -->

    </head>
        















