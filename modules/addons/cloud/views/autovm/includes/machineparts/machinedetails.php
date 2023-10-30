
<!-- Machine details -->
<div class="row d-flex flex-row m-0 p-0">

    <!-- memory -->
    <div class="col-6 col-md-4 col-xxl-2 p-0 m-0 mb-3">
        <div class="border border-2 rounded-4 bg-white py-4 m-0 p-0 px-3 me-1">
            <div class="m-0 p-0 mb-3 text-start">
                <img src="/modules/servers/product/views/view/assets/img/ramicon.svg" width="18">
                <span class="text-secondary m-0 p-0 ps-2">
                    {{ lang('memory') }}
                </span>
            </div>

            <div v-if="!machineIsLoaded" class="text-start m-0 p-0">
                <span class="m-0 p-0 fs-4 ps-2 text-primary">
                    ---
                </span>
            </div>
            <div v-if="machineIsLoaded" class="m-0 p-0 text-start">
                <span v-if="machine.memorySize" class="m-0 p-0 fs-4 text-primary ps-1">
                    {{ machine.memorySize }}
                    {{ lang('mb') }}
                </span>
                <span v-if="!machine.memorySize" class="m-0 p-0 fs-4 text-primary ps-1">
                    ---
                </span>
            </div>
        </div>
    </div><!-- end memory -->



    <!-- Disk -->
    <div class="col-6 col-md-4 col-xxl-2 p-0 m-0 mb-3">
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-3 px-md-4 ms-1 me-md-1">
            <div class="m-0 p-0 mb-3 text-start">
                <img src="/modules/servers/product/views/view/assets/img/diskicon.svg" width="18">
                <span class="m-0 p-0 text-secondary ps-2">
                    {{ lang('disk') }}
                </span>
            </div>

            <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                <span class="m-0 p-0 fs-4 ps-2 text-primary">
                    ---
                </span>
            </div>
            <div v-if="machineIsLoaded" class="m-0 p-0 text-primary text-start">
                <span v-if="machine.diskSize"class="m-0 p-0 fs-4 text-primary ps-1">
                    {{ machine.diskSize }}
                    {{ lang('gb') }}
                </span>
                <span v-if="!machine.diskSize"class="m-0 p-0 fs-4 text-primary ps-1">
                    ---
                </span>
            </div>
        </div>
    </div><!-- end Disk -->



    <!-- CPU -->
    <div class="col-12 col-md-4 col-xxl-2 p-0 m-0 mb-3">
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-3 px-md-4 mx-0 me-1 me-md-0 ms-md-1 me-xxl-1">
            <div class="m-0 p-0 mb-3 text-start">
                <img src="/modules/servers/product/views/view/assets/img/cpuicon.svg" width="18">
                <span class="m-0 p-0 text-secondary ps-2">
                    {{ lang('cpu') }}
                </span>
            </div>

            <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                <span class="m-0 p-0 fs-4 ps-2 text-primary">
                    ---
                </span>
            </div>
            <div v-if="machineIsLoaded" class="m-0 p-0 text-primary text-start">
                <span v-if="machine.cpuCore"class="m-0 p-0 fs-4 ps-1">
                    {{ machine.cpuCore }} 
                    {{ lang('core') }}
                </span>
                <span v-if="!machine.cpuCore"class="m-0 p-0 fs-4 ps-1">
                    ---
                </span>
            </div>
        </div>
    </div><!-- End CPU -->


    <!-- Template OS -->
    <div class="col-12 col-md-4 col-xxl-3 p-0 m-0 mb-3">
        <div
            class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-3 px-md-4 ms-1 ms-md-0 me-md-1 ms-xxl-1">
            <div class="m-0 p-0 mb-3 text-start">
                <img src="/modules/servers/product/views/view/assets/img/osicon.svg" width="18">
                <span class="m-0 p-0 text-secondary ps-2">
                    {{ lang('template') }}
                </span>
            </div>

            <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                <span class="m-0 p-0 fs-4 ps-2 text-primary">
                    ---
                </span>
            </div>

            <div v-if="machineIsLoaded" class="d-flex flex-row text-primary text-start align-items-center m-0 p-0">
                <div v-if="tempIcon" class="p-0 m-0">     
                    <img :src="tempIcon" alt="templateicon" width="23">
                </div>
                <span v-if="tempName" class="m-0 p-0 fs-4 ms-2">
                    {{ tempName }}
                </span>
                <span v-if="!tempName" class="m-0 p-0 fs-4 ms-2">
                    ---
                </span>
            </div>
        </div>
    </div><!-- End OS -->


    <!-- UpTime -->
    <div class="col-12 col-sm-6 col-md-4 col-xxl-auto p-0 m-0 mb-3 flex-grow-1">
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-3 px-md-4 mx-0 ms-md-1 h-100">
            <div class="m-0 p-0 mb-3 text-start">
                <img src="/modules/servers/product/views/view/assets/img/uptimeicon.svg" width="18">
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
            <div v-if="detailIsLoaded" >
                <div v-if="uptimeformated && uptimeformated.minuts" class="m-0 p-0 fs-4 text-start">
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
                <div v-if="!uptimeformated" class="m-0 p-0 fs-4 text-start">
                    <span class="m-0 p-0 text-primary fs-5 fw-medium">
                        ---
                    </span>
                </div>
            </div>
        </div>
    </div><!-- end UpTime -->
    
</div>
<!-- End Machine details -->