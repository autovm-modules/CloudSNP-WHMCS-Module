<!-- SAME but address -->
<!-- ./includes/commodules/fetchingdata.php' -->
<!-- ./includes/commodules/hasnodata.php' -->
<!-- BTN removed here -->




<!-- Fetching data -->
<div v-if="!machineIsLoaded"><?php include('./includes/commodules/fetchingdata.php'); ?></div>

<!-- Fetching data -->
<div v-if="machineIsLoaded && isEmpty(traffics)"><?php include('./includes/commodules/hasnodata.php'); ?></div>


<!-- Traffic list -->
<div v-if="machineIsLoaded && !isEmpty(traffics)" class="row mt-4 justify-content-start">        
    <div v-for="(traffic, index) in traffics" class="col-12 col-md-6 col-lg-4 col-xl-3 p-0 m-0 mb-3">
        <div class="card m-2 rounded-4">
    
            <div class="card-img-top bg-secondary px-3 py-2 text-light h6 d-flex flex-row justify-content-between align-items-center rounded-top-4" style="--bs-bg-opacity: 0.1;">
                <div>
                    <span class="fs-4 pe-2 text-dark fw-normal"><i class="bi bi-router-fill"></i></span>
                    <span class="fs-6 text-dark fw-normal">
                        <span>{{ lang('trafficplan') }}</span>
                        <span class="px-1">{{index + 1}}</span>
                    </span>
                </div>
                <!-- Traffic Plan -->
                <div>
                    <span v-if="traffic.type == 'main'" class="btn btn-sm float-end btn-outline-secondary text-dark px-4 py-2 rounded-5" style="--bs-bg-opacity: 0.9; font-size: 80% !important;">{{ lang('main') }}</span>
                    <span v-if="traffic.type == 'plus'" class="btn btn-sm float-end btn-outline-secondary text-dark px-4 py-2 rounded-5" style="--bs-bg-opacity: 0.9; font-size: 80% !important;">{{ lang('plus') }}</span>
                    <span v-if="traffic.type == 'refresh'" class="btn btn-sm float-end btn-outline-secondary text-dark px-4 py-2 rounded-5" style="--bs-bg-opacity: 0.9; font-size: 80% !important;">{{ lang('refresh') }}</span>
                </div>
            </div>
            <div class="card-body">

            <ul class="m-0 p-0 px-4">
            
                <!-- Traffic     -->
                <li class="d-flex flex-row justify-content-between py-1">                
                    <span class="text-secondary">{{ lang('tabeltraffic') }}</span>
                    <span class="">
                        <span v-if="traffic.traffic">{{ traffic.traffic.toFixed() }}</span>
                        <span v-else-if="!traffic.traffic"> --- </span>
                        <span class="ms-1">{{ lang('gb') }}</span>
                    </span>
                </li>
                
                <!-- Traffic Usage -->
                <li class="d-flex flex-row justify-content-between py-1">
                    <span class="text-secondary">{{ lang('trafficusage') }}</span>
                    <span class="">
                        <span v-if="traffic.trafficUsage">{{ (traffic.trafficUsage/1073741824).toFixed(2) }}</span>
                        <span v-else-if="!traffic.trafficUsage">---</span>
                    </span>
                </li>

                <!-- Remaining Traffic -->
                <li class="d-flex flex-row justify-content-between py-1">
                    <span class="text-secondary">{{ lang('remainingtraffic') }}</span>
                    <span class="">
                        <span v-if="traffic.trafficUsage">{{ (traffic.traffic - (traffic.trafficUsage/1073741824)).toFixed(2) }}</span>
                        <span v-else-if="!traffic.trafficUsage">---</span>
                    </span>
                </li>
            </ul>
            <div><hr></div>
            <ul class="m-0 p-0 px-4">
                <!-- duration Days -->
                <li class="d-flex flex-row justify-content-between py-1">
                    <span class="text-secondary">{{ lang('trafficduration') }}</span>
                    <span class="">
                        <span v-if="traffic.duration">{{ traffic.duration }} {{ lang('days') }}</span>
                        <span v-else-if="!traffic.duration">---</span>
                    </span>
                </li>

                <!-- Remaining Days -->
                <li class="d-flex flex-row justify-content-between py-1">
                    <span class="text-secondary">{{ lang('remainingtime') }}</span>
                    <span class="">
                        <span v-if="traffic.remaining">{{ traffic.remaining }} {{ lang('days') }}</span>
                        <span v-else-if="!traffic.remaining">---</span>
                    </span>
                </li>
                
                <!-- Starting Point -->
                <li class="d-flex flex-row justify-content-between py-1">
                    <span class="text-secondary">{{ lang('trafficdate') }}</span>
                    <span class="">
                        <span v-if="traffic.createdAt">{{ traffic.createdAt.slice(0, 10) }}</span>
                        <span v-else-if="traffic.createdAt">---</span>
                    </span>
                </li>
                <li class="d-flex flex-row justify-content-between py-1">
                    
                </li>
            </ul>
            </div>
        </div>
        
    </div>
</div>
<!-- end traffics -->

