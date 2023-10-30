<?php  include('./includes/commodules/lang.php');     ?>
<?php  include('./includes/commodules/config.php');   ?>
<?php  include('./includes/commodules/currency.php'); ?>
<?php  include('./includes/commodules/header.php');   ?>

<body class="container-fluid m-0 p-0" style="background-color: #ff000000 !important;">

<div class="row py-5" >
    <div class="adminapp col-12">
        <div class="bg-body-secondary rounded-4 border border-2 border-body-secondary p-3 p-md-4 p-lg-5" v-cloak>
            <div class="accordion" id="accordionExample">
                <a class="h5 text-primary text-decoration-none px-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Click to see User account on Cloud
                    <i class="h5 ps-3 bi bi-chevron-bar-down"></i>
                </a>
                <div id="collapseOne" class="accordion-collapse collapse mt-4" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                    <div v-if="userLoadStatus != null" class="row">
                        <!-- User Details -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="bg-light rounded-4 border border-2 border-body-secondary px-3 px-md-4 py-4 py-md-5" style="height: 400px;">
                                <div class="row pb-4">
                                    <div class="col-12">
                                        <p class="h5">
                                            {{ lang('userdetailautovm') }}
                                        </p>
                                    </div>
                                </div>
                                <div v-if="userLoadStatus != null" class="row">
                                    <div v-if="userLoadStatus == 'fine'" class="col-12 lh-sm">
                                        <div v-if="userName != null" class="input-group my-2">
                                            <span class="input-group-text text-start bg-body-secondary text-dark p-0 m-0 px-3" style="--bs-bg-opacity: 0.3; width: 130px;">
                                                {{ lang('username') }}
                                            </span>
                                            <input class="form-control bg-light text-start" :value="userName" style="max-width: 350px;" disabled>
                                        </div>
                                        <div v-if="userEmail != null" class="input-group my-2">
                                            <span class="input-group-text text-start bg-body-secondary text-dark p-0 m-0 px-3" style="--bs-bg-opacity: 0.3; width: 130px;">
                                                {{ lang('email') }}
                                            </span>
                                            <input class="form-control bg-light text-start" :value="userEmail" style="max-width: 350px;" disabled>
                                        </div>
                                    </div>

                                    <div v-if="userLoadStatus == 'empty'" class="m-0 p-0">
                                        <p>
                                            {{ lang('cannotfinduserid') }}
                                        </p>
                                        <p v-if="msg">
                                            {{msg}}
                                        </p>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div v-if="userLoadStatus == 'fine'" class="col-12 lh-sm">
                                        <div v-if="userCreditinWhmcs != null" class="input-group my-2">
                                            <span class="input-group-text text-start bg-body-secondary text-dark p-0 m-0 px-3" style="--bs-bg-opacity: 0.3; width: 130px;">
                                                {{ lang('accountcredit') }}
                                            </span>
                                            <input class="form-control bg-light text-start" :value="userCreditinWhmcs" style="max-width: 250px;" disabled>
                                            <input class="form-control bg-body-secondary text-start" :placeholder="userCurrencySymbolFromWhmcs" style="max-width: 100px;" disabled>
                                        </div>
                                        <div v-if="userBalance != null" class="input-group my-2">
                                            <span class="input-group-text text-start bg-body-secondary text-dark p-0 m-0 px-3" style="--bs-bg-opacity: 0.3; width: 130px;">
                                                {{ lang('cloudbalance') }}
                                            </span>
                                            <input class="form-control bg-light text-start" :value="userBalance" style="max-width: 250px;" disabled>
                                            <input class="form-control bg-body-secondary text-start" :placeholder="config.AutovmCurrency" style="max-width: 100px;" disabled>
                                        </div>
                                        <div class="text-primary" v-if="userBalance != null && CurrenciesRatioCloudToWhmcs != null && CurrenciesRatioCloudToWhmcs != 1" style="margin: 10px 10px 10px 130px">
                                            <span>
                                                <span class="px-2">≈</span>
                                                <span>
                                                    {{ ConverFromAutoVmToWhmcs(userBalance).toLocaleString() }} 
                                                </span>
                                                <span class="px-2">
                                                    {{ userCurrencySymbolFromWhmcs }}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- User Details -->
                        
                        <!-- User Balance -->
                        <div class="col-12 col-md-6 mb-3">
                            <div class="bg-light rounded-4 border border-2 border-body-secondary px-3 px-md-4 py-4 py-md-5" style="height: 400px;">
                                <div class="row pb-4">
                                    <div class="col-12">
                                        <p class="h5">
                                            {{ lang('adjustusebalance') }}
                                        </p>
                                    </div>
                                </div>
                                <div v-if="userLoadStatus != null" class="row">
                                    <div v-if="userLoadStatus == 'fine'" class="col-12 lh-sm">
                                        <div v-if="userBalance != null" class="input-group my-2">
                                            <span class="input-group-text text-start bg-body-secondary text-dark p-0 m-0 px-3" style="--bs-bg-opacity: 0.3; width: 200px;">{{ lang('currentbalanceautovm') }}</span>
                                            <input class="form-control bg-light text-start" :placeholder="userBalance" style="min-width: 180px;" disabled>
                                            <input class="form-control bg-body-secondary text-start" :placeholder="config.AutovmCurrency" style="max-width: 100px;" disabled>
                                        </div> 
                                        <div v-if="userBalance != null" class="input-group my-2">
                                            <span class="input-group-text text-start bg-primary text-dark p-0 m-0 px-3" style="--bs-bg-opacity: 0.3; width: 200px;">{{ lang('addorremove') }}</span>
                                            <input v-model="chargeAmountAdminInput" class="form-control bg-light text-start" type="number" aria-label="clientbalance" aria-describedby="clientbalance" style="min-width: 180px;" placeholder="±99">
                                            <input class="form-control bg-body-secondary text-start" :placeholder="config.AutovmCurrency" style="max-width: 100px;" disabled>
                                        </div>
                                        <div class="row mb-4 ps-2">
                                            <div class="col-12">
                                                <p class="small text-primary" style="--bs-text-opacity: 0.8;">
                                                    {{ lang('useminnuestoreduce') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div v-if="userBalance != null && AdminClickOnTrans != true && chargeAmountAdminInput != null" class="d-flex flex-row justify-content-between mt-5">
                                            <span v-if="chargeAmountAdminInput" class="text-primary">
                                                <span class="px-2">≈</span>
                                                <span>
                                                    {{ ConverFromAutoVmToWhmcs(chargeAmountAdminInput).toLocaleString() }}
                                                </span>
                                                <span class="px-2">
                                                    {{ userCurrencySymbolFromWhmcs }}
                                                </span>
                                            </span>
                                            <a v-if="!chargeAmountAdminInputisvalide && chargeAmountAdminInput" class="btn btn-secondary">
                                                <span>
                                                    {{ lang('error') }}
                                                </span>
                                            </a>
                                            <a v-else-if="chargeAmountAdminInputisvalide && chargeAmountAdminInput > 0" @click="chargeCloudAdmin" class="btn btn-primary">
                                                <span>
                                                    {{ lang('increase') }}
                                                </span>
                                                <span class="px-1">( {{ chargeAmountAdminInput }}</span>
                                                <span class="px-1">{{ config.AutovmCurrency }} )</span>
                                            </a>
                                            <a v-else-if="chargeAmountAdminInputisvalide && chargeAmountAdminInput < 0" @click="chargeCloudAdmin" class="btn btn-danger">
                                                <span>
                                                    {{ lang('decrease') }}
                                                </span>
                                                <span class="px-1">( {{ chargeAmountAdminInput }}</span>
                                                <span class="px-1">{{ config.AutovmCurrency }} )</span>
                                            </a>
                                        </div>
                                        <div class="row d-flex flex-row justify-content-start align-items-center">
                                            <div v-if="AdminClickOnTrans && AdminTransSuccess == null" class="pt-5">
                                                <span class="text-primary">
                                                    <?php include('./includes/commodules/threespinner.php'); ?>
                                                </span>
                                            </div>
                                            <div v-if="AdminTransSuccess != null" class="pt-5">
                                                <div class="p-0 m-0" v-if="AdminTransSuccess">
                                                    <p class="text-primary small">
                                                        <span>
                                                            {{ lang('transid') }} = {{ adminTransId }}, 
                                                        </span>
                                                        <span>
                                                            {{ lang('hasrecordedsuccessfully') }}
                                                        </span>
                                                    </p>
                                                    <p class="alert alert-primary small py-2">
                                                        {{ lang('ittakesminutes') }}
                                                    </p>
                                                </div>
                                                <span class="alert alert-danger small py-2" v-if="!AdminTransSuccess">
                                                    {{ lang('anerroroccurred') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="userLoadStatus == 'empty'" class="m-0 p-0">
                                        <p>
                                            {{ lang('cannotfinduserid') }}
                                        </p>
                                        <p v-if="msg">
                                            {{msg}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="d-flex flex-row align-items-center text-primary h4 ps-4 mt-4" >
                        <div class="">
                            {{ lang('loadingmsg') }}
                        </div>
                        <div class="m-0 p-0 ps-2">
                            <?php include('./includes/commodules/threespinner.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./includes/commodules/footer.php'); ?>