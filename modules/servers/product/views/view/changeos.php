<form v-if="machineIsLoaded" @submit="doChange">
    <!-- body -->    
    <div class="row justify-content-start mt-5" v-if="isSection(3000)">
        <div class="col-12 col-md-6 col-xl-4 mb-3" v-for="category in categories">
            <div class="row border rounded-3 px-3 py-3 mx-0 w-100 bg-light">
                <div class="d-flex flex-row align-items-center m-0 p-0">
                    
                    <div class="py-1 pe-3" style="width: 50px;">
                        <img v-if="category.icon.address" :src="category.icon.address" width="35">
                    </div>

                    <div v-if="category.name" class="py-1 pe-3" style="width: 80px;">
                        <span v-if="category.name == 'Windows Server'" class="h6 text-secondary">
                            Windows
                        </span>

                        <span v-else class="h6 text-secondary">
                            {{ category.name }}
                        </span>
                    </div>

                    <div class="py-1 pe-3 flex-grow-1" style="min-width:190px;">
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
    <div v-if="machineIsLoaded" class="row justify-content-end mt-5 pt-5 mt-xl-0 pt-xl-3">
        <div v-if="(actionStatus != 'pending' && actionStatus != 'processing') || !actionStatus" class="col-auto mb-3">
            <button v-on:click="getSetupOS(templateId)" type="submit" class="btn btn-primary d-flex flex-row align-items-center justify-content-center mb-4 py-2 px-4" data-bs-toggle="modal" data-bs-target="#setupModal" :disabled="templateId ? false : true">
                <span class="h6 p-0 m-0 px-2">{{ lang('setup') }}</span>
                <span v-if="findTemplate != 'er'" class="fs-6 fw-light">({{ findTemplate }})</span>
            </button>
        </div> 
        <div v-if="actionStatus == 'pending' || actionStatus == 'processing'" class="col-auto mb-3">
            <button v-if="templateId" class="btn btn-secondary d-flex flex-row align-items-center justify-content-center mb-4 py-2 px-4" data-bs-toggle="modal" data-bs-target="#processingModal">
                <span class="h6 p-0 m-0 px-2">{{ lang('lastactionpending') }}</span>             
            </button>
        </div>
    </div>

</form>

<div v-else><?php include('fetchingdata.php'); ?></div>