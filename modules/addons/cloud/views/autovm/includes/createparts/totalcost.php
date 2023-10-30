<!-- Total Cost -->
<div class="row m-0 p-0 py-5 my-5">
    <div class="col-12 m-0 p-0 px-2" style="--bs-bg-opacity: 0.1;">
        <div class="py-5 px-3 px-lg-5 bg-secondary rounded-4" style="--bs-bg-opacity: 0.1;">
            <!-- title -->
            <div class="m-0 p-0 pt-5">
                <p class="text-dark h5">{{ lang('totalcost') }}</p>
                <p v-if="productPrice" class="fs-6 pt-1 pb-4 text-secondary">{{ lang('totalcostis') }}</p>
                <p v-else-if="!productPrice" class="fs-6 pt-1 pb-4 text-secondary">
                    {{ lang('firstselectone') }}
                </p>
            </div>

            <div v-if="productPrice" class="d-flex flex-row justify-content-between m-0 p-0 my-3 ps-md-4">
                <div class="m-0 p-0">
                    <span v-if="CurrenciesRatioCloudToWhmcs != null" class="fs-5 fw-medium text-primary px-1">
                        {{ ConverFromAutoVmToWhmcs(productPrice/30/24, 0).toLocaleString() }} {{ userCurrencySymbolFromWhmcs }}
                    </span>
                    <span v-else class="fs-5 fw-medium text-primary px-1">
                        <?php include('./includes/commodules/threespinner.php'); ?>
                    </span>
                    <span class="fs-5 fw-light">/{{ lang('hourly') }}</span>
                    
                    <span class="fs-5 fw-light mx-4">-</span>
                        <span v-if="CurrenciesRatioCloudToWhmcs != null" class="fs-5 fw-medium text-primary px-1">
                            {{ ConverFromAutoVmToWhmcs(productPrice, 0).toLocaleString() }} {{ userCurrencySymbolFromWhmcs }}
                        </span>
                        <span v-else class="fs-5 fw-medium text-primary px-1">
                            <?php include('./includes/commodules/threespinner.php'); ?>
                        </span>
                    </span>
                    <span class="fs-5 fw-light">/{{ lang('monthly') }}</span>
                </div>  
            </div>
            <div class="d-flex flex-row justify-content-end m-0 p-0 pt-5">
                <div class="m-0 p-0">
                    <a class="btn px-4 bg-secondary" style="--bs-bg-opacity: 0.3;" href="/index.php?m=cloud&action=pageIndex">{{ lang('cancel') }}</a>
                    <a class="btn btn-primary mx-3"  @click="create" data-bs-toggle="modal" data-bs-target="#createModal">{{ lang('createmachine') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Cost -->