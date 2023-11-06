<?php if($ChargeModuleEnable): ?>
<div class="border border-2 rounded-4 bg-body-secondary py-4 px-3 px-lg-4 px-xl-5 me-0 me-md-2">
    <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
        <div class="d-flex flex-row flex-wrap align-items-center justify-content-start">
            <div class="">
                <span class="text-dark fw-medium">
                    {{ lang('cloudbalance') }}
                    <span class="pe-1">:</span>
                </span>
            </div>
            
            <!-- Balance in WHMCS currency -->
            <div class="row d-none d-md-block">
                <div v-if="config.ActivateRatioFunc" class="">
                    <div v-if="CurrenciesRatioCloudToWhmcs != null" class="">        
                        <span v-if="user.balance != null" class="">
                            <span class="">
                                {{ showBalanceCloudUnit(ConverFromAutoVmToWhmcs(user.balance)) }}
                            </span>
                            <span v-if="userCurrencySymbolFromWhmcs != null" class="px-1">
                                {{ userCurrencySymbolFromWhmcs }}
                            </span>
                        </span>
                        <span v-else class="text-primary fw-medium ps-2">
                            --- 
                        </span>
                    </div>
                </div>
            </div>

            <?php if($EnableShowRatioCurrency): ?>
                <!-- Balance in cloud currency -->
                <div class="">
                    <span v-if="user.balance != null" class="text-primary fw-medium">
                        <span class="px-1">{{ showBalanceCloudUnit(user.balance) }}</span>
                        <span v-if="config.AutovmDefaultCurrencySymbol != null">
                            {{ config.AutovmDefaultCurrencySymbol }}
                        </span>
                    </span>  
                    <span v-else class="text-primary fw-medium ps-2">
                        --- 
                    </span>
                </div>
            <?php endif ?>
        </div>
        <div class="m-0 p-0">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chargeModal">{{ lang('movebalance') }}</a>
        </div>
    </div>
    
    <!-- for mobile -->
    
        <div class="row d-block d-md-none mt-4">
            <div v-if="config.ActivateRatioFunc" class="">
                <div v-if="CurrenciesRatioCloudToWhmcs != null && CurrenciesRatioCloudToWhmcs != 1" class="">        
                    <span v-if="user.balance != null" class="btn bg-secondary px-5 rounded-5" style="--bs-bg-opacity: 0.3;" disabled>
                        <span class="pe-2">≈</span>
                        <span class="px-1">{{ showBalanceWhmcsUnit(ConverFromAutoVmToWhmcs(user.balance)) }}</span>
                        
                        <!-- Rial -->    
                        <span v-if="userCurrencySymbolFromWhmcs">
                            {{ userCurrencySymbolFromWhmcs }}
                        </span>
                    </span>
                    <span v-else class="text-primary fw-medium ps-2">
                        --- 
                    </span>
                </div>
            </div>
        </div>
    
</div>
<?php endif ?>