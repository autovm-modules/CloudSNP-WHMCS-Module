<?php include_once('funwritecookies.php'); ?>
<?php include_once('funcurl.php');         ?>
<?php include_once('config.php');          ?>


<style type="text/css">

    .mybtn {
        color: #fff !important;
        background-color: #337ab7 !important;
        border-color: #2e6da4 !important;
        padding:  15px 40px !important;
        border-radius: 10px !important;
        font-size: 15px !important;
    }


    .myiframe{
        width: 100%;
        height: 800px;
        border: 2px solid #8181814a;
        border-radius: 10px;
        padding: 0px;
        max-width: 1300px;
    }

</style>



<div style="padding: 20px 20px !important; color: #333232 !important;">
    <!-- check the page, error within the admin page -->
    <?php if ($id > 0): ?>
        <iframe src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/broverview.php?id=<?php echo($id); ?>&u=admin" title="AutoVM" class="myiframe"></iframe>
    <?php else : ?>
        <a href="/admin/index.php?rp=/admin/services" class="btn btn-primary mt-4 float-end mybtn">
            <i class="bi bi-pc-display-horizontal me-3"></i> 
            <span>Go to Services to see the details</span>
        </a>
    <?php endif ?>
</div>
