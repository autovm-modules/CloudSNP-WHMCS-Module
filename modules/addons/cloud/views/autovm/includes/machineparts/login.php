
<!-- Finance and Network (login.php)-->
<div class="row d-flex flex-row align-items-stretch text-start m-0 p-0">

    <!-- Finance -->
    <div class="col-12 col-lg-12 col-xl-4 p-0 m-0 mb-3 order-1 order-md-3 order-lg-3 order-xl-1">
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-4 mx-0 me-xl-1  pb-5 h-100">
            <div class="m-0 p-0">
                <!-- Title     -->
                <div class="m-0 p-0 mb-5">
                    <span class="m-0 p-0">
                        <i class="bi bi-bank text-secondary pe-3 fs-5" style="--bs-text-opacity: 0.7;"></i>    
                        <span class="text-secondary fw-medium fs-5 my-auto">
                        {{ lang('finance') }}
                        </span>
                    </span>
                </div>

                <!-- top slice from pro -->
                <div class="m-0 p-0">
                    <div class="row align-items-start m-0 p-0">
                        <!-- Machine Cost -->
                        <div class="col-6 col-md-4 col-xl-7 m-0 p-0">
                            <div v-if="machineIsLoaded" class="m-0 p-0">
                                <span v-if="machine.price != null" class="">
                                    <span v-if="CurrenciesRatioCloudToWhmcs != null" class="h4 text-primary m-0 p-0">
                                        {{ formatCostMonthly(ConverFromAutoVmToWhmcs(machine.price)) }} {{ userCurrencySymbolFromWhmcs }}
                                        <span class="ps-1 text-dark h6 fw-light">
                                            <span>
                                                {{ lang('monthly') }}
                                            </span>
                                        </span>
                                    </span>
                                    <span v-else class="h4 text-primary m-0 p-0">
                                        <?php include('./includes/commodules/threespinner.php'); ?>
                                    </span>
                                    
                                </span>
                                <span v-else class="">
                                    <span class="h1 text-primary m-0 p-0" style="font-size: 40px !important;">
                                        ---
                                    </span>
                                </span>
                            </div>    
                            <div v-if="!machineIsLoaded" class="m-0 p-0">
                                <!-- Three spinner -->
                                <span class="d-flex flex-row align-items-center text-dark m-0 p-0 ps-4">
                                    <?php include('./includes/commodules/threespinner.php'); ?>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Per Hour -->
                        <div class="col-5 m-0 p-0">
                            <p class="text-secondary align-middle m-0 p-0 pb-2">
                                {{ lang('costperhour') }}
                            </p>
                            <div v-if="machineIsLoaded" class="m-0 p-0">
                                <span v-if="machine.price != null" class="d-flex flex-row align-items-center text-primary fs-6">
                                    <span v-if="CurrenciesRatioCloudToWhmcs != null" class="m-0 p-0">
                                        {{ formatCostHourly(ConverFromAutoVmToWhmcs(machine.price)) }} {{ userCurrencySymbolFromWhmcs }}
                                    </span>
                                    <span v-else class="m-0 p-0">
                                        <?php include('./includes/commodules/threespinner.php'); ?>
                                    </span>
                                </span>
                                <span v-else class="d-flex flex-row align-items-center text-primary fs-5">
                                    <span class="m-0 p-0">
                                        ---
                                    </span>
                                </span>
                            </div>
                            <div v-if="!machineIsLoaded" class="m-0 p-0 pt-1">
                                <span class="m-0 p-0">
                                    ---
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end top -->

                <div class="m-0 p-0 py-4">
                    <hr class="text-secondary border-2 border-secondary m-0 p-0">
                </div>

                <!-- bottom slice -->
                <div class="m-0 p-0">
                    <div class="m-0 p-0 mt-0">
                    
                        <!-- Balance -->
                        <div class="row m-0 p-0">
                            <div class="col-6 col-md-4 col-xl-7 m-0 p-0">
                                <span class="text-secondary align-middle m-0 p-0">
                                    {{ lang('balance') }} :
                                </span>
                            </div>
                            <div class="col-5 m-0 p-0">
                                <span v-if="user.balance != null" class="text-secondary align-middle m-0 p-0 fw-medium">
                                    <span v-if="CurrenciesRatioCloudToWhmcs != null">
                                        {{ formatBalance(ConverFromAutoVmToWhmcs(user.balance)) }} {{ userCurrencySymbolFromWhmcs }}
                                    </span>
                                    <span v-else>
                                        ...
                                    </span>
                                </span>
                                <span v-else class="text-secondary align-middle m-0 p-0 fw-medium">
                                    ---
                                </span>
                            </div>
                        </div>

                        <!-- Billing Cycle -->
                        <div class="row m-0 p-0">
                            <div class="col-6 col-md-4 col-xl-7 m-0 p-0">
                                <span class="text-secondary align-middle m-0 p-0">
                                {{ lang('billingcycle') }}
                                </span>
                            </div>
                            <div class="col-5 m-0 p-0">
                                <span v-if="user.balance" class="text-secondary align-middle m-0 p-0 fw-medium">
                                    {{ lang('payasyougo') }}
                                </span>
                                <span v-else class="text-secondary align-middle m-0 p-0 fw-medium">
                                    ---
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end bottom -->
            
            </div>
        </div>
    </div><!-- End finance  -->

    <!-- Network -->
    <div class="col-12 col-md-8 col-lg-6 col-xl-5 m-0 p-0 flex-grow-1 p-0 m-0 mb-3 order-2 order-md-2 order-lg-2 order-xl-2">
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-4 mx-0 mx-xl-1  pb-5 h-100">
            <!-- top slice -->
            <div class="m-0 p-0">
                <!-- title -->
                <div class="m-0 p-0 mb-5 d-flex flex-row justify-content-between">
                    <span class="m-0 p-0">
                        <i class="bi bi-hdd-network text-secondary pe-3 fs-5"></i>
                        <span class="m-0 p-0 text-secondary ps-2 fs-5">
                        {{ lang('networkinformation') }}
                    </span>
                    </span>
                    <img src="/modules/addons/cloud/views/autovm/includes/assets/img/internet.svg" alt="internet">
                </div>

                <!-- ip -->
                <div class="mt-4 fs-4 d-flex flex-row justify-content-between m-0 p-0">
                    <div class="text-start m-0 p-0">
                        <span class="text-secondary fs-6 align-middle m-0 p-0">
                            {{ lang('ipaddress') }}
                        </span>
                        <span v-if="machineIsLoaded" class="m-0 p-0">
                            <span v-if="ipaddress != null" class="text-primary fw-medium m-0 p-0 ps-4 fs-2 align-middle">
                                {{ ipaddress }}
                            </span>
                            <span v-if="!ipaddress" class="text-primary fw-medium m-0 p-0 ps-4 fs-2 align-middle">
                                ---
                            </span>
                        </span>
                        <span v-if="!machineIsLoaded" class="m-0 p-0">
                            <span class="text-primary fw-medium m-0 p-0 ps-4 fs-2 align-middle">
                                ---
                            </span>
                        </span>
                    </div>
                    <div class="m-0 p-0">
                        <img src="/modules/addons/cloud/views/autovm/includes/assets/img/ip.svg" alt="ipaddress">
                    </div>
                   
                </div>
            </div><!-- end top -->

            <div class="py-4">
                <hr class="text-secondary border-2 border-secondary m-0 p-0">
            </div>

            <!-- bottom slice -->
            <div>
                <div class="m-0 p-0 mt-0 fs-4">
                    <div class="row m-0 p-0 mb-4">
                        <span class="text-secondary fs-6 m-0 p-0 align-middle">
                            {{ lang('networkstatus') }}
                        </span>
                    </div>
                    <div v-if="online || offline" class="row d-flex flex-row m-0 p-0">
                        <div v-if="reserve" class="m-0 p-0 ps-3">
                            <div v-if="online" class="d-flex flex-row m-0 p-0 align-items-center">
                                <img src="/modules/addons/cloud/views/autovm/includes/assets/img/online.svg"
                                    width="20"
                                    class="spinner-grow align-middle bg-light"
                                    style="--bs-spinner-width: 17px; --bs-spinner-height: 17px; --bs-spinner-animation-speed: 2s;">
                                <span class="text-success ps-2">
                                    {{ lang('connected') }}
                                </span>
                            </div>

                            <div v-else-if="offline" class="d-flex flex-row m-0 p-0 align-items-center">
                                <img src="/modules/addons/cloud/views/autovm/includes/assets/img/offline.svg"
                                    width="20"
                                    class="spinner-grow align-middle bg-light"
                                    style="--bs-spinner-width: 17px; --bs-spinner-height: 17px; --bs-spinner-animation-speed: 2s;">
                                <span class="text-danger ps-2">
                                    {{ lang('disconnected') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div v-else class="row d-flex flex-row m-0 p-0">
                        <div class="m-0 p-0 ps-3">
                            <div class="d-flex flex-row align-items-center m-0 p-0">
                                <img src="/modules/addons/cloud/views/autovm/includes/assets/img/nounstatus.svg" width="20"
                                class="spinner-grow align-middle bg-light"
                                    style="--bs-spinner-width: 17px; --bs-spinner-height: 17px; --bs-spinner-animation-speed: 2s;">
                                <!-- Three spinner -->
                                <span class="d-flex flex-row align-items-center text-dark m-0 p-0 ps-4">
                                    ---
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end bottom -->
        </div>
    </div><!-- end Network -->

    <!-- Login -->
    <div class="col-12 col-md-4 col-lg-4 col-xl-3 p-0 m-0 mb-3 order-3 order-md-1 order-lg-1 order-xl-3">
        <div class="border border-2 rounded-4 bg-white m-0 p-0 py-4 px-4 mx-0 me-md-2 ms-xl-1 me-xl-0 pb-5 h-100">
            
            <!-- username -->
            <div class="m-0 p-0">
                <div class="m-0 p-0 mb-5">
                    <span class="text-secondary fw-medium m-0 p-0 fs-5 my-auto">
                    <i class="bi bi-person-badge text-secondary pe-3 fs-5"></i>{{ lang('login') }}
                    </span>
                </div>

                <div class="m-0 p-0 mb-2 mt-4">
                    <span class="text-secondary m-0 p-0 fs-6">
                        {{ lang('username') }}
                    </span>
                </div>

                <div class="row m-0 p-0">
                    <div class="input-group d-flex flex-row justify-content-between align-items-center m-0 p-0">
                        <div v-if="machineUserName" class="input-group-text col-10 rounded m-0 p-0 ps-3" style="height: 45px;">
                            <span class="text-dark m-0 p-0 fs-6">
                            {{ machineUserName }}
                            </span>
                        </div>

                        <div v-if="!machineUserName" class="input-group-text col-10 rounded m-0 p-0 ps-3" style="height: 45px;">
                            <span class="m-0 p-0">
                                ---
                            </span>
                        </div>
                        <div class="col-auto m-0 p-0">
                            <i class="bi bi-person-check-fill fs-4 col-auto m-0 p-0"></i>
                        </div>
                    </div>
                </div>
            </div><!-- end username     -->
            
            <!-- Password -->
            <div class="m-0 p-0">
                <div class="row m-0 p-0">
                    <div class="m-0 p-0 mb-2 mt-4">
                        <span class="m-0 p-0 text-secondary fs-6">
                            {{ lang('password') }}
                        </span>
                    </div>
                </div>
                <div class="row m-0 p-0">
                    <div class="input-group d-flex flex-row justify-content-between align-items-center m-0 p-0">
                        <div v-if="machineUserPass" class="input-group-text col-10 rounded m-0 p-0 ps-3" style="height: 45px;">
                            <span v-if="!showpassword" class="text-dark m-0 p-0 fs-6">
                                <?php    
                                    for ($i = 0; $i <= 10; $i++){
                                ?>
                                    <i class="bi bi-asterisk text-secondary "
                                        style="font-size: 10px !important;"></i>
                                <?php
                                    }
                                ?>

                            </span>
                            <span v-else class="text-dark m-0 p-0 fs-6">{{ machineUserPass }}</span>
                        </div>

                        <div v-if="!machineUserPass" class="input-group-text col-10 rounded m-0 p-0 ps-3" style="height: 45px;">
                            <span class=""> *********** </span>
                        </div>
                        
                        <!-- Icon btn visibilty -->
                        <div class="col-auto m-0 p-0">
                            <i v-if="!showpassword"
                                class="col-auto m-0 p-0 bi bi-eye-slash-fill fs-4 fw-bold text-secondary btn"
                                @click="changeVisibility()"></i>
                            <i v-if="showpassword"
                                class="col-auto m-0 p-0 bi bi-eye-fill fs-4 fw-bold text-primary btn"
                                @click="changeVisibility()"></i>
                        </div>
                    </div>
                </div>
            </div><!-- Password -->

        </div>
    </div><!-- end Login -->

</div>
<!-- End Finance and Network -->