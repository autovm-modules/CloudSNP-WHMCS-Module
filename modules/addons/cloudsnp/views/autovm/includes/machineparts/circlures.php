<!-- same in middle, after bandwidth -->
<!-- Circular Graphs -->
<div class="row d-flex flex-row align-items-stretch m-0 p-0">

    <!--  circles -->
    <div class="col-12 col-md-8 col-xxl-9 p-0 m-0 mb-3 pe-md-2 pe-xxl-0">
        <div class="row border border-2 rounded-4 bg-white m-0 p-0 me-xxl-2 h-100 align-items-center">

            <!-- Memory -->
            <div class="d-flex flex-column col-6 col-sm-6 col-md-4 m-0 p-0 justify-content-center align-items-center">
                <div ref="ramRadial" class="ramRadial m-0 p-0"></div>
                <div v-if="isVisibe" class="row w-100 m-0 p-0">
                    <div v-if="detailIsLoaded && machineIsLoaded" class="d-flex flex-column m-0 p-0 justify-content-center align-items-center w-100 mb-3">
                        <div v-if="!theMemoryLimit || !memoryUsage" class="text-center p-0 m-0 alert alert-danger w-75 py-2">
                            <span v-if="!theMemoryLimit && memoryUsage">
                                Err: No Memory Limit
                            </span>    
                            <span v-if="theMemoryLimit && !memoryUsage">
                                Err: No Memory Usage
                            </span>    
                            <span v-if="!theMemoryLimit && !memoryUsage">
                                Err: No Memory Usage & Memory Usage
                            </span>    
                        </div>
                    </div>
                </div>
            </div>

            <!-- CPU -->
            <div class="d-flex flex-column col-6 col-sm-6 col-md-4 m-0 p-0 justify-content-center align-items-center">
                <div ref="cpuRadial" class="cpuRadial m-0 p-0"></div>
                <div v-if="isVisibe" class="row w-100 m-0 p-0">
                    <div v-if="detailIsLoaded && machineIsLoaded" class="d-flex flex-column m-0 p-0 justify-content-center align-items-center w-100 mb-3">
                        <div v-if="!theCpuLimit || !cpuUsage" class="text-center p-0 m-0 alert alert-danger w-75 py-2">
                            <span v-if="!theCpuLimit && cpuUsage">
                                Err: No CPU Limit
                            </span>    
                            <span v-if="theCpuLimit && !cpuUsage">
                                Err: No CPU Usage
                            </span>    
                            <span v-if="!theCpuLimit && !cpuUsage">
                                Err: No CPU Usage & CPU Usage
                            </span>    
                        </div>
                    </div>
                </div>

            </div>

            <!-- Disk -->
            <div class="d-flex flex-column col-6 col-sm-6 col-md-4 m-0 p-0 justify-content-center align-items-center">
                <div ref="diskRadial" class="diskRadial m-0 p-0 d-none d-md-block"></div>
                <div v-if="isVisibe" class="row w-100 m-0 p-0">
                    <div v-if="detailIsLoaded && machineIsLoaded" class="d-flex flex-column m-0 p-0 justify-content-center align-items-center w-100 mb-3">
                        <div v-if="!diskSize || !diskUsage" class="text-center p-0 m-0 alert alert-danger w-75 py-2">
                            <span v-if="!diskSize && diskUsage">
                                Err: No Disk Limit
                            </span>    
                            <span v-if="diskSize && !diskUsage">
                                Err: No Disk Usage
                            </span>    
                            <span v-if="!diskSize && !diskUsage">
                                Err: No Disk Usage & Disk Usage
                            </span>    
                        </div>
                    </div>
                </div>
                <div v-if="isVisibe && DiskErrorOverFlow" class="row w-100 m-0 p-0">
                    <div v-if="detailIsLoaded && machineIsLoaded" class="d-flex flex-column m-0 p-0 justify-content-center align-items-center w-100 mb-3">
                        <div v-if="diskSize && diskUsage" class="text-center p-0 m-0 alert alert-danger w-75 py-2">
                            <span v-if="DiskErrorOverFlow">
                                Err: Disk Overflow, not availible
                            </span>    
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end circles -->
 
    <!-- same From Here from 51 ------------------>
    <!-- Buttons disable to process -->
    <div v-if="actionStatus == 'pending' || actionStatus == 'processing'" class="col-12 col-md-4 col-xxl-3 p-0 m-0 mb-3">
        <div class="m-0 p-0 h-100">
            <div class="row m-0 p-0">
                <div class="col-6 col-lg-6 m-0 p-0 px-1 mb-2">
                    <div @click="doReboot" data-bs-toggle="modal" data-bs-target="#processingModal"
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/resetbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('rebootaction') }}</p>
                    </div>
                </div>
                <div @click="doStop" data-bs-toggle="modal" data-bs-target="#processingModal"
                    class="col-6 col-lg-6 m-0 m-0 p-0 px-1 pe-md-0 mb-2">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/offbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('stopaction') }}</p>
                    </div>
                </div>

                <div @click="doConsole" data-bs-toggle="modal" data-bs-target="#processingModal"
                    class="col-6 col-lg-6 m-0 p-0 px-1">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/setupbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('consoleaction') }}</p>
                    </div>
                </div>
                <div @click="doStart" data-bs-toggle="modal" data-bs-target="#processingModal"
                    class="col-6 col-lg-6 m-0 p-0 ps-1">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/onbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('startaction') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end Buttons -->

    <!-- Buttons enabled -->
    <div v-else class="col-12 col-md-4 col-xxl-3 p-0 m-0 mb-3">
        <div class="m-0 p-0 h-100">
            <div class="row m-0 p-0">
                <div class="col-6 col-lg-6 m-0 p-0 px-1 mb-2">
                    <div @click="doReboot" data-bs-toggle="modal" data-bs-target="#actionsModal"
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/resetbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('rebootaction') }}</p>
                    </div>
                </div>
                <div @click="doStop" data-bs-toggle="modal" data-bs-target="#actionsModal"
                    class="col-6 col-lg-6 m-0 m-0 p-0 px-1 pe-md-0 mb-2">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/offbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('stopaction') }}</p>
                    </div>
                </div>

                <div @click="doConsole" data-bs-toggle="modal" data-bs-target="#consoleModal"
                    class="col-6 col-lg-6 m-0 p-0 px-1">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/setupbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('consoleaction') }}</p>
                    </div>
                </div>
                <div @click="doStart" data-bs-toggle="modal" data-bs-target="#actionsModal"
                    class="col-6 col-lg-6 m-0 p-0 ps-1">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="<?php echo($PersonalRootDirectoryURL); ?>/modules/addons/cloudsnp/views/autovm/includes/assets/img/onbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('startaction') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end Buttons -->


</div>
<!-- Circular Graphs -->
