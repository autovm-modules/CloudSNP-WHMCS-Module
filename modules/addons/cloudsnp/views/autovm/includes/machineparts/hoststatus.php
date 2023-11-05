<!-- TITLE row -->
<div class="row justify-content-between align-items-end m-0 p-0 pb-5 ps-2">

    <!-- Hostname -->
    <div class="col-auto text-start p-0 m-0">
        <div class="d-flex flex-row m-0 p-0">
            <div class="m-0 p-0">
                <span class="fs-5 fw-medium m-0 p-0">{{ lang('hostname') }}</span>
            </div>
            <div class="fs-5 fw-medium m-0 p-0 ps-1 text-primary">
                <div v-if="machineIsLoaded" class="m-0 p-0">
                    <span v-if="machine.name != null" class="px-2"> {{ machine.name }} </span>
                    <span v-else class="px-2"> --- </span>
                    <a v-if="machineIsLoaded && actionStatus == 'completed' && machine.status != 'passive'" v-on:click="doDestroy" data-bs-toggle="modal" data-bs-target="#destroyModal">
                        <i class="bi bi-trash3-fill ps-2 text-danger h5"></i>
                    </a>
                </div>
                <div v-if="!machineIsLoaded">
                    <?php include('./includes/commodules/threespinner.php'); ?>
                </div>
            </div>    
        </div>
    </div>

    <!-- BTNs -->
    <div class="col-auto m-0 p-0">
        <div class="row justify-content-end  m-0 p-0 ">

            <!-- Action processing -->
            <div class="col-auto m-0 p-0 d-none d-md-block">
                <?php include('pendingdropdown.php'); ?>
            </div>


            <!-- status (Passive | Active) -->
            <div v-if="machine.status == 'active' || machine.status == 'passive'" class="col-auto m-0 p-0 d-none d-md-block">
                <div class="m-0 p-0">
                    <span v-if="machine.status == 'active'"
                        class="btn bg-success text-success px-2 px-md-3 px-lg-4 py-2"
                        style="--bs-bg-opacity: .2;">
                        <span class="">{{ lang('active') }}</span>
                    </span>

                    <span v-else-if="machine.status == 'passive'"
                        class="btn bg-secondary px-2 px-md-3 px-lg-4 py-2 text-secondary"
                        style="--bs-bg-opacity: .2;">
                        <span class="">{{ lang('passive') }}</span>
                    </span>
                </div>
            </div>

            <div v-else class="col-auto m-0 p-0 d-none d-md-block">
                <div class="m-0 p-0">
                    <span class="btn bg-body-secondary px-2 px-md-3 px-lg-4 ms-2 py-2 h-100"
                        style="--bs-bg-opacity: .8">
                        <?php include('./includes/commodules/threespinner.php'); ?>
                    </span>
                </div>
            </div>
            <!-- end status (Passive | Active) -->


            <!-- Onlien, Offline -->
            <div v-if="online || offline" class="col-auto m-0 p-0">

                <!-- for PC's -->
                <div class="m-0 p-0 d-none d-md-block">
                    <span v-if="online" class="btn bg-primary text-primary pe-3 py-2 ms-2 d-flex flex-row align-items-center"
                        style="--bs-bg-opacity: .2">
                        <span class="spinner-grow text-primary my-auto m-0 p-0 me-1 align-middle" style="--bs-spinner-width: 7px; --bs-spinner-height: 7px; --bs-spinner-animation-speed: 2s;"></span>
                        <span class=" ms-1">{{ lang('online') }}</span>
                    </span>
                    <span v-else-if="offline"
                        class="btn bg-secondary text-secondary pe-3 ms-2 py-2" style="--bs-bg-opacity: .2">
                        <span class="">{{ lang('offline') }}</span>
                    </span>
                </div>
            </div>
            
            <!-- failed, null -->
            <div v-else class="col-auto m-0 p-0">
                <div class="m-0 p-0 d-none d-md-block">
                    <span class="btn bg-body-secondary px-2 px-md-3 px-lg-4 ms-2 py-2 h-100"
                        style="--bs-bg-opacity: .8">
                        <?php include('./includes/commodules/threespinner.php'); ?>
                    </span>
                </div>    
            </div>
            <!-- end status -->


            <!-- Language -->
            <div class="col-auto m-0 p-0 tn bg-primary text-light rounded-2 ms-2" style="--bs-bg-opacity: 0.9">
                <div class="m-0 p-0 dropdown">
                    <?php  include('./includes/commodules/langbtn.php'); ?>
                </div>
            </div>
 
        </div>
    </div>
</div>
<!-- end title -->