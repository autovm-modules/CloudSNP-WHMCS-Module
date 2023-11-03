<!-- SAME -->










<!-- for Processing status -->
<div class="modal fade modal-lg" id="processingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="processingModalLabel"
aria-hidden="false">
    <div class="modal-dialog ">
        <div class="modal-content border-0">
            
            <!-- Modal Body -->
            <div class="m-0 p-0">
                <div class="modal-body" style="min-height: 150px !important;">
                    <div class="row m-0 p-0">
                        <div class="col-12">
                            
                            <!-- Fetching info -->
                            <div v-if="!machineIsLoaded" class="row mt-5">
                                <p class="text-start h5 py-3">
                                    <span class="text-dark">{{ lang('loadingmsglong') }}</span>
                                </p>
                            </div>

                            <!-- Action pending -->
                            <div v-if="machineIsLoaded" class="row mt-5">
                                <p class="text-start h5 py-3">
                                    <span class="text-dark">{{ lang('lastactionpending') }}</span>
                                </p>
                            </div>
                            
                            <!-- console running alert -->
                            <div v-if="machineIsLoaded" class="m-0 p-0">
                                <div v-if="consoleIsPending || consoleIsProcessing" class="row px-5">
                                    <p class="fs-6 alert alert-primary">{{ lang('consoleisrunningalery') }}</p>
                                </div>
                            </div>

                            <div v-if="machineIsLoaded && !consoleIsPending && !consoleIsProcessing" class="row px-5">
                                <ul class="">
                                    <li class="">
                                        <span class="">{{ lang('lastaction') }}</span>
                                        <span v-if="actionMethod == 'reboot'">{{ lang('rebootaction') }}</span>
                                        <span v-if="actionMethod == 'stop'">{{ lang('stopaction') }}</span>
                                        <span v-if="actionMethod == 'start'">{{ lang('startaction') }}</span>
                                        <span v-if="actionMethod == 'console'">{{ lang('consoleaction') }}</span>
                                        <span v-if="actionMethod == 'setup'">{{ lang('setup') }}</span>
                                        <span v-if="actionMethod == 'destroy'">{{ lang('destroyaction') }}</span>
                                        <span v-if="actionMethod == 'suspend'">{{ lang('suspend') }}</span>
                                        <span v-if="actionMethod == 'unsuspend'">{{ lang('unsuspend') }}</span>
                                        <span v-if="actionMethod == 'snapshot'">{{ lang('snapshot') }}</span>
                                        
                                        <!-- Anyother action -->
                                        <span v-if="actionMethod && actionMethod != 'reboot' && actionMethod != 'stop' && actionMethod != 'start' && actionMethod != 'console' && actionMethod != 'setup' && actionMethod != 'destroy' && actionMethod != 'suspend' && actionMethod != 'unsuspend' && actionMethod != 'snapshot'">???</span>
                                    </li>
                                    
                                    <!-- status -->
                                    <li class="">
                                        <span class="">{{ lang('status') }}</span>
                                        <span class="px-1">:</span>

                                        <span class="text-danger" v-if="actionStatus == 'pending'">
                                            <span>{{ lang('actionstatuspending') }}</span>    
                                            <span class="spinner-grow m-0 p-0 ms-2 align-middle" style="--bs-spinner-width: 6px; --bs-spinner-height: 6px; --bs-spinner-animation-speed: 1s;"></span>
                                            <span class="spinner-grow m-0 p-0 ms-2 align-middle" style="--bs-spinner-width: 6px; --bs-spinner-height: 6px; --bs-spinner-animation-speed: 1s;"></span>
                                            <span class="spinner-grow m-0 p-0 ms-2 align-middle" style="--bs-spinner-width: 6px; --bs-spinner-height: 6px; --bs-spinner-animation-speed: 1s;"></span>
                                        </span>

                                        <span class="text-primary" v-if="actionStatus == 'processing'">
                                            <span>{{ lang('actionstatusprocessing') }}</span>
                                            <span class="spinner-grow m-0 p-0 ms-2 align-middle" style="--bs-spinner-width: 6px; --bs-spinner-height: 6px; --bs-spinner-animation-speed: 1s;"></span>
                                            <span class="spinner-grow m-0 p-0 ms-2 align-middle" style="--bs-spinner-width: 6px; --bs-spinner-height: 6px; --bs-spinner-animation-speed: 1s;"></span>
                                            <span class="spinner-grow m-0 p-0 ms-2 align-middle" style="--bs-spinner-width: 6px; --bs-spinner-height: 6px; --bs-spinner-animation-speed: 1s;"></span>
                                        </span>
                                        
                                        <span class="text-dark" v-if="actionStatus == 'completed'">
                                            <span>{{ lang('actionstatuscompleted') }}</span>
                                        </span>
                                        
                                        <span class="text-danger" v-if="actionStatus == 'failed'">
                                            <span>{{ lang('failed') }}</span>
                                        </span>

                                    </li>
                                </ul>
                            </div>
                            <button @click="closeConfirmDialog" type="button" class="btn btn-secondary px-4 mx-2 border-0 mt-5 float-end" style="background-color: #515151" data-bs-dismiss="modal">
                                {{ lang('close') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Body -->

        </div>
    </div>
</div><!-- end modal -->
