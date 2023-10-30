<div v-if="!machineIsLoaded" class="m-0 p-0 px-3 px-md-0">
<?php  include('./includes/commodules/fetchingdata.php');     ?>
</div>
<div v-if="machineIsLoaded">
    <form @submit="doChange">
        <!-- body -->    
        <div class="row justify-content-start">
            <div v-for="category in categories" class="col-12 col-md-6 col-xl-4 mb-3">
                <div class="row px-3 py-3 mx-0 w-100 border border-2 rounded-4 bg-light" style="--bs-bg-opacity: 0.6;">
                    <div class="d-flex flex-row align-items-center m-0 p-0">
                        
                        <div class="py-1 pe-2" style="width: 40px;">
                            <img v-if="category.icon.address" :src="category.icon.address" width="30">
                        </div>

                        <div v-if="category.name" class="py-1 pe-2" style="width: 80px;">
                            <span v-if="category.name == 'Windows Server'" class="h6 text-secondary">
                                Windows
                            </span>

                            <span v-else class="h6 text-secondary">
                                {{ category.name }}
                            </span>
                        </div>

                        <div class="py-1 pe-2 flex-grow-1" style="min-width:170px;">
                            <select v-model="templateId" class="form-select">
                                <option v-for="template in category.templates" :value="template.id">
                                    {{ template.name }}
                                </option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Button -->
        <div v-if="findTemplateName != 'er'" class="row justify-content-end mt-5 pt-5 mt-xl-0 pt-xl-3">
            <div v-if="actionStatus != 'processing' && actionStatus != 'pending' && !consoleIsPending && !consoleIsProcessing" class="col-auto mb-3">
                <button type="submit" class="btn btn-primary d-flex flex-row align-items-center justify-content-center mb-4 py-2 px-4" data-bs-toggle="modal" data-bs-target="#setupModal" :disabled="templateId ? false : true">
                    <span class="p-0 m-0 px-2 fs-6 fw-light">{{ lang('setupaction') }}</span>
                    <span v-if="findTemplateName != 'er'" class="fs-6 fw-light">({{ findTemplateName }})</span>
                </button>
            </div>
            <div v-if="actionStatus == 'processing' || actionStatus == 'pending' || consoleIsPending || consoleIsProcessing" class="col-auto mb-3">
                <button v-if="templateId" type="button" class="btn bg-secondary d-flex flex-row align-items-center justify-content-center mb-4 py-2 px-4" data-bs-toggle="modal" data-bs-target="#processingModal" style="--bs-bg-opacity: 0.3;">
                    <span class="p-0 m-0 px-2 fs-6 fw-light"> 
                    {{ lang('lastactionpending') }}
                    </span>
                </button>
            </div>
        </div>

    </form>

</div>