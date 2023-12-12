<?php include_once('funwritecookies.php'); ?>
<?php include_once('funcurl.php'); ?>
<?php include_once('config.php');   ?>

<style>
    .myiframe{
        width: 100%;
        height: 800px;
        border: 2px solid #8181814a;
        border-radius: 10px;
        padding: 0px;
        max-width: 1300px;
    }

</style>


<div>
    <iframe src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/broverview.php?id=<?php echo($id); ?>&u=client" title="AutoVM" class="myiframe"></iframe>
</div>

<div style="height:300px"></div>