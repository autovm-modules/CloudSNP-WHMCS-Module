<!-- Same -->









<!-- for Three action (start, stop, reboot) -->
<div class="modal fade modal-lg" id="actionsModal"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="actionModalLabel"
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
                    
                    <!-- failed (ConfirmDialog=true)-->
                    <div v-if="actionStatus == 'failed' && confirmDialog  && !isBetweenPending" class="row m-0 p-0 mt-4">
                        <div v-if="confirmTitle" class="col-12">
                            <p class="text-start h5 mt-4">{{ lang('failactionmsg') }}</p>
                        </div>
                        <div v-if="!confirmTitle" class="col-12">
                            <p class="text-start h4 mt-4">Error NO Action</p>
                        </div>
                    </div>

                
                    <!-- Completed and Just open (ConfirmDialog=true)-->
                    <div v-if="actionStatus == 'completed' && confirmDialog && !isBetweenPending" class="row m-0 p-0 mt-4">
                        <div v-if="confirmTitle" class="col-12">
                            <p class="text-start h4 mt-4">{{ lang('confirmtext') }}</p>
                            <p class="text-start h5 py-3">
                                {{ lang('goingto') }}                                        
                                <span class="text-primary px-0" v-if="confirmTitle == 'reboot'">{{ lang('rebootaction') }}</span>
                                <span class="text-primary px-0" v-if="confirmTitle == 'stop'">{{ lang('stopaction') }}</span>
                                <span class="text-primary px-0" v-if="confirmTitle == 'start'">{{ lang('startaction') }}</span>
                                {{ lang('yourmachine') }}
                            </p>
                        </div>
                        <div v-if="!confirmTitle" class="col-12">
                            <p class="text-start h4 mt-4">Error NO Action</p>
                        </div>
                    </div>

                    
                    <!-- actionStatus == 'pending' -->
                    <!-- actionStatus == 'processing' -->
                    <div v-if="actionStatus == 'pending' || actionStatus == 'processing' || isBetweenPending" class="row m-0 p-0 mt-4">
                        <div v-if="confirmTitle" class="col-12">
                            <p class="text-start h5 py-3">
                            {{ lang('thiscommand') }}
                            </p>
                        </div>
                        <div v-if="!confirmTitle" class="col-12">
                            <p class="text-start h4 mt-4">Error NO Action</p>
                        </div>
                    </div>
                    

                    <!-- Completed and Just Accecpt (ConfirmDialog=false)-->
                    <div v-if="actionStatus == 'completed' && !confirmDialog && !isBetweenPending" class="row m-0 p-0 mt-4">
                        <div v-if="confirmTitle" class="col-12">
                            <p class="text-start h5 py-3">
                                {{ lang('yourcommand') }}                                        
                                <span class="text-primary px-0" v-if="confirmTitle == 'reboot'">{{ lang('rebootaction') }}</span>
                                <span class="text-primary px-0" v-if="confirmTitle == 'stop'">{{ lang('stopaction') }}</span>
                                <span class="text-primary px-0" v-if="confirmTitle == 'start'">{{ lang('startaction') }}</span>
                                {{ lang('hasdonesuccessfully') }}
                            </p>
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
                        <button @click="closeConfirmDialog" type="button" class="btn btn-secondary px-4 mx-2 border-0" data-bs-dismiss="modal">
                            {{ lang('close') }}
                        </button>
                    
                        <!-- Action BTN 'completed' -->
                        <div v-if="(actionStatus == 'completed' || actionStatus == 'failed') && confirmDialog">
                            <button @click="acceptConfirmDialog" type="button" class="btn btn-primary px-5 mx-2">
                                <span v-if="confirmTitle == 'reboot'">{{ lang('rebootaction') }}</span>
                                <span v-if="confirmTitle == 'stop'">{{ lang('stopaction') }}</span>
                                <span v-if="confirmTitle == 'start'">{{ lang('startaction') }}</span>
                            </button>
                        </div>

                        <!-- Show State BTN -->
                        <div v-if="actionStatus == 'pending' || actionStatus == 'processing'">
                            <button type="button" class="btn btn-primary px-5 mx-2">
                                <span v-if="confirmTitle == 'reboot'">{{ lang('rebooting') }}</span>
                                <span v-if="confirmTitle == 'stop'">{{ lang('stoping') }}</span>
                                <span v-if="confirmTitle == 'start'">{{ lang('starting') }}</span>

                                <!-- spinner -->
                                <span class="spinner-grow text-light my-auto mb-0 align-middle ms-1" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                <span class="spinner-grow text-light my-auto mb-0 align-middle mx-1" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                <span class="spinner-grow text-light my-auto mb-0 align-middle me-1" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                            </button>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div><!-- end modal -->