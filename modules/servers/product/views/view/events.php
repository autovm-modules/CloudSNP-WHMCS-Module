<!-- SAME Partly (Only PHP include are different) -->
<!-- cloud = './includes/commodules/hasnodata.php' -->
<!-- product = 'hasnodata.php' -->






<div v-if="machineIsLoaded && actionStatus != 'pending' && actionStatus != 'processing'" class="row justify-content-center px-0 px-md-3 px-lg-4">
    <div class="col-12">
        <div class="row justify-content-end px-2 px-md-4 px-xl-5 pt-5 pb-5 border border-2 rounded-4 bg-light" style="--bs-bg-opacity: 0.4;">
            <table class="table table-borderless table-light table-sm" style="max-width: 1200px; --bs-table-bg: #ff000000;" >
                <thead>
                    <tr class="border-bottom text-center">
                        <th scope="col" class="text-secondary fw-normal pb-3 text-start">
                            {{ lang('events') }}
                        </th>
                        <th scope="col" class="text-secondary fw-normal pb-3 text-start d-none d-md-block">
                            {{ lang('status') }}
                        </th>
                        <th scope="col" class="text-secondary fw-normal pb-3">
                            {{ lang('beginingat') }}
                        </th>
                        <th scope="col" class="text-secondary fw-normal pb-3">
                            {{ lang('endingat') }}    
                        </th>
                    </tr>
                </thead>
                <tbody class="border-bottom pt-3">
                    <tr v-for="item in actions" class="text-center align-middle">
                        <td class="text-secondary text-start">
                            <div v-if="item.status && item.method">
                                <i v-if="item.status == 'completed'" class="bi bi-circle-fill pe-2 text-success small d-md-none"></i>
                                <i v-else-if="item.status == 'canceled'" class="bi bi-circle-fill pe-2 text-dark small d-md-none"></i>
                                <i v-else-if="item.status == 'pending'" class="bi bi-circle-fill pe-2 text-danger small d-md-none"></i>
                                <i v-else-if="item.status == 'processing'" class="bi bi-circle-fill pe-2 text-danger small d-md-none"></i>
                                <i v-else-if="item.status == 'failed'" class="bi bi-circle-fill pe-2 text-danger small d-md-none"></i>
                                <i v-else class="bi bi-circle-fill pe-2 text-danger small d-md-none"></i>
                            
                                <span v-if="item.method">{{ lang(item.method) }}</span>
                            </div>
                            <div v-if="!item.status || !item.method">
                                ---
                            </div>
                        </td>
                        
                        <td class="text-secondary d-flex flex-row justify-content-center d-none d-md-block align-items-end py-3">
                            <div v-if="item.status" class="m-0 p-0">
                                <!-- if completed -->
                                <div v-if="item.status == 'completed'" class="bg-success rounded-5 py-2 d-flex flex-row align-items-center justify-content-center" style="--bs-bg-opacity: .2; width:110px">
                                    <i class="bi bi-circle-fill text-success small"></i>
                                    <span class="text-success ps-2 pe-1 small fw-medium">
                                        {{ lang('completed') }}
                                    </span>
                                </div>


                                <!-- if canceled -->
                                <div v-else-if="item.status == 'canceled'" class="bg-dark rounded-5 py-2 d-flex flex-row align-items-center justify-content-center" style="--bs-bg-opacity: .2; width:110px">
                                    <i class="bi bi-circle-fill text-dark small"></i>
                                    <span class="text-danger ps-2 pe-1 small fw-medium">
                                        {{ lang('canceled') }}    
                                    </span>
                                </div>


                                <!-- if pending -->
                                <div v-else-if="item.status == 'pending'" class="bg-danger rounded-5 py-2 d-flex flex-row align-items-center justify-content-center" style="--bs-bg-opacity: .2; width:100px">
                                    <i class="bi bi-circle-fill text-danger small"></i>
                                    <span class="text-danger ps-2 pe-1 small fw-medium">
                                        {{ lang('pending') }}        
                                    </span>
                                </div>
                                
                                
                                <!-- if failed -->
                                <div v-else-if="item.status == 'failed'" class="bg-danger rounded-5 py-2 d-flex flex-row align-items-center justify-content-center" style="--bs-bg-opacity: .2; width:100px">
                                    <i class="bi bi-circle-fill text-danger small"></i>
                                    <span class="text-danger ps-2 pe-1 small fw-medium">
                                        {{ lang('failed') }}        
                                    </span>
                                </div>
                                
                                <!-- Other !!! -->
                                <div v-else class="bg-danger rounded-5 py-2 d-flex flex-row align-items-center justify-content-center" style="--bs-bg-opacity: .2; width:100px">
                                    <i class="bi bi-circle-fill text-danger small"></i>
                                    <span class="text-danger ps-2 pe-1 small fw-medium">
                                        {{ lang(item.status) }}        
                                    </span>
                                </div>
                            </div>
                            <div v-if="!item.status" class="m-0 p-0">
                                <div class="bg-secondary rounded-5 py-2 d-flex flex-row align-items-center justify-content-center" style="--bs-bg-opacity: .2; width:110px">
                                    <i class="bi bi-circle-fill text-success small"></i>
                                    <span class="text-success ps-2 pe-1 small fw-medium">
                                        ---
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="text-secondary" v-html="formatdate(item.createdAt)"></td>
                        <td class="text-secondary" v-html="formatdate(item.updatedAt)"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div v-else class="row justify-content-center">
    <div class="col-12 px-2 px-md-4">
        <div class="row justify-content-end px-2 px-md-4 px-xl-5 pt-5 pb-5 border border-2 rounded-4 bg-light" style="--bs-bg-opacity: 0.6;">
        <span class="fw-medium">
            <span class="me-2 text-primary">{{ lang('loadingmsg') }}</span>
            <span class="spinner-grow text-primary" style="--bs-spinner-width: 6px;--bs-spinner-height: 6px;"></span>
            <span class="spinner-grow text-primary mx-1" style="--bs-spinner-width: 6px;--bs-spinner-height: 6px;"></span>
            <span class="spinner-grow text-primary" style="--bs-spinner-width: 6px;--bs-spinner-height: 6px;"></span>
        </span>
        <p class="fw-light mt-3">{{ lang('loadingmsglong') }}</p>
        </div>
    </div>
</div>