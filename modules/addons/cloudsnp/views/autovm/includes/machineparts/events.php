<!-- SAME Partly (Only PHP include are different) -->
<!-- cloud = './includes/commodules/hasnodata.php' -->
<!-- product = 'hasnodata.php' -->






<div v-if="machineIsLoaded && actionStatus == 'completed' " class="row justify-content-center px-0 px-md-3 px-lg-4">
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
                            <div>
                                <i v-if="item.status == 'completed'" class="bi bi-circle-fill pe-2 text-success small d-md-none"></i>
                                <i v-if="item.status == 'cancelled'" class="bi bi-circle-fill pe-2 text-dark small d-md-none"></i>
                                <i v-if="item.status == 'pending'" class="bi bi-circle-fill pe-2 text-danger small d-md-none"></i>
                                <i v-if="item.status == 'processing'" class="bi bi-circle-fill pe-2 text-danger small d-md-none"></i>
                                <i v-if="item.status == 'failed'" class="bi bi-circle-fill pe-2 text-danger small d-md-none"></i>
                            
                                
                                <span v-if="item.method == 'reboot'">{{ lang('rebootaction') }}</span>
                                <span v-if="item.method == 'stop'">{{ lang('stopaction') }}</span>
                                <span v-if="item.method == 'start'">{{ lang('startaction') }}</span>
                                <span v-if="item.method == 'setup'">{{ lang('setupaction') }}</span>
                                <span v-if="item.method == 'console'">{{ lang('consoleaction') }}</span>
                                <span v-if="item.method == 'destroy'">{{ lang('destroyaction') }}</span>
                                <span v-if="item.method == 'suspend'">{{ lang('suspend') }}</span>
                                <span v-if="item.method == 'unsuspend'">{{ lang('unsuspend') }}</span>
                            </div>
                            
                        </td>
                        
                        <td class="text-secondary d-flex flex-row justify-content-center d-none d-md-block align-items-end py-3">
                            
                            <!-- if completed -->
                            <div v-if="item.status == 'completed'" class="bg-success rounded-5 py-2 d-flex flex-row align-items-center justify-content-center" style="--bs-bg-opacity: .2; width:110px">
                                <i class="bi bi-circle-fill text-success small"></i>
                                <span class="text-success ps-2 pe-1 small fw-medium">
                                    {{ lang('completed') }}
                                </span>
                            </div>


                            <!-- if cancelled -->
                            <div v-if="item.status == 'cancelled'" class="bg-dark rounded-5 py-2 d-flex flex-row align-items-center justify-content-center" style="--bs-bg-opacity: .2; width:110px">
                                <i class="bi bi-circle-fill text-dark small"></i>
                                <span class="text-danger ps-2 pe-1 small fw-medium">
                                    {{ lang('cancelled') }}    
                                </span>
                            </div>


                            <!-- if pending -->
                            <div v-if="item.status == 'pending'" class="bg-danger rounded-5 py-2 d-flex flex-row align-items-center justify-content-center" style="--bs-bg-opacity: .2; width:100px">
                                <i class="bi bi-circle-fill text-danger small"></i>
                                <span class="text-danger ps-2 pe-1 small fw-medium">
                                    {{ lang('pending') }}        
                                </span>
                            </div>
                            
                            
                            <!-- if failed -->
                            <div v-if="item.status == 'failed'" class="bg-warning rounded-5 py-2 d-flex flex-row align-items-center justify-content-center" style="--bs-bg-opacity: .2; width:100px">
                                <i class="bi bi-circle-fill text-danger small"></i>
                                <span class="text-danger ps-2 pe-1 small fw-medium">
                                    {{ lang('failed') }}        
                                </span>
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


<div v-if="!machineIsLoaded || actionStatus == 'pending' || actionStatus == 'processing'" class="p-0 m-0 px-2 px-md-0">
<?php  include('./includes/commodules/fetchingdata.php');     ?>
</div>

