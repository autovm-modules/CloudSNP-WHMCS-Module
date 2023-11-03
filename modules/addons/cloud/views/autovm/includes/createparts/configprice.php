<div class="row" style="--bs-bg-opacity: 0.1;">

    <!-- Memory -->
    <div v-if="planMemoryPrice != null && RangeValueMemory != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0"style="background-color: #ffffff00; border: 0;"  id="RangeValueMemory">
                <img src="/modules/addons/cloud/views/autovm/includes/assets/img/ramicon.svg" width="20" class="p-0 m-0 me-3">
                <span>
                    {{ lang('memory') }}
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueMemory + 'GB'" aria-label="RangeValueMemory" aria-describedby="RangeValueMemory" style="background-color: #ffffff00; border: 0;" disabled>
            <span class="input-group-text col-4"style="background-color: #ffffff00; border: 0;"  id="RangeValueMemory">
                <span>
                {{ ConverFromAutoVmToWhmcs(RangeValueMemory*planMemoryPrice) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
            </span>
        </div>
    </div>


    <!-- CpuCore -->
    <div v-if="planCpuCorePrice != null && RangeValueCpuCore != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0"style="background-color: #ffffff00; border: 0;"  id="RangeValueCpuCore">
                <img src="/modules/addons/cloud/views/autovm/includes/assets/img/cpuicon.svg" width="20" class="p-0 m-0 me-3">
                <span>
                    {{ lang('cpucore') }}
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueCpuCore + 'Core'" aria-label="RangeValueCpuCore" aria-describedby="RangeValueCpuCore" style="background-color: #ffffff00; border: 0;" disabled>
            <span class="input-group-text col-4"style="background-color: #ffffff00; border: 0;"  id="RangeValueCpuCore">
                <span>
                    {{ ConverFromAutoVmToWhmcs(RangeValueCpuCore*planCpuCorePrice) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
            </span>
        </div>
    </div>


    <!-- CpuLimit -->
    <div v-if="planCpuLimitPrice != null && RangeValueCpuLimit != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0"style="background-color: #ffffff00; border: 0;"  id="RangeValueCpuLimit">
                <i class="bi bi-cpu-fill text-secondary p-0 m-0 me-3 h5"></i>
                <span>
                    {{ lang('cpufrequency') }}
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueCpuLimit + 'GHz'" aria-label="RangeValueCpuLimit" aria-describedby="RangeValueCpuLimit" style="background-color: #ffffff00; border: 0;" disabled>
            <span class="input-group-text col-4"style="background-color: #ffffff00; border: 0;"  id="RangeValueCpuLimit">
                <span>
                    {{ ConverFromAutoVmToWhmcs(RangeValueCpuLimit*planCpuLimitPrice) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
            </span>
        </div>
    </div>

    <!-- Disk -->
    <div v-if="planDiskPrice != null && RangeValueDisk != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0"style="background-color: #ffffff00; border: 0;"  id="RangeValueDisk">
                <i class="bi bi-device-hdd text-secondary p-0 m-0 me-3 h5"></i>
                <span>
                    {{ lang('disk') }}
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueDisk + 'GB'" aria-label="RangeValueDisk" aria-describedby="RangeValueDisk" style="background-color: #ffffff00; border: 0;" disabled>
            <span class="input-group-text col-4"style="background-color: #ffffff00; border: 0;"  id="RangeValueDisk">
                <span>
                    {{ ConverFromAutoVmToWhmcs(RangeValueDisk*planDiskPrice) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
            </span>
        </div>
    </div>
</div>