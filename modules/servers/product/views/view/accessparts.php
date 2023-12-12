<!-- Access Parts -->
<div class="row d-flex flex-row align-items-stretch m-0 p-0">
    <div class="col-12 p-0 m-0 mb-3">
        <div class="d-flex flex-column align-items-stretch border border-2 rounded-4 bg-white m-0 p-0 py-4 mx-0">

            <!-- BoX title -->
            <div class="row px-4 text-start m-0 p-0">
                <p class="text-dark fw-medium fs-5 m-0 p-0 my-auto">
                    {{ lang('access') }}
                </p>
                <p class="text-secondary m-0 p-0 pt-3">
                    {{ lang('accesstext') }}    
                </p>
            </div>


            <!--  BTN's -->
            <div class="row px-4 text-start m-0 p-0 mt-4">
                <ul class="nav nav-tabs " id="myTab" role="tablist">
                    <!-- Change OS  -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#changeos-tab-pane" type="button" role="tab"
                            aria-controls="changeos-tab-pane" aria-selected="true">{{ lang('changeos') }}</button>
                    </li>
                    
                    <!-- Software -->
                    <!-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="software-tab" data-bs-toggle="tab"
                            data-bs-target="#software-tab-pane" type="button" role="tab"
                            aria-controls="software-tab-pane" aria-selected="true">{{ lang('software') }}</button>
                    </li> -->

                    <!-- Profile -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#network-tab-pane" type="button" role="tab"
                            aria-controls="network-tab-pane" aria-selected="false">{{ lang('network') }}</button>
                    </li>
                
                    <!-- Events -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="events-tab" data-bs-toggle="tab"
                            data-bs-target="#events-tab-pane" type="button" role="tab"
                            aria-controls="events-tab-pane" aria-selected="false">{{ lang('events') }}</button>
                    </li>
                   
                    <!-- Statistics -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="statistics-tab" data-bs-toggle="tab"
                            data-bs-target="#statistics-tab-pane" type="button" role="tab"
                            aria-controls="statistics-tab-pane" aria-selected="false">{{ lang('statistics') }}</button>
                    </li>
                    
                    <!-- SSH Key -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sshkey-tab" data-bs-toggle="tab"
                            data-bs-target="#sshkey-tab-pane" type="button" role="tab"
                            aria-controls="sshkey-tab-pane" aria-selected="false">{{ lang('sshkey') }}</button>
                    </li>
                    
                    <!-- Traffics -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="traffics-tab" data-bs-toggle="tab"
                            data-bs-target="#traffics-tab-pane" type="button" role="tab"
                            aria-controls="traffics-tab-pane" aria-selected="false">{{ lang('traffics') }}</button>
                    </li>
                </ul>
            </div>

            <!-- Containers -->
            <div class="row tab-content justify-content-center m-0 p-0 pt-5 px-3 px-xxl-4" style="min-height: 450px;" id="myTabContent">
                <!-- templates OS -->
                <div class="m-0 p-0 tab-pane fade show active" id="changeos-tab-pane" role="tabpanel"
                    aria-labelledby="changeos-tab" tabindex="0">
                    <?php include('changeos.php'); ?>
                </div>
                
                <!-- Software  -->
                <div class="m-0 p-0 tab-pane fade" id="software-tab-pane" role="tabpanel"
                    aria-labelledby="software-tab" tabindex="0">
                    <?php include('software.php'); ?>
                </div>

                <!-- Network -->
                <div class="m-0 p-0 tab-pane fade px-1 px-md-3 px-lg-5" id="network-tab-pane" role="tabpanel"
                    aria-labelledby="network-tab" tabindex="0">
                    <?php include('network.php'); ?>
                </div>

                <!-- Events -->
                <div class="m-0 p-0 tab-pane fade px-1 px-md-3 px-lg-5" id="events-tab-pane" role="tabpanel"
                    aria-labelledby="events-tab" tabindex="0">
                    <?php include('events.php'); ?>
                </div>

                <!-- Statistic -->
                <div class="m-0 p-0 tab-pane fade px-0" id="statistics-tab-pane" role="tabpanel"
                    aria-labelledby="statistics-tab" tabindex="0">
                    <?php include('statistics.php'); ?>
                </div>
                
                <!-- SSH Key -->
                <div class="m-0 p-0 tab-pane fade px-1 px-md-3 px-lg-5" id="sshkey-tab-pane" role="tabpanel"
                    aria-labelledby="sshkey-tab" tabindex="0">
                    <?php include('sshkey.php'); ?>
                </div>
                
                <!-- Traffics -->
                <div class="m-0 p-0 tab-pane fade px-1 px-md-3 px-lg-5" id="traffics-tab-pane" role="tabpanel"
                    aria-labelledby="traffics-tab" tabindex="0">
                    <?php include('traffics.php'); ?>
                </div>

            </div>

            <div class="row" style="height: 100px;"></div>
        </div><!-- end tabs -->
    </div>
</div>
<!-- End Access Parts -->