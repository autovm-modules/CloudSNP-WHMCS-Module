<!-- SAMECODE -->









<!-- for Three action (start, stop, reboot) -->
<div class="modal fade modal-lg" id="consoleModal"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ConsoleModalLabel"
aria-hidden="false">
    <div class="modal-dialog ">
    
        <div class="modal-content border-0">
            <!-- Modal Body -->
            <div class="m-0 p-0">           

                <!-- machine is not yet loaded -->
                <div v-if="!machineIsLoaded" class="modal-body px-4 px-md-5" style="min-height: 100px !important;">
                    <div class="row m-0 p-0">
                        <div class="col-12">
                            <p class="text-start h5 py-5">
                                <span class="alert">{{ lang('waittofetch') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- machine is loaded, ready for action -->
                <div v-if="machineIsLoaded" class="modal-body px-4 px-md-5" style="min-height: 350px !important;">

                    <!-- consoleIsCompleted -->
                    <div v-if="consoleIsCompleted" class="row m-0 p-0 mt-4">
                        <div class="col-12 m-0 p-0">
                            <div class="row justify-content-start px-3">
                                <p class="text-start h5 mt-4">
                                    {{ lang('accessconsole') }}
                                </p>
                            </div>
                            <div class="row justify-content-end px-3 pt-5">
                                <button v-on:click="openConsole" class="col-auto btn btn-primary mt-3">
                                    <i class="bi bi-pc-display me-3"></i>    
                                    {{ lang('openconsole') }}
                                </button>
                            </div>
                        </div>
                        <div v-if="!confirmTitle" class="col-12">
                            <p class="text-start h4 mt-4">Error NO Action</p>
                        </div>
                    </div>
                    
                    
                    <!-- consoleIsFailed -->
                    <div v-if="consoleIsFailed" class="row m-0 p-0 mt-4">
                        <div class="col-12 m-0 p-0">
                            <div class="row justify-content-start px-3">
                                <p class="text-start h5 mt-4">
                                    {{ lang('consolefailed') }}
                                </p>
                            </div>
                        </div>
                        <div v-if="!confirmTitle" class="col-12">
                            <p class="text-start h4 mt-4">Error NO Action</p>
                        </div>
                    </div>
                    
                    <!-- actionStatus == 'pending' OR 'processing'-->                    
                    <div v-if="consoleIsPending || consoleIsProcessing" class="row m-0 p-0 mt-4">
                        <div v-if="confirmTitle" class="col-12">
                            <p class="text-start h4 mt-4">
                                {{ lang('lastactionpending') }}
                            </p>
                            <p class="text-start h5 mt-4 fw-light">
                                {{ lang('thiscommand') }}
                            </p>
                        </div>
                        <div v-if="!confirmTitle" class="col-12">
                            <p class="text-start h4 mt-4">Error NO Action</p>
                        </div>
                    </div>
                

                    <!-- None of them -->    
                    <div v-if="!consoleIsCompleted && !consoleIsFailed && !consoleIsPending && !consoleIsProcessing" class="row m-0 p-0 mt-4">
                        <div class="col-12 m-0 p-0">
                            <div class="row text-end justify-content-start px-3">
                                <p class="text-start h4 mt-4">
                                    {{ lang('confirmtext') }}
                                </p>
                                <p class="text-start h5 mt-4 fw-light">
                                    {{ lang('requestgetlink') }}  
                                </p>
                            </div>
                        </div>
                        <div v-if="!confirmTitle" class="col-12">
                            <p class="text-start h4 mt-4">Error NO Action</p>
                        </div>
                    </div>

                </div>

            </div>
            <!-- End Body -->


            <!-- Modal Footer -->
            <div class="m-0 p-0">
                
                <!-- Not data, or pending -->
                <div v-if="!machineIsLoaded" class="d-flex flex-row-reverse modal-footer justify-content-between">      
                    <div class="d-flex flex-row-reverse">
                        <button @click="closeConfirmDialog" type="button" class="btn btn-secondary px-4 mx-2 border-0" data-bs-dismiss="modal">
                            {{ lang('close') }}
                        </button>
                    </div>
                </div>    




                <!-- Completed, Just open (ConfirmDialog=true)-->
                <div v-if="machineIsLoaded" class="d-flex flex-row modal-footer justify-content-between">
                    <!-- Last Action -->
                    <?php include('lastaction.php'); ?>

                    
                    <div class="d-flex flex-row align-items-center">
                        
                        <!-- pending or processing -->
                        <button @click="closeConfirmDialog" type="button" class="btn btn-secondary px-4 mx-2 border-0" data-bs-dismiss="modal">
                            {{ lang('close') }}
                        </button>
                    
                        <!-- Action BTN 'consoleIsCompleted' -->
                        <div v-if="consoleIsCompleted && !consoleIsPending && !consoleIsProcessing">
                            <button @click="acceptConfirmDialog" type="button" class="btn btn-primary px-5 mx-2">
                                <span>{{ lang('tryagain') }}</span>
                            </button>
                        </div>
                        
                        <!-- Action BTN 'failed' -->
                        <div v-if="consoleIsFailed && !consoleIsPending && !consoleIsProcessing">
                            <button @click="acceptConfirmDialog" type="button" class="btn btn-primary px-5 mx-2">
                                <span>{{ lang('tryagain') }}</span>
                            </button>
                        </div>

                        <!-- Action BTN 'none of them' -->
                        <div v-if="!consoleIsCompleted && !consoleIsFailed && !consoleIsPending && !consoleIsProcessing">
                            <button @click="acceptConfirmDialog" type="button" class="btn btn-primary px-5 mx-2">
                                <span>{{ lang('consoleaction') }}</span>
                            </button>
                        </div>

                        <!-- pending or processing -->
                        <div v-if="consoleIsPending || consoleIsProcessing">
                            <button type="button" class="btn btn-primary px-5 mx-2">
                                <span>{{ lang('consoleing') }}</span>
                                <!-- spinner -->
                                <span class="spinner-grow text-light my-auto mb-0 ms-1" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                <span class="spinner-grow text-light my-auto mb-0 mx-1" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                <span class="spinner-grow text-light my-auto mb-0 me-1" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                            </button>
                        </div> 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div><!-- end modal -->