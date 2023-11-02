<div class="row" style="--bs-bg-opacity: 0.1;">
    <!-- Traffic -->
    <div v-if="planTrafficPrice != null && RangeValueTraffic != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0" style="background-color: #ffffff00; border: 0;" id="RangeValueTraffic">
                <img src="/modules/addons/cloud/views/autovm/includes/assets/img/bandwidth.svg" width="20" class="p-0 m-0 me-3">
                <span>
                    Traffic
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueTraffic + ' GB'" aria-label="RangeValueTraffic" aria-describedby="RangeValueTraffic" style="background-color: #ffffff00; border: 0;" disabled>
            <span class="input-group-text col-4"style="background-color: #ffffff00; border: 0;"  id="RangeValueTraffic">
                <span>
                {{ ConverFromAutoVmToWhmcs(RangeValueTraffic*planTrafficPrice) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
            </span>
        </div>
    </div>


    <!-- Memory -->
    <div v-if="planMemoryPrice != null && RangeValueMemory != null">
        <div class="input-group mb-1">
            <span class="input-group-text col-4 m-0 p-0"style="background-color: #ffffff00; border: 0;"  id="RangeValueMemory">
                <img src="/modules/addons/cloud/views/autovm/includes/assets/img/ramicon.svg" width="20" class="p-0 m-0 me-3">
                <span>
                    Memory
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueMemory + ' GB'" aria-label="RangeValueMemory" aria-describedby="RangeValueMemory" style="background-color: #ffffff00; border: 0;" disabled>
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
                    CpuCore
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueCpuCore + ' Core'" aria-label="RangeValueCpuCore" aria-describedby="RangeValueCpuCore" style="background-color: #ffffff00; border: 0;" disabled>
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
                    CpuLimit
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueCpuLimit/1000 + ' GHz'" aria-label="RangeValueCpuLimit" aria-describedby="RangeValueCpuLimit" style="background-color: #ffffff00; border: 0;" disabled>
            <span class="input-group-text col-4"style="background-color: #ffffff00; border: 0;"  id="RangeValueCpuLimit">
                <span>
                    {{ ConverFromAutoVmToWhmcs((RangeValueCpuLimit/1000)*planCpuLimitPrice) }} {{ userCurrencySymbolFromWhmcs }}
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
                    Disk
                </span>
            </span>
            <input type="text" class="form-control col-4" :placeholder="RangeValueDisk + ' GB'" aria-label="RangeValueDisk" aria-describedby="RangeValueDisk" style="background-color: #ffffff00; border: 0;" disabled>
            <span class="input-group-text col-4"style="background-color: #ffffff00; border: 0;"  id="RangeValueDisk">
                <span>
                    {{ ConverFromAutoVmToWhmcs(RangeValueDisk*planDiskPrice) }} {{ userCurrencySymbolFromWhmcs }}
                </span>
            </span>
        </div>
    </div>
</div>