<!-- Data Centers -->
<div class="row m-0 p-0 mt-5">
    <div class="col-12 m-0 p-0" style="--bs-bg-opacity: 0.1;">
        <div class="row">
            <div class="row">
                <span class="h5">
                {{ lang('datacenters') }}
                </span>
            </div>

            <div class="row">
                <span class="fs-6 pt-1 pb-4 text-secondary">
                {{ lang('chooseregion') }}
                </span>
            </div>
        </div>
        
        <div class="row">
            <div v-for="region in regions" class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                <div 
                class="d-flex flex-column align-items-center border rounded-5 bg-light shadow-sm py-4 mx-1 px-2" 
                style="max-width: 165px !important; --bs-bg-opacity: 0.5 !important;"
                :class="{ 'shadow-lg border border-primary': isRegion(region) }" 
                @click="selectRegion(region)">
                    <div class="d-flex flex-row justify-content-center" style="width: 50px !important; height: 50px !important">
                        <img :src="region.icon.address" class="m-0 p-0" style="width: 50px !important; height: 50px !important">
                    </div>
                    
                    <div class="row text-center mt-3">
                        <span class="text-secondary m-0 p-0 mt-3">
                            {{ region.name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end Data Centers -->
    

<!-- Product-->
<div class="row m-0 p-0 py-5 my-5">    
    <div class="col-12" style="--bs-bg-opacity: 0.1;">
        
        <!-- title -->
        <div class="row">
            <div class="m-0 p-0">
                <span class="text-dark h5">
                    {{ lang('products') }}
                </span>
            </div>
            <div class="m-0 p-0">
                <span class="fs-6 pt-1 pb-4 text-secondary">
                    {{ lang('selectaproduct') }}
                </span>
            </div>
        </div>
    
        <!-- No selection -->
        <div v-if="!regionId" class="row mt-5">
            <div class="col-12 mb-5" >
                <!-- Region Not selected yet -->
                <div class="alert alert-primary border-0" role="alert" style="--bs-alert-bg: #cfe2ff73; --bs-alert-border-color: #9ec5fe6e;">
                    {{ lang('pleaseselect') }}
                </div>
            </div>
        </div>
        
        <div v-if="regionId && products.length == 0" class="row mt-5">
            <div class="col-12 mb-5" >
                <!-- Selected but empty -->
                <div v-if="productsAreLoaded == true" class="alert bg-danger text-danger" style="--bs-bg-opacity: 0.1" role="alert">
                    {{ lang('thereisnodatacenter') }}
                </div>
            
                <!-- Selected but loading -->
                <div v-if="productsAreLoaded == false">
                    <div class="d-flex flex-row justify-content-start align-items-center mt-4 text-primary">
                        <p class="h5 me-4">{{ lang('loadingmsg') }}</p>
                        <span>
                            <?php include('./includes/commodules/threespinner.php'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>



        <!-- order details -->
        <div v-if="products.length != 0 && productsAreLoaded == true" class="row mt-5">
            <div v-for="product in products" class="col-12 col-md-6 col-lg-4 mb-5" >
                <div class="border rounded-4 bg-white shadow-sm" :class="{ 'shadow-lg border-primary': isProduct(product) }" @click="selectProduct(product)">
                    <div class="bg-body-secondary rounded-top-4 py-4 px-5" style="--bs-bg-opacity: 0.5;">
                        <div class="p-0 m-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div class="">
                                    <span class="h5 m-0 p-0">
                                        {{ product.name }}
                                    </span>
                                </div>

                                <div class="flex justify-start items-center space-x-2">
                                    <span v-if="CurrenciesRatioCloudToWhmcs != null" class="h5 m-0 p-0 text-primary">
                                        {{ ConverFromAutoVmToWhmcs(product.price,).toLocaleString() }} {{ userCurrencySymbolFromWhmcs }}
                                    </span>
                                    <span v-else class="h5 m-0 p-0 text-primary">
                                        <?php include('./includes/commodules/threespinner.php'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-bottom-4 py-4 px-4">
                        <div class="m-0 p-0 px-3 px-md-4">
                            
                            <!-- bandwidth -->
                            <div class="d-flex flex-row justify-content-between py-2">
                                <div class="d-flex flex-row justify-content-start">
                                    <img src="/modules/addons/cloud/views/autovm/includes/assets/img/bandwidth.svg" width="18">        
                                    <span class="fs-5 fw-light text-secondary mx-2">
                                        {{ lang('bandwidth') }}
                                    </span>
                                    <span v-if="product.bandwidth" class="fs-5 text-dark fw-medium">
                                        {{ product.bandwidth }}    
                                        <span class="fs-5 text-dark fw-medium ms-1">
                                            {{ lang('gb') }}
                                        </span>
                                    </span>
                                    <span v-else-if="!product.bandwidth" class="fs-5 text-dark fw-medium">
                                        ---
                                    </span>
                                </div>
                            </div><!-- end bandwidth -->


                            <!-- Memory -->
                            <div class="d-flex flex-row justify-content-between py-2">
                                <div class="d-flex flex-row justify-content-start">
                                    <img src="/modules/addons/cloud/views/autovm/includes/assets/img/ramicon.svg" width="18">        
                                    <span class="fs-5 fw-light text-secondary mx-2">
                                        {{ lang('memory') }} : 
                                    </span>
                                    <span v-if="product.memorySize" class="fs-5 text-dark fw-medium">
                                        {{ product.memorySize }}
                                        <span class="fs-5 text-dark fw-medium ms-1">
                                            {{ lang('mb') }}
                                        </span>
                                    </span>
                                    <span v-else-if="!product.memorySize" class="fs-5 text-dark fw-medium">
                                        ---
                                    </span>
                                </div>
                            </div><!-- End Memory -->


                            <!-- Disk -->
                            <div class="d-flex flex-row justify-content-between py-2">
                                <div class="d-flex flex-row justify-content-start">
                                    <img src="/modules/addons/cloud/views/autovm/includes/assets/img/diskicon.svg" width="18">    
                                    <span class="fs-5 fw-light text-secondary mx-2">
                                        {{ lang('disk') }} : 
                                    </span>
                                    <span v-if="product.diskSize" class="fs-5 text-dark fw-medium">
                                        {{ product.diskSize }}
                                        <span class="fs-5 text-dark fw-medium ms-1">
                                            {{ lang('gb') }}
                                        </span>
                                    </span>
                                    <span v-else-if="!product.diskSize" class="fs-5 text-dark fw-medium">
                                        ---
                                    </span>
                                </div>
                            </div><!-- End Disk -->


                            <!-- CPU -->
                            <div class="d-flex flex-row justify-content-between py-2">
                                <div class="d-flex flex-row justify-content-start">
                                    <img src="/modules/addons/cloud/views/autovm/includes/assets/img/cpuicon.svg" width="18">    
                                    <span class="fs-5 fw-light text-secondary mx-2">
                                        {{ lang('cpu') }} : 
                                    </span>
                                    <span v-if="product.cpuCore" class="fs-5 text-dark fw-medium">
                                        {{ product.cpuCore }}
                                        <span class="fs-5 text-dark fw-medium ms-1">
                                            {{ lang('core') }}
                                        </span>
                                    </span>
                                    <span v-else-if="!product.cpuCore" class="fs-5 text-dark fw-medium">
                                        ---
                                    </span>
                                </div>
                            </div><!-- end CPU -->

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end order  -->

    </div>
</div>
<!-- end Product -->