<!-- Configure plans -->
<div v-if="planIsSelected" class="row m-0 p-0 py-5 my-5 border border-2 p-4 bg-body-secondary rounded-4 me-md-2" style="height: 550px;">    
    <div class="col-12" style="--bs-bg-opacity: 0.1;">
        <!-- title -->
        <div class="row">
            <div class="m-0 p-0">
                <span class="text-dark">
                    <span class="h3">
                        {{ lang('configuration') }}
                    </span>
                    <span v-if="planName != null" class="h4">
                        "{{ planName }}"
                    </span>
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
            <!-- Overall -->
            <div class="row">
                <div class="d-flex flex-row justify-content-end align-items-center m-0 p-0 mt-5 mb-4">
                    <div class="">
                        <span class="">
                            <span class="btn btn-secondary py-2" v-if="RangeValueOverallString < 20">
                                {{ lang('nanoconfiguration') }}
                            </span>
                            <span class="btn btn-success py-2" v-if="RangeValueOverallString > 19 && RangeValueOverallString < 40">
                                {{ lang('basicconfiguration') }}
                            </span>
                            <span class="btn btn-info py-2" v-if="RangeValueOverallString > 39 && RangeValueOverallString < 60">
                                {{ lang('standardconfiguration') }}
                            </span>
                            <span class="btn btn-warning py-2" v-if="RangeValueOverallString > 59 && RangeValueOverallString < 80">
                                {{ lang('advancedconfiguration') }}
                            </span>
                            <span class="btn btn-primary py-2" v-if="RangeValueOverallString > 79">
                                {{ lang('enterpriseconfiguration') }}
                            </span>
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between align-items-center m-0 p-0 pt-0 mt-3">
                    <input v-model="RangeValueOverallString" type="range" class="form-range" min=1 max=100 step=1 id="totalvalue">
                </div>
            </div>



            <!-- Memory -->
            <div class="row mt-5 pt-5">
                <!-- small -->
                <div class="d-block d-lg-none m-0 p-0">
                    <div class="col-12 mt-3 mb-3" style="width: 120px !important;">
                        <span class="d-flex flex-row justify-content-start align-items-center">
                            <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/ramicon.svg" alt="Memory">
                            <span class="p-0 m-0 h6 ms-2 me-2">
                                {{ lang('memory') }}
                            </span>
                        </span>
                    </div>
                </div>
                <!-- medium -->
                <div class="d-flex flex-row justify-content-between align-items-center m-0 p-0 pt-0 pt-md-4">
                    <div class=" d-none d-lg-block">
                        <span class="d-flex flex-row justify-content-start align-items-center" style="width: 120px !important;">
                            <img class="text-secondary p-0 m-0 pe-3" src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/ramicon.svg" alt="Memory">
                            <span class="p-0 m-0 me-2 h6">
                                {{ lang('memory') }}
                            </span>
                        </span>
                    </div>
                    <div class="progress w-100 rounded-5 bg-primary" role="progressbar" aria-label="Memory" :aria-valuenow="RangeValueMemoryString" aria-valuemin="planConfig.Memory.min" :aria-valuemax="planMaxMemorySize" style="height: 25px; --bs-bg-opacity: 0.1;">
                        <div v-if="RangeValueOverall < 15" class="progress-bar m-0 p-0 fs-6 bg-primary" style="width: 20%; --bs-bg-opacity: 0.7;">{{ RangeValueMemoryString }} {{ lang('GB') }}</div>
                        <div v-if="RangeValueOverall > 14" class="progress-bar m-0 p-0 fs-6" :style="{ width: RangeValueOverall + '%'}">{{ RangeValueMemoryString }} {{ lang('GB') }}</div>
                    </div>
                </div>
            </div>

            <!-- CpuCore -->
            <div class="row">
                <!-- small -->
                <div class="d-block d-lg-none m-0 p-0">
                    <div class="col-12 mt-3 mb-3" style="width: 120px !important;">
                        <span class="d-flex flex-row justify-content-start align-items-center">
                            <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/cpuicon.svg" alt="CpuCore">
                            <span class="p-0 m-0 h6 ms-2 me-2">
                                {{ lang('cpu') }}
                            </span>
                        </span>
                    </div>
                </div>
                <!-- medium -->
                <div class="d-flex flex-row justify-content-between align-items-center m-0 p-0 pt-0 pt-md-5">
                    <div class=" d-none d-lg-block">
                        <span class="d-flex flex-row justify-content-start align-items-center" style="width: 120px !important;">
                            <img class="text-secondary p-0 m-0 pe-3" src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/cpuicon.svg" alt="CpuCore">
                            <span class="p-0 m-0 me-2 h6">
                                {{ lang('cpu') }}
                            </span>
                        </span>
                    </div>
                    <div class="progress w-100 rounded-5 bg-primary" role="progressbar" aria-label="CpuCorePriceRange" :aria-valuenow="RangeValueCpuCoreString" aria-valuemin="planConfig.CpuCore.min" :aria-valuemax="planMaxCpuCore" style="height: 25px; --bs-bg-opacity: 0.1;">
                        <div v-if="RangeValueOverall < 15" class="progress-bar m-0 p-0 fs-6 bg-primary" style="width: 20%; --bs-bg-opacity: 0.7;">{{ RangeValueCpuCoreString }} {{ lang('ghz') }}, {{ RangeValueCpuCoreString }} {{ lang('core') }}</div>
                        <div v-if="RangeValueOverall > 14" class="progress-bar m-0 p-0 fs-6" :style="{ width: RangeValueOverall + '%'}">{{ RangeValueCpuCoreString }} {{ lang('ghz') }}, {{ RangeValueCpuCoreString }} {{ lang('core') }}</div>
                    </div>
                </div>
            </div>

            <!-- Disk -->
            <div class="row">
                <!-- small -->
                <div class="d-block d-lg-none m-0 p-0">
                    <div class="col-12 mt-3 mb-3" style="width: 120px !important;">
                        <span class="d-flex flex-row justify-content-start align-items-center">
                            <i class="bi bi-device-hdd bi bi-hdd-network text-secondary p-0 m-0 h6"></i>
                            <span class="p-0 m-0 ms-2 me-2 h6">
                                {{ lang('disk') }}
                            </span>
                        </span>
                    </div>
                </div>
                <!-- medium -->
                <div class="d-flex flex-row justify-content-between align-items-center m-0 p-0 pt-0 pt-md-5">
                    <div class=" d-none d-lg-block">
                        <span class="d-flex flex-row justify-content-start align-items-center" style="width: 120px !important;">
                            <i class="bi bi-device-hdd text-secondary p-0 m-0 pe-3 h4"></i>
                            <span class="p-0 m-0 me-2 h6">
                                {{ lang('disk') }}
                            </span>
                        </span>
                    </div>
                    <div class="progress w-100 rounded-5 bg-primary" role="progressbar" aria-label="DiskPriceRange" :aria-valuenow="RangeValueDiskString" aria-valuemin="planConfig.Disk.min" :aria-valuemax="planMaxDiskSize" style="height: 25px; --bs-bg-opacity: 0.1;">
                        <div v-if="RangeValueOverall < 15" class="progress-bar m-0 p-0 fs-6 bg-primary" style="width: 20%; --bs-bg-opacity: 0.7;">{{ RangeValueDiskString }} {{ lang('GB') }}</div>
                        <div v-if="RangeValueOverall > 14" class="progress-bar m-0 p-0 fs-6" :style="{ width: RangeValueOverall + '%'}">{{ RangeValueDiskString }} {{ lang('GB') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end plan -->
