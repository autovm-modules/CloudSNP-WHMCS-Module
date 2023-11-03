
<!-- Machines List -->
<div class="row px-1 px-md-3 px-lg-4 pb-5 mt-5 pt-5">
    <div class="py-5">
    
        <!-- Fetching  -->
        <div v-if="!machinsLoaded">
            <span>
                <div class="spinner-border spinner-border-sm text-primary small" role="status"></div>
                <span class="h4 text-primary py-3 ps-3">{{ lang('listofactivemachines') }}</span>
            </span>    
            <p class="fs-5 pt-3 ps-3">
                {{ lang('waittofetch') }}
            </p>
        </div>

        <!-- Has no machines -->
        <div v-if="machinsLoaded && userHasNoMachine">
            <p class="fs-5 ps-3 text-danger">
                {{ lang('noactivemachine') }} 
            </p>
        </div>
        
        <!-- show activ Machines -->
        <div v-if="machinsLoaded && !userHasNoMachine" >
            <table class="table table-borderless pb-5 mb-5" style="--bs-table-bg: #ff000000;">
                <thead>
                    <tr class="border-bottom" style="--bs-border-width: 2px !important; --bs-border-color: #e1e1e1 !important;">
                        <th scope="col" class="fw-light fs-5 text-secondary pb-3">{{ lang('address') }}</th>
                        <th scope="col" class="fw-light fs-5 text-secondary pb-3">{{ lang('hostnameontable') }}</th>
                        <th scope="col" class="fw-light fs-5 text-secondary pb-3 d-none d-md-block">{{ lang('templateontable') }}</th>
                        <th scope="col" class="fw-light fs-5 text-secondary pb-3">{{ lang('viewontable') }}</th>
                        <th scope="col" class="fw-light fs-5 text-secondary pb-3 d-none d-md-block">{{ lang('statusontable') }}</th>
                    </tr>
                </thead>
                
                <tbody v-for="machine in activeMachines">
                
                    <tr class="border-bottom align-middle" style="--bs-border-width: 1px !important; --bs-border-color: #e1e1e1 !important;">
                    
                    
                        <!-- Address -->
                        <td class="py-4 fw-medium" v-if="address(machine)">{{ address(machine) }}</td>
                        <td class="py-4 fw-medium" v-else> --- </td>
                        <!-- end Address -->
                        

                        <!-- Hostname -->
                        <td class="py-4 fw-medium" v-if="machine.name" >

                            <btn v-if="online(machine)" class="d-flex flex-row align-items-center" style="max-width: 120px;">
                                <span class="spinner-grow text-success me-2 d-block d-md-none" style="--bs-spinner-width: 10px; --bs-spinner-height: 10px; --bs-spinner-animation-speed: 1s;"></span>
                                <span class="text-dark fs-6 fw-medium">{{ machine.name }}</span>
                            </btn>

                            <btn v-if="offline(machine)" class="d-flex flex-row align-items-center" style="max-width: 120px;">
                                <span class="spinner-grow text-danger me-2 d-block d-md-none" style="--bs-spinner-width: 10px; --bs-spinner-height: 10px; --bs-spinner-animation-speed: 1s;"></span>
                                <span class="text-dark fs-6 fw-medium">{{ machine.name }}</span>
                            </btn>
                            
                            <btn v-if="!online(machine) && !offline(machine)" class="d-flex flex-row align-items-center" style="max-width: 120px;">
                                <span class="spinner-grow text-dark me-2 d-block d-md-none" style="--bs-spinner-width: 10px; --bs-spinner-height: 10px; --bs-spinner-animation-speed: 1s;"></span>
                                <span class="text-dark fs-6 fw-medium">{{ machine.name }}</span>
                            </btn>
                            
                        </td>
                        <td class="py-4 fw-medium" v-else> --- </td>
                        <!-- end Hostname -->

                        
                        
                        <!-- Template -->
                        <td v-if="machine.template" class="py-4 fw-medium d-none d-md-block">
                            <div class="d-flex flex-row align-items-center">
                                <img :src="machine.template.icon.address" style="width: 25px;">
                                <span class="ms-2">{{ machine.template.name }}</span>
                            </div>
                        </td>
                        <td class="py-4 fw-medium" v-else> --- </td>
                        
                        
                        
                        <!-- View -->
                        <td v-if="address(machine)" class="py-4 fw-medium">
                            <a @click="open(machine)" class="btn btn-primary btn-sm px-3 py-2 border-0 fw-medium" style="--bs-btn-bg: #0d6efd61; --bs-btn-color: #363636;">{{ lang('viewontable') }}</a>
                        </td>
                        <td class="py-4 fw-medium" v-else> --- </td>
                        


                        <!-- Status -->
                        <td class="py-4 fw-medium d-none d-md-block" v-if="online(machine)">
                            <btn class="d-flex flex-row align-items-center" style="max-width: 85px;">
                                <span class="spinner-grow text-success me-2" style="--bs-spinner-width: 10px; --bs-spinner-height: 10px; --bs-spinner-animation-speed: 1s;"></span>
                                <span class="text-success fs-6 fw-medium d-none d-md-block">{{ lang('online') }}</span>
                            </btn>
                        </td>    
                        
                        <td class="py-4 fw-medium d-none d-md-block" v-if="offline(machine)">
                            <btn class="d-flex flex-row align-items-center" style="max-width: 85px;">
                                <span class="spinner-grow text-danger me-2" style="--bs-spinner-width: 10px; --bs-spinner-height: 10px; --bs-spinner-animation-speed: 1s;"></span>
                                <span class="text-danger fs-6 fw-medium d-none d-md-block">{{ lang('offline') }}</span>
                            </btn>
                        </td>    

                        <td class="py-4 fw-medium d-none d-md-block ps-4" v-if="!online(machine) && !offline(machine)"> 
                            <div class="d-flex flex-row align-items-center m-0 p-0 py-3">
                            <?php include('./includes/commodules/threespinner.php'); ?>
                            </div>
                        </td>
                        <!-- end Status -->
                        
                        
                    </tr>
                </tbody>
            </table>
        </div>

        
    </div>
</div>
<!-- End List -->