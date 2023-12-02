<?php  include('./includes/commodules/header.php');   ?>

<body>
<!-- main container -->
<div class="machineapp container-fluid p-4 my-5" style="max-width: 1350px; padding-bottom: 200px !important;" v-cloak>
    <?php  include('./includes/commodules/backflash.php');     ?>
    <div class="row bg-white border border-1 border-secondar rounded-4 py-5 my-5 px-2 px-md-4 px-lg-5">
        <?php  include('./includes/machineparts/modalaction.php');      ?>
        <?php  include('./includes/machineparts/modalconsole.php');     ?>
        <?php  include('./includes/machineparts/modalprocessing.php');  ?>
        <?php  include('./includes/machineparts/modalsetup.php');       ?>
        <?php  include('./includes/machineparts/modaldestroy.php');     ?>
        <?php  include('./includes/machineparts/hoststatus.php');       ?>
        <?php  include('./includes/machineparts/machinedetails.php');   ?>
        <?php  include('./includes/machineparts/login.php');            ?>
        <?php  include('./includes/machineparts/circlures.php');        ?>
        <?php  include('./includes/machineparts/access.php');           ?>
    </div>
</div>
<?php  include('./includes/commodules/footer.php');           ?>