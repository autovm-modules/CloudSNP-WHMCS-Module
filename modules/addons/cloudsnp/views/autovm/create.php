<?php  include('routeconfig.php');   ?>
<?php  include('./includes/commodules/header.php');   ?>

<body class="container-fluid p-1 p-md-3" style="background-color: #ff000000 !important;" > 
<div id="createapp" class="row px-1 px-md-4 px-lg-5 py-5 mx-auto" style="max-width: 1500px; padding-bottom: 200px !important;">
    <div class="" v-cloak>
        <?php  include('./includes/createparts/modalcreate.php');  ?>
        <?php  include('./includes/commodules/backflash.php');     ?>
        <div class="col-12 bg-white rounded-4 border border-2 border-body-secondary m-0 p-0 mt-5" >
            <div class="py-5 px-4 px-md-5">
                <!-- lang BTN     -->
                <div class="row float-end d-none d-md-block">
                    <div class="col-auto btn bg-primary text-dark m-0 p-0" style="--bs-bg-opacity: 0.2">
                        <?php  include('./includes/commodules/langbtn.php'); ?>
                    </div>
                </div>
                <?php  include('./includes/createparts/hostname.php');     ?>
                <?php  include('./includes/createparts/datacenter.php');   ?>
                <?php  include('./includes/createparts/plans.php');        ?>
                <div class="row">
                    <div class="col-12 col-lg-7 m-0 p-0">
                        <?php  include('./includes/createparts/configuration.php');?>
                    </div>
                    <div class="col-12 col-lg-5 m-0 p-0">
                        <?php  include('./includes/createparts/billsammery.php');?>
                    </div>
                </div>
                <?php  include('./includes/createparts/sshkey.php');       ?>
                <?php  include('./includes/createparts/setos.php');        ?>
                <?php  include('./includes/createparts/createbtn.php');    ?>
            </div>
        </div>
    </div>
</div>
<?php include('./includes/commodules/footer.php'); ?>