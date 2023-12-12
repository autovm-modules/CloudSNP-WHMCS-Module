<!-- TITLE row -->
<div class="d-flex flex-row justify-content-between align-items-center m-0 p-0 pb-5 ps-2">
    <!-- Hostname -->
    <div class="text-start p-0 m-0" style="max-width: 225px;">
        <div class="d-flex flex-row m-0 p-0">

            <span class="fs-5 fw-medium m-0 p-0">{{ lang('hostname') }}</span>

            <div v-if="!machineIsLoaded" class="d-flex flex-row m-0 p-0 fs-4 ps-2">
                <span> --- </span>
            </div>

            <div v-else class="d-flex flex-row fs-5 fw-medium  m-0 p-0 ps-2">
                <span v-if="machine.name"> {{ machine.name }} </span>
                <span v-if="!machine.name"> --- </span>
            </div>
        </div>
    </div>

    <!-- BTNs -->
    <div v-if="machineIsLoaded" class="m-0 p-0">
        <div class="row justify-content-end  m-0 p-0 ">
    
            <!-- Action processing -->
            <div class="col-auto m-0 p-0 d-none d-md-block">
                <?php include('pendingdropdown.php'); ?>
            </div>

            <!-- status (Passive | Active) -->
            <div class="col-auto m-0 p-0 d-none d-md-block">
                <div v-if="!machineIsLoaded" class="m-0 p-0">
                    <span class="btn bg-primary m-0 px-3 px-md-4" style="--bs-bg-opacity: .2;">
                        ...
                    </span>
                </div>

                <div v-else class="m-0 p-0">
                    <span v-if="machine.status === 'active'"
                        class="btn bg-success text-success px-2 px-md-3 px-lg-4"
                        style="--bs-bg-opacity: .2;">
                        {{ lang('active') }}
                    </span>

                    <span v-else-if="machine.status === 'passive'"
                        class="btn bg-secondary px-2 px-md-3 px-lg-4 text-secondary"
                        style="--bs-bg-opacity: .2;">
                        {{ lang('passive') }}
                    </span>
                </div>
            </div>


            <!-- Onlien, Offline -->
            <div class="col-auto m-0 p-0">
                <div v-if="!detailIsLoaded" class="m-0 p-0">
                    <span class="btn bg-primary px-3 px-md-4 ms-2" style="--bs-bg-opacity: .2">
                        ...
                    </span>
                </div>

                <div v-else class="m-0 p-0">
                    <span v-if="online" class="btn bg-primary text-primary px-2 px-md-3 px-lg-4 ms-2"
                        style="--bs-bg-opacity: .2">
                        {{ lang('online') }}
                    </span>
                    <span v-else-if="offline"
                        class="btn bg-secondary text-secondary px-2 px-md-3 px-lg-4 ms-2"
                        style="--bs-bg-opacity: .2">
                        {{ lang('offline') }}
                    </span>
                </div>
            </div>
            <!-- end status -->


            <!-- Language -->
            <div class="col-auto m-0 p-0">
                <?php include('view/langbtn.php'); ?>
                
            </div><!-- End Language -->

        </div>
    </div>

    <div v-if="!machineIsLoaded" class="col-5 m-0 p-0">
        <div class="row justify-content-end  m-0 p-0 ">
        
            <!-- Fetching info -->
            <div class="col-auto m-0 p-0 d-none d-md-block">
                <div class="m-0 p-0 me-2">
                    <span class="btn bg-primary text-primary px-2 px-md-3 px-lg-4 small" style="--bs-bg-opacity: .2;">
                        <span class="m-0 p-0 pe-2">{{ lang('fetchingalert') }}</span>    
                        <span class="spinner-grow text-primary my-auto mb-0 ms-1" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                        <span class="spinner-grow text-primary my-auto mb-0 ms-1" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                        <span class="spinner-grow text-primary my-auto mb-0 ms-1" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>

</div><!-- end title -->