

<!-- For Distroy -->
<div class="modal fade modal-lg" id="destroyModal"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="DestroyModalLabel"
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
                    
                    <!-- Completed and Just open (ConfirmDialog=true)-->
                    <div v-if="actionStatus == 'completed' && confirmDialog && !isBetweenPending" class="row m-0 p-0 mt-4">
                        <div v-if="confirmTitle" class="">
                            <label for="confirmdestroytext" class="mt-5 h5 lh-lg">
                                <span>{{ lang('todeleteyourmachine') }}</span>
                                <span class="fw-bold px-2">{{ lang('writedestroy') }}</span>
                                <span>{{ lang('intheboxbelow') }}</span>
                            </label>
                            
                            <div class="input-group my-3" style="max-width: 300px;">
                                <span class="input-group-text" id="basic-addon01">{{ lang('typehere') }}</span>
                                <input type="text" v-model="confirmdestroytext" class="form-control" placeholder="...">
                            </div>
                        </div>                        
                        <div class="d-flex flex-row justify-content-center">
                            <p class="col-11 text-start mt-4 alert alert-danger position-absolute bottom-0">
                                <span class="spinner-grow text-danger" style="--bs-spinner-width: 0px; --bs-spinner-height: 0px; --bs-spinner-animation-speed: 2s;"><i class="bi bi-exclamation-diamond"></i></span>
                                <span class="ms-4">{{ lang('alert') }}</span>
                                <span> : </span>
                                <span>{{ lang('destroyalert') }}</span>
                            </p>
                        </div>

                        <div v-if="!confirmTitle" class="col-12">
                            <p class="text-start h4 mt-4">Error NO Action</p>
                        </div>
                    </div>

                    <!-- failed and Just open (ConfirmDialog=true)-->
                    <div v-if="actionStatus == 'failed' && confirmDialog && !isBetweenPending" class="row m-0 p-0 mt-4">
                        <div v-if="confirmTitle" class="">
                            <label for="confirmdestroytext" class="mt-5 h5 lh-lg">
                                <span>{{ lang('todeleteyourmachine') }}</span>
                                <span class="fw-bold px-2">{{ lang('writedestroy') }}</span>
                                <span>{{ lang('intheboxbelow') }}</span>
                            </label>
                            
                            <div class="input-group my-3" style="max-width: 300px;">
                                <span class="input-group-text" id="basic-addon01">{{ lang('typehere') }}</span>
                                <input type="text" v-model="confirmdestroytext" class="form-control" placeholder="...">
                            </div>
                        </div>                        
                        <div class="d-flex flex-row justify-content-center">
                            <p class="col-11 text-start mt-4 alert alert-danger position-absolute bottom-0">
                                <span class="spinner-grow text-danger" style="--bs-spinner-width: 0px; --bs-spinner-height: 0px; --bs-spinner-animation-speed: 2s;"><i class="bi bi-exclamation-diamond"></i></span>
                                <span class="ms-4">{{ lang('alert') }}</span>
                                <span> : </span>
                                <span>{{ lang('destroyalert') }}</span>
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
                    <div v-if="actionStatus == 'completed' && !confirmDialog" class="row m-0 p-0 mt-4">
                        <div v-if="confirmTitle" class="col-12">
                            <p class="text-start h5 py-3">
                                {{ lang('yourcommand') }}                                        
                                <span class="text-primary px-0">{{ lang('destroyaction') }}</span>
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
                    <!-- Action processing -->
                    <?php include('pendingdropdown.php'); ?>

                    
                    <div class="d-flex flex-row align-items-center">
                        <button @click="closeConfirmDialog" type="button" class="btn btn-secondary px-4 mx-2 border-0" data-bs-dismiss="modal">
                            {{ lang('close') }}
                        </button>
                    
                        <!-- just Destroy (completed) -->
                        <div v-if="confirmTitle && actionStatus == 'completed' && confirmDialog">
                            <div v-if="confirmdestroytext == 'destroy'">
                                <button v-if="startNewAction" @click="acceptConfirmDialog" type="button"
                                class="btn btn-danger px-5 mx-2">
                                    <span>{{ lang('destroyaction') }}</span>
                                </button>
                            </div>
                        </div>

                        <!-- just Destroy (failed) -->
                        <div v-if="confirmTitle && actionStatus == 'failed' && confirmDialog">
                            <div v-if="confirmdestroytext == 'destroy'">
                                <button v-if="startNewAction" @click="acceptConfirmDialog" type="button"
                                class="btn btn-danger px-5 mx-2">
                                    <span>{{ lang('destroyaction') }}</span>
                                </button>
                            </div>
                        </div>

                        <!-- Show State BTN -->
                        <div v-if="actionStatus == 'pending' || actionStatus == 'processing'">
                            <button type="button" class="btn btn-danger px-5 mx-2">
                                <span v-if="confirmTitle" class="m-0 p-0 ps-2">{{ lang('destroying') }}</span>
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





