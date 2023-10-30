<div class="border border-2 rounded-4 bg-body-secondary py-4 px-3 px-lg-4 px-xl-5 me-0 me-md-2">
    <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
        <div class="d-flex flex-row flex-wrap align-items-center justify-content-start">
            <div class="">
                <span class="text-dark fw-medium">
                    {{ lang('cloudbalance') }}
                    <span class="pe-1">:</span>
                </span>
            </div>
            <div v-if="user.balance" class="">
                <span v-if="user.balance" class="text-primary fw-medium">
                    <span class="px-1">{{ formatCost(user.balance, 0) }}</span>
                    <span v-if="config.AutovmDefaultCurrencySymbol">
                        {{ config.AutovmDefaultCurrencySymbol }}
                    </span>
                </span>  
                <span v-else class="text-primary fw-medium ps-2">
                    --- 
                </span>
            </div>
            <?php if($ChargeModuleEnable): ?>
                <div class="row d-none d-md-block">
                    <div v-if="config.ActivateRatioFunc" class="">
                        <div v-if="CurrenciesRatioCloudToWhmcs != null && CurrenciesRatioCloudToWhmcs != 1" class="">        
                            <span v-if="user.balance" class="btn bg-secondary ms-2 px-md-4 rounded-5 ms-4" style="--bs-bg-opacity: 0.3;" disabled>
                                <span class="pe-2">≈</span>
                                <span class="px-1">{{ ConverFromAutoVmToWhmcs(user.balance, 1) }}</span>
                                
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
            <?php endif ?>
        </div>
        <div class="m-0 p-0">
            <?php if($ChargeModuleEnable): ?>  
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chargeModal">{{ lang('movebalance') }}</a>
            <?php else: ?>
                <a class="btn btn-primary" target="_top" type="button" href="<?php echo($CloudTopupLink); ?>">{{ lang('topup') }}</a>
            <?php endif ?>
        </div>
    </div>
    
    <!-- for mobile -->
    <?php if($ChargeModuleEnable): ?>
        <div class="row d-block d-md-none mt-4">
            <div v-if="config.ActivateRatioFunc" class="">
                <div v-if="CurrenciesRatioCloudToWhmcs != null && CurrenciesRatioCloudToWhmcs != 1" class="">        
                    <span v-if="user.balance" class="btn bg-secondary px-5 rounded-5" style="--bs-bg-opacity: 0.3;" disabled>
                        <span class="pe-2">≈</span>
                        <span class="px-1">{{ ConverFromAutoVmToWhmcs(user.balance, 1) }}</span>
                        
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
    <?php endif ?>
</div>