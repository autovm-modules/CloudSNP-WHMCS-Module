<?php if($ChargeModuleEnable): ?>
<div class="border border-2 rounded-4 bg-body-secondary py-4 px-3 px-lg-4 px-xl-5 me-0 me-md-2">
    <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
        <div class="d-flex flex-row flex-wrap align-items-center justify-content-start order-1">
            <div class="">
                <span class="text-dark fw-medium">
                    {{ lang('cloudbalance') }}
                    <span class="pe-1">:</span>
                </span>
            </div>
            
            <!-- Balance in Desktop -->
            <div class="row d-none d-md-block">
                <div class="">        
                    <span v-if="user.balance != null && CurrenciesRatioCloudToWhmcs != null" class="text-primary fw-medium ps-2">
                        <span class="">
                            {{ showBalanceWhmcsUnit(ConverFromAutoVmToWhmcs(user.balance)) }}
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
            <!-- Balance for mobile -->
            <div class="row d-block d-md-none">
                <div class="">        
                    <span v-if="user.balance != null && CurrenciesRatioCloudToWhmcs != null" class="text-primary fw-medium">
                        <span class="px-1">{{ showBalanceWhmcsUnit(ConverFromAutoVmToWhmcs(user.balance)) }}</span> 
                        <span v-if="userCurrencySymbolFromWhmcs">
                            {{ userCurrencySymbolFromWhmcs }}
                        </span>
                    </span>
                    <span v-else class="text-primary fw-medium ps-1">
                        --- 
                    </span>
                </div>
            </div>
        </div>
        <div class="m-0 p-0 order-3">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chargeModal">{{ lang('movebalance') }}</a>
        </div>
        
        <?php if($ChargeModuleDetailsViews): ?>
            <!-- Balance in cloud currency -->
            <div v-if="user.balance != null" class="btn btn-secondary px-4 ms-2 rounded-5 order-2">
                <span v-if="user.balance != null" class="p-0 m-0 fw-medium">
                    <span class="px-1">{{ showBalanceCloudUnit(user.balance) }}</span>
                    <span v-if="config.AutovmDefaultCurrencySymbol != null">
                        {{ config.AutovmDefaultCurrencySymbol }}
                    </span>
                </span>  
                <span v-else class="fw-medium ps-2">
                    --- 
                </span>
            </div>
        <?php endif ?>
    </div>
</div>
<?php endif ?>