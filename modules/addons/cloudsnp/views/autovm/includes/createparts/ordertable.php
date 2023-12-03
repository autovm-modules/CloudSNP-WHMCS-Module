<div class="row" style="--bs-bg-opacity: 0.1;">

    <!-- Memory -->
    <div v-if="planMemoryPrice != null && RangeValueMemory != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0"style="background-color: #ffffff00; border: 0;"  id="RangeValueMemory">
                <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/ramicon.svg" width="20" class="p-0 m-0 me-3">
                <span>
                    {{ lang('memory') }}
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueMemory + 'GB'" aria-label="RangeValueMemory" aria-describedby="RangeValueMemory" style="background-color: #ffffff00; border: 0;" disabled>
            <span class="input-group-text col-4"style="background-color: #ffffff00; border: 0;"  id="RangeValueMemory">
                <span v-if="planMemoryPrice != 0">
                    {{ formatCostMonthly(ConverFromAutoVmToWhmcs(RangeValueMemory*planMemoryPrice)) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
                <span v-if="planMemoryPrice == 0">
                    {{ lang('freeprice') }}
                </span>
            </span>
        </div>
    </div>


    <!-- CpuCore -->
    <div v-if="planCpuCorePrice != null && RangeValueCpuCore != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0"style="background-color: #ffffff00; border: 0;"  id="RangeValueCpuCore">
                <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/cpuicon.svg" width="20" class="p-0 m-0 me-3">
                <span>
                    {{ lang('cpu') }}
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueCpuCore + 'Core (' + RangeValueCpuLimit + 'Ghz)'" aria-label="RangeValueCpuCore" aria-describedby="RangeValueCpuCore" style="background-color: #ffffff00; border: 0;" disabled>
            <span class="input-group-text col-4"style="background-color: #ffffff00; border: 0;"  id="RangeValueCpuCore">
                <span v-if="planCpuCorePrice != 0">
                    {{ formatCostMonthly(ConverFromAutoVmToWhmcs(RangeValueCpuCore*(planCpuCorePrice + planCpuLimitPrice))) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
                <span v-if="planCpuCorePrice == 0">
                    {{ lang('freeprice') }}
                </span>
            </span>
        </div>
    </div>

    <!-- Disk -->
    <div v-if="planDiskPrice != null && RangeValueDisk != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0"style="background-color: #ffffff00; border: 0;"  id="RangeValueDisk">
                <i class="bi bi-device-hdd text-secondary p-0 m-0 me-3 h4"></i>
                <span>
                    {{ lang('disk') }}
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueDisk + 'GB'" aria-label="RangeValueDisk" aria-describedby="RangeValueDisk" style="background-color: #ffffff00; border: 0;" disabled>
            <span class="input-group-text col-4"style="background-color: #ffffff00; border: 0;"  id="RangeValueDisk">
                <span v-if="planDiskPrice != 0">
                    {{ formatCostMonthly(ConverFromAutoVmToWhmcs(RangeValueDisk*planDiskPrice)) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
                <span v-if="planDiskPrice == 0">
                    {{ lang('freeprice') }}
                </span>
            </span>
        </div>
    </div>
</div>

<hr>

<div class="row" style="--bs-bg-opacity: 0.1;">

    <!-- Address -->
    <div v-if="planAddressPrice != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0"style="background-color: #ffffff00; border: 0; width: 190px;"  id="planAddressPrice">
                <i class="bi bi-globe me-3 h5"></i>
                <span>
                    {{ lang('costoneip') }}
                </span>
            </span>
            <span class="input-group-text col-4 text-secondary"style="background-color: #ffffff00; border: 0;"  id="RangeValueMemory">
                <span v-if="planAddressPrice != 0">
                    {{ formatCostMonthly(ConverFromAutoVmToWhmcs(planAddressPrice)) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
                <span v-if="planAddressPrice == 0">
                    {{ lang('freeprice') }}
                </span>
            </span>
        </div>
    </div>

    <!-- Traffic -->
    <div v-if="planTrafficPrice != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0"style="background-color: #ffffff00; border: 0; width: 190px;"  id="planTrafficPrice">
                <i class="bi bi-router-fill me-3 h5"></i>
                <span>
                    {{ lang('costonegigtraffic') }}
                </span>
            </span>
            <span class="input-group-text col-4 text-secondary"style="background-color: #ffffff00; border: 0;"  id="RangeValueMemory">
                <span v-if="planTrafficPrice != 0">
                    {{ formatCostMonthly(ConverFromAutoVmToWhmcs(planTrafficPrice)) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
                <span v-if="planTrafficPrice == 0">
                    {{ lang('freeprice') }}
                </span>
            </span>
        </div>
    </div>
</div>
