<!-- plan-->
<div v-if="regionsAreLoaded && regionId != null " class="row m-0 p-0 py-5 my-5" id="plans">    
    <div class="col-12" style="--bs-bg-opacity: 0.1;">
        
        <!-- title -->
        <div class="row">
            <div class="m-0 p-0">
                <span class="text-dark h3">
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
        <div v-if="regionName == null">
            <div class="col-12 mb-5 mt-5">
                <!-- Region Not selected yet -->
                <div class="alert alert-primary border-0" role="alert" style="--bs-alert-bg: #cfe2ff73; --bs-alert-border-color: #9ec5fe6e;">
                    {{ lang('pleaseselect') }}
                </div>
            </div>
        </div>
        
        <!-- Selected but loading -->
        <div v-if="plansAreLoading" class="row mt-5">
            <div class="col-12 mb-5" >        
                <div class="d-flex flex-row justify-content-start align-items-center mt-4 text-primary">
                    <p class="h5 me-4">{{ lang('loadingmsg') }}</p>
                    <span>
                        <?php include('./includes/commodules/threespinner.php'); ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- order details -->
        <div v-if="plansAreLoaded" class="row mt-5">
            <!-- Selected but empty -->
            <div v-if="plansLength == 0" class="alert bg-danger text-danger" style="--bs-bg-opacity: 0.1" role="alert">
                {{ lang('thereisnodatacenter') }}
            </div>

            <div v-if="plansLength > 0" v-for="plan in plans" class="col-12 col-md-6 col-lg-4 col-xl-3 m-0 p-0 mb-5 px-1" >
                <div class="border rounded-4 bg-white shadow-sm" :class="{ 'shadow-lg border-secondary border-2 ': isPlan(plan) }" @click="selectPlan(plan)">
                    <div class="bg-body-secondary rounded-top-4 py-4 px-5 px-md-3 px-xl-4" style="--bs-bg-opacity: 0.5;">
                        <div class="p-0 m-0">
                            <div class="d-flex flex-row justify-content-center">
                                <div class="">
                                    <span class="h5 m-0 p-0">
                                        {{ plan.name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-bottom-4 py-4 px-4">
                        <div class="m-0 p-0 px-3 px-md-0">
                            <!-- Description -->
                            <?php if(isset($templatelang)): ?>
                                <?php if(($templatelang == "Farsi")): ?>
                                    <div class="d-flex flex-row justify-content-end py-2">
                                        <div class="d-flex flex-row justify-content-end">
                                            <span v-if="plan.description" class="fs-6 text-dark fw-medium text-end" v-html="formatDescription(plan.description)" style="height: 90px;"></span>                                                
                                            <span v-else-if="!plan.description" class="fs-6 text-dark fw-medium">
                                                ---
                                            </span>
                                        </div>
                                    </div><!-- End MemDescriptionory -->
                                <?php elseif($templatelang != "Farsi"): ?>
                                    <div class="d-flex flex-row justify-content-start py-2">
                                        <div class="d-flex flex-row justify-content-start">
                                            <span v-if="plan.description" class="fs-6 text-dark fw-medium text-start" v-html="formatDescription(plan.description)" style="height: 90px;"></span>                                            
                                            <span v-else-if="!plan.description" class="fs-6 text-dark fw-medium">
                                                ---
                                            </span>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endif ?>
                            <!-- End MemDescriptionory -->
                            <hr>
                            <!-- Plan start from  -->
                            <div v-if="planStartFrom(plan.memoryPrice, plan.cpuCorePrice, plan.cpuLimitPrice, plan.diskPrice, plan.addressPrice) != null && userCurrencySymbolFromWhmcs != null" class="d-flex flex-row justify-content-center py-2 btn bg-secondary" style="--bs-bg-opacity: 0.1;">
                                <div class="d-flex flex-row justify-content-center">
                                    <span class="fs-6 fw-medium me-2">
                                    {{ lang('pricestartsfrom') }}
                                    </span>
                                    <span class="fs-6 fw-medium">
                                        {{ formatCostMonthly(ConverFromAutoVmToWhmcs(planStartFrom(plan.memoryPrice, plan.cpuCorePrice, plan.cpuLimitPrice, plan.diskPrice, plan.addressPrice))) }} {{ userCurrencySymbolFromWhmcs }}
                                    </span>
                                </div>
                            </div><!-- End MemDescriptionory -->

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end order  -->

    </div>
</div>
<div v-if="regionName == null" style="height: 400px;">
</div>
<!-- end plan -->