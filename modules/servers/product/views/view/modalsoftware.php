<!-- Software modal  -->
<div class="modal fade modal-lg" id="softwareModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="softwareModalLabel"
aria-hidden="false">
    <div class="modal-dialog ">
        <div class="modal-content border-0">
            <!-- Modal Body -->
            <div class="m-0 p-0">

                <!-- machine is not yet loaded -->
                <div v-if="!machineIsLoaded" class="modal-body bg-white" style="min-height: 350px !important;">
                    <div class="row m-0 p-0">
                        <div class="col-12">
                            <p class="text-start h5 py-3">
                                <span class="text-primary">
                                    {{ lang('waittofetch') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
        
                <!-- machine is Loaded -->
                <div v-if="machineIsLoaded" class="modal-body" style="min-height: 350px !important;">
                    
                    <!-- for Software Instalation -->
                    <div v-if="actionStatus == 'pending'">
                        
                        <!-- last action is pending -->
                        <div v-if="showPendingMsg">
                            <div class="row m-0 p-0 pt-5">
                                <div class="col-12 col-md-9 text-start">
                                    <p class="text-start h5 py-3">{{ lang('lastactionpending') }}</p>
                                    <p>{{ lang('waitforsetup') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- During installation -->
                        <div class="m-0 p-0" v-if="!showPendingMsg">
                            <div v-if="!showBTN" class="row m-0 p-0">
                                <div class="col-12 col-md-9 text-start">
                                    <p class="text-start h4 py-3">
                                        <span>{{ lang('machineisinstalling') }}</span>
                                        <span class="text-primary" v-text="findSoftware"></span>
                                    </p>
                                    <p class="fs-5">{{ lang('dontclose') }}</p>
                                
                                    <div class="row m-0 p-0 mt-5">
                                        <div class="col-12">
                                            <!-- Progressive bar -->
                                            <p class="text-primary h6 mt-5">{{ lang('willtake') }}</p>
                                            <div class="progress my-3" role="progressbar" aria-label="Basic example" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="10" >
                                                <div class="progress-bar" role="progressbar" :style="{ width: progress + '%' }">
                                                    {{ progress }}%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- status complete (1Ready, 2Finished) -->
                    <div v-if="actionStatus == 'completed'">
                        <!-- status complete: 1Ready to install, just open the window -->
                        <div v-if="showBTN">
                            <div class="row m-0 p-0">
                                <div class="col-12 col-md-9">
                                    <p class="text-start h4 mt-4">{{ lang('confirmtext') }}</p>
                                    <p class="text-start h5 py-3">
                                        {{ lang('goingtoinstall') }}
                                        (<span class="text-primary fw-bold px-0" v-text="findSoftware"></span>)
                                        {{ lang('onyourmachine') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- status complete: 2 instalation finished-->
                        <div v-if="!showBTN">
                            <div class="row m-0 p-0">
                                <div class="col-12 col-md-9">
                                    <p class="text-start h5 py-3">
                                        <span class="text-primary pe-3" v-text="findSoftware"></span>
                                        <span>{{ lang('installedsuccessfully') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- status failed -->
                    <div v-if="actionStatus == 'failed'">
                        <div v-if="showBTN">
                            <div class="row m-0 p-0">
                                <div class="col-12 col-md-9">
                                    <p class="text-start h4 mt-4">{{ lang('failactionmsg') }}</p>
                                    <p class="text-start h5 py-3">
                                        {{ lang('goingtoinstall') }}
                                        (<span class="text-primary fw-bold px-0" v-text="findSoftware"></span>)
                                        {{ lang('onyourmachine') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Modal Footer -->
            <div v-if="machineIsLoaded" class="d-flex flex-row modal-footer justify-content-between">
                
                <!-- Completed -->
                <div v-if="actionStatus == 'completed'" class="align-middle align-items-center">
                    <p class="p-0 m-0">
                        <span class="text-secondary fw-medium">{{ lang('lastaction') }}</span>
                        <span class="text-secondary"> {{ actionMethod.toUpperCase() }} </span>
                        <span class="text-secondary px-1"> ({{ lang('completed') }})</span>
                    </p>
                </div>
                
                <!-- Pending -->
                <div v-if="actionStatus == 'pending'" class="align-middle align-items-center">
                    <span class="text-primary h5"> {{ lang('lastaction') }} </span>
                    <span class="text-primary h5"> {{ actionMethod.toUpperCase() }} </span>
                    <span class="btn bg-danger text-danger px-2 px-md-3 px-lg-4 small ms-3" style="--bs-bg-opacity: .2;">
                        <div class="spinner-grow spinner-grow-sm" role="status"></div>
                        <span class="m-0 p-0 ps-2">{{ lang('pending') }}</span>
                    </span>
                </div>

                
                <div class="d-flex flex-row">
                    <!-- Close Btn -->
                    <button @click="closeConfirmDialog" type="button"
                        class="btn btn-secondary px-4 mx-2 border-0" style="background-color: #515151"
                        data-bs-dismiss="modal">
                        <div v-if="actionStatus == 'completed'">
                            {{ lang('close') }}                            
                        </div>

                        <!-- Close btn while pending -->
                        <div v-else-if="actionStatus == 'pending'">
                            <div class="spinner-border spinner-border-sm me-1" role="status">
                                <span class="visually-hidden">{{ lang('loadingmsg') }}</span>
                            </div>
                            {{ actionMethod.toUpperCase() }} !
                        </div>
                    </button>


                    <div v-if="actionStatus == 'completed'">
                        <div v-if="showBTN" class="m-0 p-0">
                            <button @click="acceptConfirmDialog" type="button"
                                class="btn btn-primary px-5 mx-2">
                                <span>{{ lang('install') }}</span>
                                <span class="px-1" v-text="findSoftware"></span>
                            </button>
                        </div>
                    </div>

                    <div v-if="actionStatus == 'failed'">
                        <div v-if="showBTN" class="m-0 p-0">
                            <button @click="acceptConfirmDialog" type="button"
                                class="btn btn-primary px-5 mx-2">
                                <span>{{ lang('install') }}</span>
                                <span class="px-1" v-text="findSoftware"></span>
                            </button>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</div><!-- end modal -->






