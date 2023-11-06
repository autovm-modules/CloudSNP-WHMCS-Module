<!-- SSH Key  -->
<div v-if="planIsSelected == true" class="row m-0 p-0 py-5 my-5"> 
    <div class="col-12 m-0 p-0" style="--bs-bg-opacity: 0.1;">
        <div class="m-0 p-0">

            <!-- SSH Key -->
            <div class="m-0 p-0 py-5">
                <div class="d-flex flex-row align-items-center justify-content-start m-0 p-0">
                    <span class="text-dark h5">
                        {{ lang('Addssh') }}
                    </span>
                    <span class="px-3 mb-4 text-primary small">
                        {{ lang('optional') }}
                    </span>
                </div>
            
                <div class="row m-0 p-0 my-3">
                    <input 
                    v-model="themachinessh" type="text" 
                    @input="validateInput"
                    class="form-control border-0 py-3 bg-body-secondary fs-6 fw-light ps-4" 
                    style="--bs-bg-opacity: 0.8;" 
                    :placeholder="lang('entersshkey')">
                </div>
                <p v-if="SshNameValidationError" class="mt-4 w-50 small text-danger">{{ lang('onlyenglishletters') }}</p>
            </div>
            
        </div>
    </div>
</div>
<!-- End SSH -->


