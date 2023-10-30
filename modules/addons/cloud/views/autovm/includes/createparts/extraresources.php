<!-- Extra Resource -->
<div class="row m-0 p-0 py-5 my-5">
    <div class="col-12 m-0 p-0" style="--bs-bg-opacity: 0.1;">
        <div class="border rounded-4 py-5 px-3 px-lg-5">
            <div class="m-0 p-0 pt-5">
                <p class="text-dark h5">
                    {{ lang('extraresource') }}
                </p>
                <p class="fs-6 pt-1 text-secondary">
                    {{ lang('orderextra') }}
                </p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row justify-content-end pb-5">
                        <div class="col-12 px-4 px-md-5">
                            
                            <!-- CPU -->
                            <div class="row my-5">
                                <div class="col-12 col-md-2 p-0 m-0 text-start mb-3">
                                    <img src="/modules/addons/cloud/views/autovm/includes/assets/img/cpuicon.svg" alt="cpuicon">
                                <span class="p-0 m-0 ps-1 ps-md-3">
                                    {{ lang('cpu') }}
                                </span>
                                </div>
                                
                                <div class="col-12 col-md-10 col-lg-8 col-xxl-7 p-0 m-0 flex-grow-1 mb-4">
                                    <div class="progress rounded-5 flex-grow-1" 
                                    style="height:20px"
                                    role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> 
                                    <div class="progress-bar rounded-5" style="width: 30%; height:20px">
                                        4
                                        {{ lang('core') }}
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end CPU -->

                            <!-- Memory -->
                            <div class="row my-5">
                                <div class="col-12 col-md-2 p-0 m-0 text-start mb-3">
                                    <img src="/modules/addons/cloud/views/autovm/includes/assets/img/ramicon.svg" alt="cpuicon">
                                    <span class="p-0 m-0 ps-1 ps-md-3">
                                        {{ lang('memory') }}
                                    </span>
                                </div>
                                
                                <div class="col-12 col-md-10 col-lg-8 col-xxl-7 p-0 m-0 flex-grow-1 mb-4">
                                    <div class="progress rounded-5 flex-grow-1" style="height:20px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar rounded-5" style="width: 30%; height:20px">
                                            4 {{ lang('gb') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end Memory -->

                            <!-- Storage -->
                            <div class="row my-5">
                                <div class="col-12 col-md-2 p-0 m-0 text-start mb-3">
                                    <img src="/modules/addons/cloud/views/autovm/includes/assets/img/diskicon.svg" alt="cpuicon">
                                    <span class="p-0 m-0 ps-1 ps-md-3">
                                        {{ lang('disk') }}
                                    </span>
                                </div>
                                
                                <div class="col-12 col-md-10 col-lg-8 col-xxl-7 p-0 m-0 flex-grow-1 mb-4">
                                    <div class="progress rounded-5 flex-grow-1" style="height:20px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar rounded-5" style="width: 60%; height:20px">
                                            50 {{ lang('gb') }}
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end Storage -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Extra Resource -->