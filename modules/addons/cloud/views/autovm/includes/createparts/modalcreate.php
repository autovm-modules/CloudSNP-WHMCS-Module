<!-- create machine modal -->
<div class="modal fade modal-lg" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="false">
    <div class="modal-dialog" style="max-width: 600px !important;">
        <div class="modal-content border-0">

            <!-- Modal Body -->
            <div class="m-0 p-0">
                <div class="modal-body" style="min-height: 350px !important;">
                    <div class="row m-0 p-0 pt-5">
                        <div class="col-12 text-start lh-lg pb-5">

                            <!-- Just Open window, Ready to order -->
                            <div v-if="!userClickedCreationBtn">    
                                <!-- not enough data -->
                                <div v-if="!themachinename || !regionName || !productName || !templateId" class="row m-0 p-0 px-3 pb-2">
                                    <p class="h5 fw-Medium text-danger">
                                        <i class="bi bi-exclamation-diamond-fill me-3"></i>
                                        {{ lang('notprovideallinformation') }}
                                    </p>        
                                </div> 
                                
                                <!-- enough data to push btn -->
                                <div v-else-if="themachinename && regionName && productName && templateId">
                                    <p class="h5 fw-Medium">{{ lang('youarecreating') }}</p>
                                    <p class="fs-6 fw-light mt-3">{{ lang('makesure') }}</p>
                                </div>

                                <!-- Table of parameters -->
                                <div class="mt-5 px-4 px-lg-5 py-4 rounded-4 bg-primary" style="--bs-bg-opacity: 0.15;">
                                    <table class="table table-borderless m-0 p-0" style="--bs-table-bg: #fff0;">
                                        <tbody>
                                            
                                            <!-- HostName -->
                                            <tr>
                                                <td class="m-0 p-0 py-2" style="width: 110px;">
                                                    <i v-if="themachinename" class="bi bi-check-circle-fill me-1"></i>
                                                    <i v-if="!themachinename" class="bi bi-circle me-1"></i>
                                                    <span>{{ lang('name') }}</span>
                                                </td>

                                                <td class="text-primary fw-medium m-0 p-0 py-2">
                                                    <span v-if="themachinename" class="m-0 p-0">{{ themachinename }}</span>
                                                    
                                                    <!-- Three spinner -->
                                                    <span v-else-if="!themachinename">    
                                                        <?php  include('./includes/commodules/threespinner.php');      ?>
                                                    </span>

                                                </td>
                                            </tr>

                                            <!-- Datacenter -->
                                            <tr>
                                                <td class="m-0 p-0 py-2" style="width: 110px;">
                                                    <i v-if="regionName" class="bi bi-check-circle-fill me-1"></i>
                                                    <i v-if="!regionName" class="bi bi-circle me-1"></i>
                                                    <span>{{ lang('datacenter') }}</span>
                                                </td>

                                                <td class="text-primary fw-medium m-0 p-0 py-2">
                                                    <span v-if="regionName" class="m-0 p-0">{{ regionName }}</span>
                                                    
                                                    <!-- Three spinner -->
                                                    <span v-else-if="!regionName">    
                                                        <?php  include('./includes/commodules/threespinner.php');      ?>
                                                    </span>

                                                </td>
                                            </tr>

                                            <!-- Product -->
                                            <tr>
                                                <td class="m-0 p-0 py-2" style="width: 110px;">
                                                    <i v-if="productName" class="bi bi-check-circle-fill me-1"></i>
                                                    <i v-if="!productName" class="bi bi-circle me-1"></i>
                                                    {{ lang('product') }}
                                                </td>

                                                <td class="text-primary fw-medium m-0 p-0 py-2">
                                                    <span v-if="productName" class="m-0 p-0">{{ productName }}</span>
                                                    
                                                    <!-- Three spinner -->
                                                    <span v-else-if="!productName">
                                                        <?php  include('./includes/commodules/threespinner.php');      ?>
                                                    </span>
                                                </td>
                                            </tr>

                                            <!-- Template -->
                                            <tr>
                                                <td class="m-0 p-0 py-2" style="width: 110px;">
                                                    <i v-if="templateId" class="bi bi-check-circle-fill me-1"></i>
                                                    <i v-if="!templateId" class="bi bi-circle me-1"></i>
                                                    <span>{{ lang('producttemplate') }}</span>
                                                </td>

                                                <td class="text-primary fw-medium m-0 p-0 py-2">
                                                    <div v-if="templateId">
                                                        <div v-for="category in categories" class="m-0 p-0">
                                                            <div v-for="template in category.templates" class="m-0 p-0">
                                                                <span v-if="template.id == templateId" class="m-0 p-0">
                                                                    {{ template.name }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                    
                                                    <!-- Three spinner -->
                                                    <span v-else-if="!templateId">
                                                        <?php  include('./includes/commodules/threespinner.php');      ?>
                                                    </span>
                                                </td>
                                            </tr>

                                            <!-- SSH Key -->
                                            <tr v-if="themachinessh">
                                                <td class="m-0 p-0 py-2" style="width: 110px;">
                                                    <i class="bi bi-check-circle-fill me-1"></i>
                                                    <span>{{ lang('sshkey') }}</span>
                                                </td>
                                                <td class="text-primary fw-medium m-0 p-0 py-2">
                                                    <span>{{ themachinessh }}</span>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <!-- Price -->
                                    <div v-if="productPrice" class="mt-5 text-end pt-5">
                                        <p class="p-0 m-0">
                                            <span class="fw-medium">{{ lang('price') }}</span>
                                            <span v-if="CurrenciesRatioCloudToWhmcs != null" class="text-primary fw-medium m-0 p-0 py-2">
                                                {{ ConverFromAutoVmToWhmcs(productPrice, 0).toLocaleString() }} {{ userCurrencySymbolFromWhmcs }}
                                            </span>
                                            <span v-else class="text-primary fw-medium m-0 p-0 py-2">
                                                <?php include('./includes/commodules/threespinner.php'); ?>
                                            </span>                                        
                                            <span class="ps-1">
                                                {{ lang('monthly') }}
                                            </span>                                        
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Btn Pressed [two case: 1-succed or failed] -->
                            <div v-if="userClickedCreationBtn" class="col-12 text-start lh-lg pb-5">
                                <!-- 1 (succed, reload, open list) -->
                                <div v-if="createActionSucced" class="m-0 p-0">
                                    <div class="row m-0 p-0 px-3">
                                        <p class="fs-5 fw-Medium text-primary p-0 m-0">
                                            {{ lang('machinecreatesuccessfully') }}  
                                        </p>
                                        <p class="fs-6 fw-Medium text-dark p-0 m-0 pb-5">
                                            {{ lang('createsuccessmsg') }}  
                                        </p>
                                    </div> 
                                    <div class="row d-flex flex-row justify-content-end p-0 m-0">
                                        <a class="col-auto btn btn-primary px-4 py-2" href="/index.php?m=cloud&action=pageIndex">{{ lang('machinelink') }}</a>        
                                    </div> 
                                </div>

                                <!-- 2 (failed, reload, do again) -->
                                <div v-if="createActionFailed" class="m-0 p-0">
                                    <div class="row m-0 p-0 px-3">
                                        <p class="fs-5 fw-Medium text-dark p-0 m-0">
                                            {{ lang('createmachinefailed') }}  
                                        </p>
                                    </div> 
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>       
            </div>

           

            <!-- Modal Footer -->
            <div class="d-flex flex-row modal-footer justify-content-between">
                
                <!-- Balance -->
                <div class="m-0 p-0 mx-3">
                    <span class="text-dark fw-medium me-2">{{ lang('balance') }} : </span>
                    <span v-if="user.balance" class="text-primary fw-medium">
                        <span v-if="CurrenciesRatioCloudToWhmcs != null">
                            {{ ConverFromAutoVmToWhmcs(user.balance, 0).toLocaleString() }} {{ userCurrencySymbolFromWhmcs }}
                        </span>
                        <span v-else>
                            <?php include('./includes/commodules/threespinner.php'); ?>
                        </span>                                        
                    </span>
                    <span v-else class="text-primary fw-medium"> --- </span>
                </div>
                
                <!-- BTN's -->
                <div class="d-flex flex-row">
                    <!-- Close BTN ( two typ: 1-[normal close] , 2-[close+relaod] )-->
                    
                    <!-- 1- Normal close, before click -->
                    <div v-if="!userClickedCreationBtn || createActionFailed" class="m-0 p-0">
                        <a @click="closeConfirmDialog" type="button"
                            class="btn btn-secondary px-4 mx-2 border-0" style="background-color: #515151"
                            data-bs-dismiss="modal">
                            <div>
                                {{ lang('close') }}
                            </div>
                        </a>
                    </div>

                    <!-- 2- CloseReload, after click [Close + Reload = make another machine] -->
                    <div v-if="userClickedCreationBtn && createActionSucced" class="m-0 p-0">
                        <a @click="reloadPage" type="button"
                            class="btn btn-secondary px-4 mx-2 border-0" style="background-color: #515151"
                            data-bs-dismiss="modal">
                            <div>
                                {{ lang('createanothermachine') }}
                            </div>
                        </a>
                    </div>
                    

                    <!-- Create BTN -->
                    <div v-if="!userClickedCreationBtn">
                        <div class="m-0 p-0" v-if="themachinename && regionName && productName && templateId && productPrice">
                            <a @click="acceptConfirmDialog" type="button" class="btn btn-primary px-5 mx-2">
                                <span>{{ lang('createthismachine') }}</span>
                            </a>
                        </div>
                    </div>


                    <!-- try again, (force reload) -->
                    <div v-if="userClickedCreationBtn && createActionFailed" class="m-0 p-0">
                        <div class="m-0 p-0">
                            <a @click="closeConfirmDialog" type="button" class="btn btn-primary px-5 mx-2" data-bs-dismiss="modal">
                                <span>{{ lang('tryagain') }}</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div><!-- end modal -->