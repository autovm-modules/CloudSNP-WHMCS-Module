<?php include_once('modalcharge.php'); ?>
<?php include_once('successmodal.php'); ?>
<?php include_once('failmodal.php'); ?>

<?php 
    if(isset($DefaultChargeModuleEnable) && $DefaultChargeModuleEnable){
        $ChargeModuleEnable = true;
    } else {
        $ChargeModuleEnable = false;
    }


    if(isset($DefaultChargeModuleDetailsViews) && $DefaultChargeModuleDetailsViews){
        $ChargeModuleDetailsViews = true;
    } else {
        $ChargeModuleDetailsViews = false;
    }



    if(empty($CloudTopupLink)){
        $CloudTopupLink = '/clientarea.php?action=addfunds';
    }
?>  



<div class="mt-5 px-3 px-md-4 mb-5">
    <p class="m-0 p-0 h3 fw-bolder text-dark d-block d-md-none">{{ lang('cloudaccount') }}</p>
</div>
<div class="d-flex flex-row justify-content-between align-items-end px-3 px-md-4">
    <div class="">
        <p class="m-0 p-0 h3 fw-bolder text-dark mt-5 d-none d-md-block">{{ lang('cloudaccount') }}</p>
    </div>
    <div class="d-flex flex-row justify-content-between align-items-end">
        <div class="me-2">
            <a class="btn btn-outline-primary px-3 py-2" @click="opencreatepage">{{ lang('createmachine') }}</a>
        </div>
        <?php if($ChargeModuleEnable): ?> 
            <div class="me-2">
                <h2 class="accordion-header">
                    <button class="btn btn-outline-primary collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <i class="bi bi-coin pe-2"></i> 
                    <span>{{ lang('finance') }}</span>
                    </button>
                </h2>
            </div>
        <?php endif ?>
        <?php if(!$ChargeModuleEnable): ?> 
            <a class="btn btn-outline-primary collapsed py-2 me-2" target="_top" type="button" href="<?php echo($CloudTopupLink); ?>">{{ lang('topup') }}</a>
        <?php endif ?>
        <div class="btn bg-primary text-dark d-flex flex-row justify-content-center align-items-center p-0" style="--bs-bg-opacity: 0.2">
            <?php include('./includes/commodules/langbtn.php'); ?>
        </div>
    </div>
</div>
<div class="row px-1">
    <div class="col-12">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="row accordion-body justify-content-center">
                        <div class="row align-items-center justify-content-start m-0 p-0 py-4 px-0 px-md-3">  
                            <!-- Account Balance -->
                            <div class="col-12 col-md-7 col-lg-6 m-0 p-0 mb-2">
                                <?php include('balanceview.php'); ?>
                            </div>
                            <?php if($ChargeModuleEnable): ?> 
                                <!-- Credit -->                        
                                <div class="col-12 col-md-5 col-lg-6 m-0 p-0 mb-2">
                                    <div class="d-flex flex-row align-items-center justify-content-between border border-2 rounded-4 bg-body-secondary py-4 px-3 px-lg-4 px-xl-5 ms-0 ms-md-2">
                                        <?php include('showcredit.php'); ?>
                                        <div class="m-0 p-0">
                                            <a class="btn btn-primary" target="_top" type="button" href="<?php echo($CloudTopupLink); ?>">
                                                {{ lang('topup') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




