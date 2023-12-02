<?php 
    if(isset($DefaultChargeModuleEnable) && $DefaultChargeModuleEnable == false){
        $ChargeModuleEnable = false;
    } else {
        $ChargeModuleEnable = true;
    }
    
    if(empty($CloudTopupLink)){
        $CloudTopupLink = '/clientarea.php?action=addfunds';
    }

    if(isset($DefaultChargeModuleDetailsViews) && $DefaultChargeModuleDetailsViews){
        $ChargeModuleDetailsViews = true;
    } else {
        $ChargeModuleDetailsViews = false;
    }

    
?>  

<!-- create machine modal -->
<div class="modal fade modal-lg" id="chargeModal"  data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="chargeModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <!-- usercredit or balance is null -->
        <div v-if="userCreditinWhmcs == null || balance == null" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="chargeModalToggleLabel">{{ lang('chargecloudaccount') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>    
            <div class="modal-body mt-4 mx-1 mx-md-3 mx-lg-4" style="height:150px">
                <p class="h5 py-2">
                    {{ lang('waittofetch') }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">{{ lang('close') }}</button>
            </div>
        </div>
        
        <div v-if="userCreditinWhmcs != null && balance != null" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">{{ lang('chargecloudaccount') }}</h1>
                <button v-if="!ConstChargeamountInWhmcs" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>    
            <!-- No credit -->
            <div v-if="userCreditinWhmcs < ConverFromAutoVmToWhmcs(config.minimumChargeInAutovmCurrency)" class="modal-body mt-4 px-3 px-md-4" style="height:210px">
                <p class="alert alert-warning text-dark">
                    <span>
                        {{ lang('yourcredit') }}
                    </span>
                    <span>
                        {{ lang('isnotenough') }}
                    </span>
                </p>
                <p class="h6 py-2 px-2">
                    <span>
                        {{ lang('minimumis') }}
                    </span>
                    <span class="text-primary px-1">
                        ({{ showMinimumeWhmcsUnit(ConverFromAutoVmToWhmcs(config.minimumChargeInAutovmCurrency)) }} {{ userCurrencySymbolFromWhmcs }}) 
                    </span>
                    <span>.</span>
                </p>
                <div class="my-5">
                    <a class="btn btn-primary float-end" target="_top" type="button" href="<?php echo($CloudTopupLink); ?>">
                        {{ lang('topup') }}
                    </a>
                </div>
            </div>

            <div v-else class="modal-body mt-4 px-3 px-md-4 pb-5">
                <div class="row m-0 p-0 align-items-start">
                    <div class="col-12 m-0 p-0">
                        <!-- Table balance and credit -->    
                        <div class="row m-0 p-0">
                            <div class="col-12 col-lg-8 m-0 p-0">
                                <p class="h6 lh-lg mt-2">
                                    {{ lang('youcantransfercredit') }}
                                </p>
                            </div>
                            <div class="col-12 col-lg-4 m-0 p-0">
                                <div class="row justify-content-end">
                                    <div class="col-auto">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="bg-body-secondary rounded-3 px-3 py-3 px-4 text-center fs-6">
                                                    <?php include('showcredit.php'); ?> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- form input -->
                        <div class="row m-0 p-0 mt-4">            
                            <div class="col-12 m-0 p-0">
                                <div class="row m-0 p-0 mb-2">
                                    <div class="col-12 m-0 p-0">
                                        <p class="h6 lh-lg my-0 py-0">
                                            {{ lang('pleaseinputamountmoney') }}
                                        </p>    
                                    </div>
                                </div>
                                <div class="row m-0 p-0">
                                    <div class="col-12 col-md-7 m-0 p-0">
                                        <div class="row m-0 p-0 pe-md-2">
                                            <div class="col-12 m-0 p-0 input-group">
                                                <span class="input-group-text bg-body-secondary border-secondary" id="chargecredit" style="width: 140px !important;">
                                                    {{ lang('amounttocharge') }}
                                                </span>
                                                <input type="number" class="form-control bg-body-secondary border-secondary" :placeholder="showCreditWhmcsUnit(userCreditinWhmcs)" aria-label="chargecredit" aria-describedby="chargecredit" step="1" :min="showMinimumeWhmcsUnit(ConverFromAutoVmToWhmcs(config.minimumChargeInAutovmCurrency))" :max="userCreditinWhmcs" v-model="chargeAmountinWhmcs" :disabled="theChargingSteps > 0 ? true : false" style="max-width: 140px !important;">
                                                <span class="input-group-text border-secondary" id="chargecredit" style="min-width: 50px;">
                                                    {{ userCurrencySymbolFromWhmcs }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($ChargeModuleDetailsViews): ?>
                                        <div v-if="config.AutovmDefaultCurrencyID != userCurrencyIdFromWhmcs" class="col-12 col-md-5 m-0 p-0 d-none d-md-block">
                                            <div class="row m-0 p-0 ps-md-1 pt-4 pt-md-0 float-end">            
                                                <div class="col-12 m-0 p-0">
                                                    <div class="row m-0 p-0">
                                                        <div class="col-12 m-0 p-0 input-group">
                                                            <span class="input-group-text" id="chargecredit" disabled>≈</span>
                                                            <input type="number" class="form-control"  aria-label="qualchargecredite" aria-describedby="qualchargecredit" :value="showChargeAmountCloudUnit(chargeAmountInAutovmCurrency)" disabled style="max-width: 130px;">
                                                            <span class="input-group-text" id="chargecredit" style="min-width: 50px;">
                                                                {{ config.AutovmDefaultCurrencySymbol }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        

                        <?php if($ChargeModuleDetailsViews): ?>
                            <?php include('showratio.php'); ?> 
                        <?php endif ?>


                        <!-- Messages -->
                        <div class="row m-0 p-0 mt-3" v-if="chargeAmountinWhmcs && chargingValidity">
                            <div class="col-12 m-0 p-0">
                                <div class="m-0 p-0" v-if="chargingValidity == 'nocredit'">
                                    <p class="text-danger h6">
                                        <span>
                                            {{ lang('donthaveenoughcredit') }}
                                        </span>
                                    </p>
                                </div>
                                                        
                                <div class="m-0 p-0" v-if="chargingValidity == 'noenoughcredit'">
                                    <p class="text-danger h6">
                                        <span>
                                            {{ lang('islessthanminimum') }}
                                        </span>    
                                    <span class="px-1">
                                        ({{ showMinimumeWhmcsUnit(ConverFromAutoVmToWhmcs(config.minimumChargeInAutovmCurrency))}})
                                    </span>
                                    <span v-if="userCurrencySymbolFromWhmcs">
                                        {{ userCurrencySymbolFromWhmcs }}
                                    </span>
                                    <span>.</span>
                                    </p>
                                </div>

                                <div class="m-0 p-0" v-if="chargingValidity == 'noenoughchargeamount'">
                                    <p class="text-danger h6">
                                        <span>
                                            {{ lang('lessthanalowedminimum') }}
                                        </span>
                                        <span class="px-1">
                                            ({{ showMinimumeWhmcsUnit(ConverFromAutoVmToWhmcs(config.minimumChargeInAutovmCurrency))}})
                                        </span>
                                        <span v-if="userCurrencySymbolFromWhmcs">
                                            {{ userCurrencySymbolFromWhmcs }}
                                        </span>
                                        <span>.</span>
                                    </p>
                                </div>
                                
                                <div class="m-0 p-0" v-if="chargingValidity == 'notinteger'">
                                    <p class="text-danger h6">
                                        <span>{{ lang('notvaliddecimal') }}</span>
                                    </p>
                                </div>
                                
                                <div class="m-0 p-0" v-if="chargingValidity == 'overcredit'">
                                    <p class="text-danger h6">
                                        <span>{{ lang('thisismorethancredit') }}</span>
                                    </p>
                                </div>

                                
                            </div>
                        </div>

                        <!-- BTN -->
                        <div class="row m-0 p-0 text-end mt-5 pt-5" v-if="chargeAmountinWhmcs && chargingValidity == 'fine' && theChargingSteps == 0">
                            <div class="col-12 m-0 p-0 pt-5">
                                <button class="btn btn-primary col-auto px-5"  @click="CreateUnpaidInvoice">
                                    <span>{{ lang('starttransferring') }}</span>
                                    <span class="px-1">({{ showChargeAmountWhmcsUnit(chargeAmountinWhmcs) }} {{ userCurrencySymbolFromWhmcs }})</span>
                                </button>
                            </div>
                        </div>

                        <!-- Steps -->
                        <div class="row m-0 p-0 mt-5" v-if="chargeAmountinWhmcs && chargingValidity == 'fine' && theChargingSteps > 0">
                            <div class="col-12 m-0 p-0 rounded border bg-body-secondary p-3">

                                <!-- Step 01 : Just click to Start Transfering, Create Invoice  -->
                                <div class="row">
                                    <div class="d-flex flex-row justify-content-start align-items-center">
                                        <div class="text-primary" v-if="theStepStatus == 12 || theChargingSteps > 1">
                                            <span class="me-2 h5"><i class="bi bi-check"></i></span>
                                        </div>
                                        <div class="">
                                            <span class="text-primary pe-3" v-if="theStepStatus == 12 || theChargingSteps > 1">
                                                {{ lang('step1creatinganinvoice') }}

                                            </span>
                                            <span class="text-secondary pe-3 ps-3" v-else>
                                                {{ lang('step1creatinganinvoice') }}
                                            </span>
                                        </div>
                                        <div class="text-secondary" v-if="theStepStatus == 11">
                                            <?php include('./includes/commodules/threespinner.php'); ?>
                                        </div>
                                        <div class="text-danger" v-if="theStepStatus == 13">
                                            <span class="ps-3">{{ lang('error') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Send Transaction to API -->
                                <div class="row">
                                    <div class="d-flex flex-row justify-content-start align-items-center">
                                        <div class="text-primary" v-if="theStepStatus == 22 || theStepStatus == 32 || theChargingSteps == 3">
                                            <span class="me-2 h5"><i class="bi bi-check"></i></span>
                                        </div>
                                        <div class="text-secondary">
                                            <span class="text-primary pe-3" v-if="theStepStatus == 22 || theChargingSteps == 3">
                                                {{ lang('step2chargethecloudaccount') }}
                                            </span>
                                            <span class="text-secondary pe-3 ps-3" v-else>
                                                {{ lang('step2chargethecloudaccount') }}
                                            </span>
                                            </div>
                                        <div class="text-secondary" v-if="theStepStatus == 21">
                                            <?php include('./includes/commodules/threespinner.php'); ?>
                                        </div>
                                        <div class="text-danger" v-if="theStepStatus == 23">
                                            <span class="ps-3">{{ lang('error') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Apply Credit to invoice -->
                                <div class="row">
                                    <div class="d-flex flex-row justify-content-start align-items-center">
                                        <div class="text-primary" v-if="theStepStatus == 32">
                                            <span class="me-2 h5"><i class="bi bi-check"></i></span>
                                        </div>
                                        <div class="">
                                            <span class="text-primary pe-3" v-if="theStepStatus == 32">
                                                {{ lang('step3payyourinvoice') }}
                                            </span>
                                            <span class="text-secondary pe-3 ps-3" v-else>
                                                {{ lang('step3payyourinvoice') }}
                                            </span>
                                        </div>
                                        <div class="text-secondary" v-if="theStepStatus == 31">
                                            <?php include('./includes/commodules/threespinner.php'); ?>
                                        </div>
                                        <div class="text-danger" v-if="theStepStatus == 33">
                                            <span class="ps-3">{{ lang('error') }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div><!-- end modal -->