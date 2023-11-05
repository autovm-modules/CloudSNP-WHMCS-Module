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
                                <p class="text-start h4 py-3 mt-2 mx-4">
                                    <span class="text-dark">{{ lang('lastactionpending') }}</span>
                                </p>
                            </div>

                            <div v-if="machineIsLoaded" class="d-flex flex-row justify-content-end px-5 mb-5 pb-5">
                                <!-- Action processing -->
                                <?php include('pendingdropdown.php'); ?>
                                
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
