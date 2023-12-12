<!-- SAME but address -->
<!-- product = 'fetchingdata.php' -->
<!-- cloud = './includes/commodules/fetchingdata.php' -->

<div v-if="machineIsLoaded" class="row justify-content-center px-0 px-md-4">
    <div class="col-12">
        <div class="row justify-content-end px-2 px-md-4 px-xl-5 pt-5 pb-5 border border-2 rounded-4 bg-light" style="--bs-bg-opacity: 0.6;">

            <div class="d-flex flex-row align-items-end mt-5">
                <p class="text-start h3 m-0 p-0 me-4"><i class="bi bi-filetype-key pe-4"></i>
                    {{ lang('sshkeytitle') }}
                </p>
            </div>
            
            <div class="m-0 p-0 mb-5 px-2" >
                <div class="input-group m-0 p-0 mt-5">    
                    <span class="input-group-text" id="basic-addon1" style="width: 110px !important;">
                        {{ lang('currentkey') }}
                    </span>
                    <input v-if="!machine.publicKey" type="text" class="form-control" id="basic-url1" aria-describedby="readonly basic-addon1" :value="lang('nothingtoseetext')" disabled>
                    
                    <input v-if="machine.publicKey" type="text" class="form-control" id="basic-url1" aria-describedby="readonly basic-addon1" :value="machine.publicKey" disabled>
                </div>
            </div>    
        
        </div>
    </div>
</div>


<div v-if="!machineIsLoaded" class="p-0 m-0">
<?php  include('fetchingdata.php');     ?>
</div>



