<!-- Machine details -->
<div class="row d-flex flex-row m-0 p-0">

    <!-- memory -->
    <div class="col-6 col-md-4 p-0 m-0 mb-3">
        <div class="border border-2 rounded-4 bg-white py-4 m-0 p-0 px-3 me-1">
            <div class="m-0 p-0 mb-3 text-start">
                <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/ramicon.svg" width="18">
                <span class="text-secondary m-0 p-0 ps-2">
                    {{ lang('memory') }}
                </span>
            </div>

            <div v-if="!machineIsLoaded" class="text-start m-0 p-0">
                <span class="m-0 p-0 fs-4 ps-2 text-primary">
                    ---
                </span>
            </div>
            <div v-else class="m-0 p-0 text-start">
                <span v-if="machine?.memorySize" class="m-0 p-0 fs-4 text-primary ps-1">
                    {{ machine.memorySize }}
                    {{ lang('mb') }}
                </span>
                <span v-if="!machine?.memorySize" class="m-0 p-0 fs-4 text-primary ps-2">
                    ---
                </span>
            </div>
        </div>
    </div><!-- end memory -->



    <!-- Disk -->
    <div class="col-6 col-md-4 p-0 m-0 mb-3">
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-3 px-md-4 ms-1 me-md-1">
            <div class="m-0 p-0 mb-3 text-start">
                <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/diskicon.svg" width="18">
                <span class="m-0 p-0 text-secondary ps-2">
                    {{ lang('disk') }}
                </span>
            </div>

            <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                <span class="m-0 p-0 fs-4 ps-2 text-primary">
                    ---
                </span>
            </div>
            <div v-else class="m-0 p-0 text-primary text-start">
                <span class="m-0 p-0 fs-4 text-primary ps-1">
                    {{ machine.diskSize }}
                    {{ lang('gb') }}
                </span>
            </div>
        </div>
    </div><!-- end Disk -->


    <!-- CPU -->
    <div class="col-6 col-md-4 p-0 m-0 mb-3">
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-3 px-md-4 me-1 me-md-0 ms-md-1">
            <div class="m-0 p-0 mb-3 text-start">
                <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/cpuicon.svg" width="18">
                <span class="m-0 p-0 text-secondary ps-2">
                {{ lang('cpu') }}
                </span>
            </div>

            <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                <span class="m-0 p-0 fs-4 ps-2 text-primary">
                    ---
                </span>
            </div>
            <div v-else class="m-0 p-0 text-primary text-start">
                <span class="m-0 p-0 fs-4 ps-1">
                    {{ machine.cpuCore }} 
                    {{ lang('core') }}
                </span>
            </div>
        </div>
    </div><!-- End CPU -->


    <!-- Template Or Software -->
    <div class="col-6 col-md-4 p-0 m-0 mb-3">
        <!-- Template -->
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-3 px-md-4 ms-1 ms-md-0 me-md-1">
            <!-- Title -->
            <div v-if="!machineIsLoaded" class="m-0 p-0 mb-3 text-start">
                <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/osicon.svg" width="18">
                <span class="m-0 p-0 text-secondary ps-2">
                    {{ lang('template') }}
                </span>
            </div><!-- end Title -->
            
            <div v-if="machineIsLoaded" class="m-0 p-0 mb-3 text-start">
                <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/osicon.svg" width="18">
                <span v-if="tempName" class="m-0 p-0 text-secondary ps-2">
                    {{ lang('template') }}
                </span>
                <span v-if="softName" class="m-0 p-0 text-secondary ps-2">
                    {{ lang('installedsoftware') }}
                </span>
            </div>
            

            <!-- Not loaded -->
            <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                <div class="p-0 m-0">    
                    <span class="m-0 p-0 fs-4 ps-2 text-primary">
                        ---
                    </span>
                </div>
            </div>

            
            <div v-if="machineIsLoaded" class="d-flex flex-row text-primary text-start align-items-center m-0 p-0">
                <!-- Has no Temp or Soft -->
                <div class="p-0 m-0" v-if="!tempName && !softName">    
                    <span class="m-0 p-0 fs-4 ps-2 text-primary">
                        ---
                    </span>
                </div>
                
                <!-- conflict -->
                <div class="p-0 m-0" v-if="tempName && softName">    
                    <span class="m-0 p-0 fs-4 ps-2 text-primary">
                        conflict
                    </span>
                </div>

                <!-- Has Template -->
                <div class="p-0 m-0" v-if="tempName && !softName">     
                    <img v-if="tempIcon != null" :src="tempIcon" alt="templateicon" width="23">
                    <img v-if="softIcon != null" :src="softIcon" alt="templateicon" width="23">
                </div>
                <span v-if="tempName" class="m-0 p-0 fs-4 ms-2">
                    {{ tempName }}
                </span>
                <span v-if="softName" class="m-0 p-0 fs-4 ms-2">
                    {{ softName }}
                </span>
            </div>
        </div>
    </div><!-- End OS -->


    <!-- UpTime -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-4 p-0 m-0 mb-3">
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-3 px-md-4 ms-0 h-100 me-0 ms-md-1 me-sm-1">
            <div class="m-0 p-0 mb-3 text-start">
                <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/uptimeicon.svg" width="18">
                <span class="m-0 p-0 text-secondary ps-2">
                    {{ lang('uptime') }}
                </span>
            </div>

            <div v-if="!detailIsLoaded" class="m-0 p-0">
                <div class="m-0 p-0 fs-4 text-start">
                    <span class="m-0 p-0 text-primary fs-5 fw-medium">
                        ---
                    </span>
                </div>
            </div>
            <div v-else>
                <div v-if="uptimeformated" class="m-0 p-0 fs-4 text-start">
                    <span v-if="uptimeformated.day" class="m-0 p-0 text-primary fs-5 fw-medium">
                        {{ uptimeformated.day }}
                        {{ lang('days') }}
                    </span>

                    <span v-if="uptimeformated.hr">
                        <span v-if="uptimeformated.day">
                            <span class="m-0 p-0 text-secondary fs-5">{{ lang('and') }}</span>
                            <span class="m-0 p-0 text-primary fs-5 fw-medium">
                                {{ uptimeformated.hr }}
                                {{ lang('hours') }}
                            </span>
                        </span>
                        <span v-else class="m-0 p-0 text-primary fs-5 fw-medium">
                            {{ uptimeformated.hr }}
                            {{ lang('hours') }}
                        </span>
                    </span>


                    <span v-if="!uptimeformated.day">
                        <span v-if="uptimeformated.minuts" class="text-primary fs-5 fw-medium">
                            <span v-if="uptimeformated.hr">
                                <span class="text-secondary fs-5"> {{ lang('and') }} </span>
                                <span class="text-primary fs-5 fw-medium">
                                    {{ uptimeformated.minuts }}
                                    {{ lang('minutes') }}
                                </span>
                            </span>
                            <span v-if="!uptimeformated.hr">
                                <span class="text-primary fs-5 fw-medium">
                                    {{ uptimeformated.minuts }}
                                    {{ lang('minutes') }}
                                </span>
                            </span>
                        </span>
                    </span>
                </div>
                <div v-else class="m-0 p-0 fs-4 text-start">
                    <span class="m-0 p-0 text-primary fs-5 fw-medium">
                        ---
                    </span>
                </div>
            </div>
        </div>
    </div><!-- end UpTime -->
    
    <!-- Traffic -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-4 p-0 m-0 mb-3 flex-grow-1">
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-3 px-md-4 h-100 mx-0 ms-0 ms-sm-1">
            <div class="d-flex flex-row align-items-end justify-content-between">
                <!-- First Column -->
                <div class="d-flex flex-column align-items-start justify-content-between">
                    <div class="m-0 p-0 mb-3 text-start">
                        <i class="bi bi-arrow-down-up"></i>
                        <span class="m-0 p-0 text-secondary ps-2">
                            {{ lang('traffic') }}
                        </span>
                    </div>
                    <div v-if="trafficTotal == null" class="m-0 p-0">
                        <span class="m-0 p-0 text-primary fs-5 fw-medium">
                            <span class="">
                                ---
                            </span>
                        </span>
                    </div>
                    <div v-if="trafficTotal != null" class="m-0 p-0">
                        <span class="m-0 p-0 text-primary fs-5 fw-medium">
                            <span>
                                {{ trafficTotal }}
                            </span>
                            <span>
                                {{ lang('gb') }}
                            </span>
                        </span>
                    </div>
                </div>
                <!-- second Column -->
                <div class="d-flex flex-column align-items-start justify-content-between d-block d-sm-none d-lg-block">
                    <div v-if="trafficReceived != null" class="m-0 p-0 text-start my-1">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <div class="m-0 p-0 me-3">
                                <span class="text-secondary" style="--bs-text-opacity: 0.7;">
                                    <i class="bi bi-cloud-download-fill h5 me-2"></i>
                                    Download :
                                </span>
                            </div>
                            <div class="m-0 p-0">
                                <span v-if="trafficReceived != null"  class="text-primary ms-2" style="--bs-text-opacity: 0.7;">
                                    <span>
                                        {{ trafficReceived }}
                                    </span>
                                    <span>
                                        {{ lang('gb') }}
                                    </span>
                                </span>
                                <span v-else class="text-primary ms-2">
                                    ---
                                </span>
                            </div>
                        </div>
                    </div>

                    <div v-if="trafficSend != null" class="m-0 p-0 text-start my-1">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <div class="m-0 p-0 me-3">
                                <span class="text-secondary" style="--bs-text-opacity: 0.7;">
                                    <i class="bi bi-cloud-upload h5 me-2"></i>
                                    Upload :
                                </span>
                            </div>
                            <div class="m-0 p-0">
                                <span v-if="trafficSend != null" class="text-primary ms-2" style="--bs-text-opacity: 0.7;">
                                    <span>
                                        {{ trafficSend }}
                                    </span>
                                    <span>
                                        {{ lang('gb') }}
                                    </span>
                                </span>
                                <span v-else class="text-primary ms-2">
                                    ---
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end Traffic -->
</div>
<!-- End Machine details -->