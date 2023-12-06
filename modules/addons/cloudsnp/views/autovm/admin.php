<?php  include('routeconfig.php');   ?>
<?php  include_once('./includes/commodules/header.php');   ?>

<body class="container-fluid m-0 p-0" style="background-color: #ff000000 !important;">

<div class="row py-5" >
    <div class="adminapp col-12">
        <div class="bg-body-secondary rounded-4 border border-2 border-body-secondary p-3" v-cloak>
            <div v-if="userLoadStatus != null" class="row">
                
                <!-- User info -->
                <div class="col-12 col-lg-12 col-xxl-4 mb-3 mb-xxl-0">
                    <div class="bg-light rounded-4 border border-2 border-body-secondary px-3 px-md-4 py-4 py-md-5" style="height: 280px;">
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
                                <div v-if="userToken != null" class="input-group my-2">
                                    <span class="input-group-text text-start bg-body-secondary text-dark p-0 m-0 px-3" style="--bs-bg-opacity: 0.3; width: 130px;">
                                        {{ lang('usertoken') }}
                                    </span>
                                    <input class="form-control bg-light text-start" :value="userToken" style="max-width: 350px;" disabled>
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
                </div><!-- User Details -->
                
                <!-- Credit/Balnce -->
                <div class="col-12 col-lg-6 col-xxl-4 mb-3 mb-xxl-0">
                    <div class="bg-light rounded-4 border border-2 border-body-secondary px-3 px-md-4 py-4 py-md-5" style="height: 280px;">
                        <div class="row pb-4">
                            <div class="col-12">
                                <p class="h5">
                                    {{ lang('accountcredit') }} / {{ lang('cloudbalance') }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div v-if="userLoadStatus == 'fine'" class="col-12 lh-sm">
                                <div class="d-flex flex-row align-items-center justify-content-start">
                                    <div v-if="userCreditinWhmcs != null" class="input-group my-2" style="max-width: 410px;">
                                        <span class="input-group-text text-start bg-body-secondary text-dark p-0 m-0 px-3" style="--bs-bg-opacity: 0.3; width: 150px;">
                                            {{ lang('accountcredit') }}
                                        </span>
                                        <input class="form-control bg-light text-start" :value="showCreditWhmcsUnit(userCreditinWhmcs)" style="max-width: 160px;" disabled>
                                        <input class="form-control bg-body-secondary text-center" :placeholder="userCurrencySymbolFromWhmcs" style="max-width: 70px;" disabled>
                                    </div>
                                    <div class="" v-if="userCreditinWhmcs != null && CurrenciesRatioCloudToWhmcs != null && CurrenciesRatioCloudToWhmcs != 1">
                                        <span class="text-primary">
                                            <span>
                                                ≈
                                            </span>
                                            <span>
                                                {{ showCreditCloudUnit(ConverFromWhmcsToCloud(userCreditinWhmcs)) }} {{ config.AutovmDefaultCurrencySymbol }}
                                            </span>
                                        </span>    
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="input-group my-2" style="max-width: 410px;">
                                        <span class="input-group-text text-start bg-body-secondary text-dark p-0 m-0 px-3" style="--bs-bg-opacity: 0.3; width: 150px;">
                                            {{ lang('cloudbalance') }}
                                        </span>
                                        <input class="form-control bg-light text-start" :value="showBalanceWhmcsUnit(ConverFromAutoVmToWhmcs(userBalance))" style="max-width: 160px;" disabled>
                                        <input class="form-control bg-body-secondary text-center" :placeholder="userCurrencySymbolFromWhmcs" style="max-width: 70px;" disabled>
                                    </div>
                                    <div class="" v-if="userCreditinWhmcs != null && CurrenciesRatioCloudToWhmcs != null && CurrenciesRatioCloudToWhmcs != 1">
                                        <span class="text-primary">
                                            <span>
                                                ≈
                                            </span>
                                            <span>
                                                {{ showBalanceCloudUnit(userBalance) }} {{ config.AutovmDefaultCurrencySymbol }}
                                            </span>
                                        </span>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- transaction -->
                <div class="col-12 col-lg-6 col-xxl-4">
                    <div class="bg-light rounded-4 border border-2 border-body-secondary px-3 px-md-4 py-4 py-md-5" style="height: 280px;">
                        <div class="row">
                            <div class="col-12">
                                <p class="h5">
                                    {{ lang('maketransaction') }}
                                </p>
                            </div>
                        </div>
                        <div v-if="userLoadStatus != null" class="row">
                            <div v-if="userLoadStatus == 'fine'" class="col-12 lh-sm">
                                <div class="row ps-2 pb-3">
                                    <div class="col-12">
                                        <p class="small text-secondary p-0 m-0" style="--bs-text-opacity: 0.8;">
                                            {{ lang('useminnuestoreduce') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-start">
                                    <div v-if="userBalance != null" class="input-group my-2" style="max-width: 400px;">
                                        <span class="input-group-text text-start bg-primary text-dark p-0 m-0 px-3" style="--bs-bg-opacity: 0.3; width: 140px;">{{ lang('addorremove') }}</span>
                                        <input v-model="chargeAmountAdminInput" class="form-control bg-light text-start" type="number" aria-label="clientbalance" aria-describedby="clientbalance" style="max-width: 170px;" placeholder="±99">
                                        <input class="form-control bg-body-secondary text-center" :placeholder="config.AutovmDefaultCurrencySymbol" style="max-width: 70px;" disabled>
                                    </div>
                                    <div class="">
                                        <span v-if="chargeAmountAdminInput" class="text-primary">
                                            <span class="px-2">≈</span>
                                            <span>
                                                {{ showChargeAmountWhmcsUnit(ConverFromAutoVmToWhmcs(chargeAmountAdminInput)) }}
                                            </span>
                                            <span class="px-2">
                                                {{ userCurrencySymbolFromWhmcs }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div v-if="userBalance != null && AdminClickOnTrans != true && chargeAmountAdminInput != 0" class="d-flex flex-row justify-content-end">
                                    <a v-if="!chargeAmountAdminInputisvalide && chargeAmountAdminInput" class="btn btn-secondary">
                                        <span>
                                            {{ lang('error') }}
                                        </span>
                                    </a>
                                    <a v-else-if="chargeAmountAdminInputisvalide && chargeAmountAdminInput > 0" @click="chargeCloudAdmin" class="btn btn-primary">
                                        <span>
                                            {{ lang('increase') }}
                                        </span>
                                        <span class="px-1">( {{ showChargeAmountCloudUnit(chargeAmountAdminInput) }}</span>
                                        <span class="px-1">{{ config.AutovmDefaultCurrencySymbol }} )</span>
                                    </a>
                                    <a v-else-if="chargeAmountAdminInputisvalide && chargeAmountAdminInput < 0" @click="chargeCloudAdmin" class="btn btn-danger">
                                        <span>
                                            {{ lang('decrease') }}
                                        </span>
                                        <span class="px-1">( {{ showChargeAmountCloudUnit(chargeAmountAdminInput) }}</span>
                                        <span class="px-1">{{ config.AutovmDefaultCurrencySymbol }} )</span>
                                    </a>
                                </div>
                                <div class="row d-flex flex-row justify-content-start align-items-center mt-4">
                                    <div v-if="AdminClickOnTrans && AdminTransSuccess == null" class="">
                                        <span class="text-primary">
                                            <?php include('./includes/commodules/threespinner.php'); ?>
                                        </span>
                                    </div>
                                    <div v-if="AdminTransSuccess != null" class="">
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
            <div v-else class="d-flex flex-row align-items-center text-primary h4 ps-4 mt-4" style="height: 260px" >
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

<?php include_once('./includes/commodules/footer.php'); ?>