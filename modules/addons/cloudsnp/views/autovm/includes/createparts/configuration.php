<!-- Configure plans -->
<div v-if="planIsSelected" class="row m-0 p-0 py-5 my-5 border border-2 p-4 bg-body-secondary rounded-4 me-md-2" style="height: 550px;">    
    <div class="col-12" style="--bs-bg-opacity: 0.1;">
        <!-- title -->
        <div class="row">
            <div class="m-0 p-0">
                <span class="text-dark h3">
                    {{ lang('configuration') }}
                </span>
            </div>
            <div class="m-0 p-0 mt-3">
                <span class="fs-6 pt-1 pb-4 text-secondary">
                    {{ lang('configinyourfavor') }}
                </span>
            </div>
            
        </div>
    
        <!-- No selection -->
        <div v-if="!planIsSelected" class="row mt-5">
            <div class="col-12 mb-5" >
                <div class="alert alert-primary border-0" role="alert" style="--bs-alert-bg: #cfe2ff73; --bs-alert-border-color: #9ec5fe6e;">
                    {{ lang('pleaseselectaplan') }}
                </div>
            </div>
        </div>

        <div v-if="planIsSelected" class="m-0 p-0">

            <!-- Memory -->
            <div class="row">
                <!-- small -->
                <div class="d-block d-lg-none m-0 p-0">
                    <div class="col-12 mt-3 mb-3" style="width: 150px !important;">
                        <span class="d-flex flex-row justify-content-start align-items-center">
                            <img src="/modules/addons/cloudsnp/views/autovm/includes/assets/img/ramicon.svg" alt="Memory">
                            <span class="p-0 m-0 h6 ms-2 me-2">
                                {{ lang('memory') }}
                            </span>
                            <span class="p-0 m-0 me-2 h6">
                                ({{ lang('GB') }})
                            </span>
                        </span>
                    </div>
                </div>
                <!-- medium -->
                <div class="d-flex flex-row justify-content-between align-items-center m-0 p-0 pt-0 pt-md-5">
                    <div class=" d-none d-lg-block">
                        <span class="d-flex flex-row justify-content-start align-items-center" style="width: 150px !important;">
                            <img class="text-secondary p-0 m-0 pe-3" src="/modules/addons/cloudsnp/views/autovm/includes/assets/img/ramicon.svg" alt="Memory">
                            <span class="p-0 m-0 me-2 h6">
                                {{ lang('memory') }}
                            </span>
                            <span class="p-0 m-0 me-2 h6">
                                ({{ lang('GB') }})
                            </span>
                        </span>
                    </div>
                    <input v-model="RangeValueMemoryString" type="range" class="form-range" :min="config.planConfig.Memory.min" :max="planMaxMemorySize" :step="config.planConfig.Memory.step" id="MemoryPriceRange">
                    <input v-model="RangeValueMemoryString" type="text" class="form-control ms-3 text-center m-0 p-0 py-1" style="width: 60px;" :min="config.planConfig.Memory.min" :max="planMaxMemorySize" :step="config.planConfig.Memory.step" id="MemoryPriceRange">
                </div>
            </div>


            <!-- CpuCore -->
            <div class="row">
                <!-- small -->
                <div class="d-block d-lg-none m-0 p-0">
                    <div class="col-12 mt-3 mb-3" style="width: 150px !important;">
                        <span class="d-flex flex-row justify-content-start align-items-center">
                            <img src="/modules/addons/cloudsnp/views/autovm/includes/assets/img/cpuicon.svg" alt="CpuCore">
                            <span class="p-0 m-0 h6 ms-2 me-2">
                                {{ lang('cpu') }}
                            </span>
                            <span class="p-0 m-0 me-2 h6">
                                ({{ lang('core') }})
                            </span>
                        </span>
                    </div>
                </div>
                <!-- medium -->
                <div class="d-flex flex-row justify-content-between align-items-center m-0 p-0 pt-0 pt-md-5">
                    <div class=" d-none d-lg-block">
                        <span class="d-flex flex-row justify-content-start align-items-center" style="width: 150px !important;">
                            <img class="text-secondary p-0 m-0 pe-3" src="/modules/addons/cloudsnp/views/autovm/includes/assets/img/cpuicon.svg" alt="CpuCore">
                            <span class="p-0 m-0 me-2 h6">
                                {{ lang('cpu') }}
                            </span>
                            <span class="p-0 m-0 me-2 h6">
                                ({{ lang('core') }})
                            </span>
                        </span>
                    </div>
                    <input v-model="RangeValueCpuCoreString" type="range" class="form-range" :min="config.planConfig.CpuCore.min" :max="planMaxCpuCore" :step="config.planConfig.CpuCore.step" id="CpuCorePriceRange">
                    <input v-model="RangeValueCpuCoreString" type="text" class="form-control ms-3 text-center m-0 p-0 py-1" style="width: 60px;" :min="config.planConfig.CpuCore.min" :max="planMaxCpuCore" :step="config.planConfig.CpuCore.step" id="CpuCorePriceRange">
                </div>
            </div>

            <!-- Disk -->
            <div class="row">
                <!-- small -->
                <div class="d-block d-lg-none m-0 p-0">
                    <div class="col-12 mt-3 mb-3" style="width: 150px !important;">
                        <span class="d-flex flex-row justify-content-start align-items-center">
                            <i class="bi bi-device-hdd bi bi-hdd-network text-secondary p-0 m-0 h6"></i>
                            <span class="p-0 m-0 ms-2 me-2 h6">
                                {{ lang('disk') }}
                            </span>
                            <span class="p-0 m-0 me-2 h6">
                                ({{ lang('GB') }})
                            </span>
                        </span>
                    </div>
                </div>
                <!-- medium -->
                <div class="d-flex flex-row justify-content-between align-items-center m-0 p-0 pt-0 pt-md-5">
                    <div class=" d-none d-lg-block">
                        <span class="d-flex flex-row justify-content-start align-items-center" style="width: 150px !important;">
                            <i class="bi bi-device-hdd text-secondary p-0 m-0 pe-3 h4"></i>
                            <span class="p-0 m-0 me-2 h6">
                                {{ lang('disk') }}
                            </span>
                            <span class="p-0 m-0 me-2 h6">
                                ({{ lang('GB') }})
                            </span>
                        </span>
                    </div>
                    <input v-model="RangeValueDiskString" type="range" class="form-range" :min="config.planConfig.Disk.min" :max="planMaxDiskSize" :step="config.planConfig.Disk.step" id="DiskPriceRange">
                    <input v-model="RangeValueDiskString" type="text" class="form-control ms-3 text-center m-0 p-0 py-1" style="width: 60px;" :min="config.planConfig.Disk.min" :max="planMaxDiskSize" :step="config.planConfig.Disk.step" id="DiskPriceRange">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end plan -->
