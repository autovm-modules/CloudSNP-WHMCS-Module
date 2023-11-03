<!-- Ratio -->
<div v-if="config.AutovmDefaultCurrencyID != userCurrencyIdFromWhmcs" class="row m-0 p-0 mt-2">            
    <div class="col-12 m-0 p-0">
        <div class="d-flex flex-row flex-wrap justify-content-end">
            <div v-if="ConverFromWhmcsToCloud(1) > ConverFromAutoVmToWhmcs(1)" class="px-2 px-md-5 rounded-5"  style="--bs-bg-opacity: 0.3; min-width: 150px;">
                <span>
                    <span class="px-1">1</span>
                    <span>{{ userCurrencySymbolFromWhmcs }}</span>
                </span>
                <span class="px-2">≈</span>
                <span>
                    <span class="px-1">{{ showRatio(ConverFromWhmcsToCloud(1)) }}</span>
                    <span>{{ config.AutovmDefaultCurrencySymbol }}</span>
                </span>
            </div>
            <div v-if="ConverFromWhmcsToCloud(1) < ConverFromAutoVmToWhmcs(1)" class="px-2 px-md-5 rounded-5"  style="--bs-bg-opacity: 0.3; min-width: 150px;">
                <span>
                    <span class="px-1">1</span>
                    <span>{{ config.AutovmDefaultCurrencySymbol }}</span>
                </span>
                <span class="px-2">≈</span>
                <span>
                    <span class="px-1">{{ showRatio(ConverFromAutoVmToWhmcs(1)) }}</span>
                    <span>{{ userCurrencySymbolFromWhmcs }}</span>
                </span>
            </div>
        </div>
    </div>
</div>