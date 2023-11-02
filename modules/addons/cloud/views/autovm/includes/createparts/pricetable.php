<!-- Cost Table -->
<div v-if="planIsSelected" class="row m-0 p-0 py-5 my-5 border border-2 p-4 bg-body-secondary rounded-4 ms-md-2" style="height: 550px;">    
    <div class="col-12" style="--bs-bg-opacity: 0.1;">
        
        <!-- title -->
        <div class="row">
            <div class="m-0 p-0">
                <p class="text-dark h3">
                    Price Table
                </p>
            </div>
            <div class="m-0 p-0 mt-3">
                <span class="fs-6 pt-1 pb-4 text-secondary"> 
                    See your order details
                </span>
            </div>
        </div>

        <!-- Ready to show Table -->
        <div class="row p-0 m-0 mt-4">
            <!-- Machien Config price  -->
            <div class="col-12 col-md-12 mb-4">
                <div class="row" style="--bs-bg-opacity: 0.1;">

                    <!-- Traffic -->
                    <div v-if="planTrafficPrice != null && RangeValueTraffic != null">
                        <div class="input-group mb-3">
                            <span class="input-group-text col-4" id="RangeValueTraffic">
                                <img src="/modules/addons/cloud/views/autovm/includes/assets/img/bandwidth.svg" width="20" class="p-0 m-0 me-3">
                                <span>
                                    Traffic
                                </span>
                            </span>
                            <input type="text" class="form-control col-4" :placeholder="RangeValueTraffic + ' GB'" aria-label="RangeValueTraffic" aria-describedby="RangeValueTraffic">
                            <span class="input-group-text col-4" id="RangeValueTraffic">
                                <span>
                                {{ formatNumberMonthly(RangeValueTraffic*planTrafficPrice) }} {{ config.AutovmDefaultCurrencySymbol }}
                                </span>
                            </span>
                        </div>
                    </div>


                    <!-- Memory -->
                    <div v-if="planMemoryPrice != null && RangeValueMemory != null">
                        <div class="input-group mb-3">
                            <span class="input-group-text col-4" id="RangeValueMemory">
                                <img src="/modules/addons/cloud/views/autovm/includes/assets/img/ramicon.svg" width="20" class="p-0 m-0 me-3">
                                <span>
                                    Memory
                                </span>
                            </span>
                            <input type="text" class="form-control col-4" :placeholder="RangeValueMemory + ' GB'" aria-label="RangeValueMemory" aria-describedby="RangeValueMemory">
                            <span class="input-group-text col-4" id="RangeValueMemory">
                                <span>
                                {{ formatNumberMonthly(RangeValueMemory*planMemoryPrice) }} {{ config.AutovmDefaultCurrencySymbol }}
                                </span>
                            </span>
                        </div>
                    </div>


                    <!-- CpuCore -->
                    <div v-if="planCpuCorePrice != null && RangeValueCpuCore != null">
                        <div class="input-group mb-3">
                            <span class="input-group-text col-4" id="RangeValueCpuCore">
                                <img src="/modules/addons/cloud/views/autovm/includes/assets/img/cpuicon.svg" width="20" class="p-0 m-0 me-3">
                                <span>
                                    CpuCore
                                </span>
                            </span>
                            <input type="text" class="form-control col-4" :placeholder="RangeValueCpuCore + ' Core'" aria-label="RangeValueCpuCore" aria-describedby="RangeValueCpuCore">
                            <span class="input-group-text col-4" id="RangeValueCpuCore">
                                <span>
                                    {{ formatNumberMonthly(RangeValueCpuCore*planCpuCorePrice) }} {{ config.AutovmDefaultCurrencySymbol }}
                                </span>
                            </span>
                        </div>
                    </div>


                    <!-- CpuLimit -->
                    <div v-if="planCpuLimitPrice != null && RangeValueCpuLimit != null">
                        <div class="input-group mb-3">
                            <span class="input-group-text col-4" id="RangeValueCpuLimit">
                                <i class="bi bi-cpu-fill text-secondary p-0 m-0 me-3 h5"></i>
                                <span>
                                    CpuLimit
                                </span>
                            </span>
                            <input type="text" class="form-control col-4" :placeholder="RangeValueCpuLimit + ' GHz'" aria-label="RangeValueCpuLimit" aria-describedby="RangeValueCpuLimit">
                            <span class="input-group-text col-4" id="RangeValueCpuLimit">
                                <span>
                                    {{ formatNumberMonthly(RangeValueCpuLimit*planCpuLimitPrice) }} {{ config.AutovmDefaultCurrencySymbol }}
                                </span>
                            </span>
                        </div>
                    </div>

                    <!-- Disk -->
                    <div v-if="planDiskPrice != null && RangeValueDisk != null">
                        <div class="input-group">
                            <span class="input-group-text col-4" id="RangeValueDisk">
                                <i class="bi bi-device-hdd text-secondary p-0 m-0 me-3 h5"></i>
                                <span>
                                    Disk
                                </span>
                            </span>
                            <input type="text" class="form-control col-4" :placeholder="RangeValueDisk + ' GB'" aria-label="RangeValueDisk" aria-describedby="RangeValueDisk">
                            <span class="input-group-text col-4" id="RangeValueDisk">
                                <span>
                                    {{ formatNumberMonthly(RangeValueDisk*planDiskPrice) }} {{ config.AutovmDefaultCurrencySymbol }}
                                </span>
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    

        <!-- Summery Table -->
        <div class="row mt-5">
            <div class="m-0 p-0">
                <p class="text-dark h4">
                    <i class="bi bi-currency-exchange text-secondary p-0 m-0 me-3 h5"></i>
                    <span>Total Cost</span>
                </p>
            </div>
        </div>
            
            
        <div class="col-12 col-md-12 py-4"> 
            <div v-if="NewMachinePrice != null" class="row m-0 p-0">
                <div class="input-group">
                    <span class="input-group-text col-4" id="RangeValueDisk" style="width: 80px;">
                        <span>
                            Monthly
                        </span>
                    </span>
                    <input type="text" class="form-control col-4" :placeholder="NewMachinePrice + config.AutovmDefaultCurrencySymbol" aria-label="TotalCost" aria-describedby="TotalCost">
                    <span v-if="CurrenciesRatioCloudToWhmcs != null && CurrenciesRatioCloudToWhmcs != 1" class="input-group-text col-4" id="TotalCost">
                        <span>
                            {{ ConverFromAutoVmToWhmcs(NewMachinePrice) }} {{ userCurrencySymbolFromWhmcs }}
                        </span>
                    </span>
                </div>
                
                <!-- hourly -->
                <div class="input-group">
                    <span class="input-group-text col-4" id="RangeValueDisk" style="width: 80px;">
                        <span>
                            Hourly
                        </span>
                    </span>
                    <input type="text" class="form-control col-4" :placeholder="formatNumberHourly(NewMachinePrice/30/24)  + config.AutovmDefaultCurrencySymbol" aria-label="TotalCost" aria-describedby="TotalCost">
                    <span v-if="CurrenciesRatioCloudToWhmcs != null && CurrenciesRatioCloudToWhmcs != 1" class="input-group-text col-4" id="TotalCost">
                        <span>
                            {{ ConverFromAutoVmToWhmcs(NewMachinePrice/30/24) }} {{ userCurrencySymbolFromWhmcs }}
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>




