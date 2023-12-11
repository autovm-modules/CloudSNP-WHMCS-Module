
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
            <div class="row px-1 px-md-4 text-start m-0 p-0 mt-4">
                <ul class="nav nav-tabs " id="myTab" role="tablist">
                    
                    <!-- Change OS  -->    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="changeos-tab" data-bs-toggle="tab"
                            data-bs-target="#changeos-tab-pane" type="button" role="tab"
                            aria-controls="changeos-tab-pane" aria-selected="true">{{ lang('changeos') }}</button>
                    </li>

                    
                    <!-- Network -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="network-tab" data-bs-toggle="tab"
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
                </ul>
            </div>

            <!-- graphs -->
            <div class="row tab-content justify-content-center m-0 p-0 pt-5 px-0 px-md-4" style="min-height: 450px;" id="myTabContent">
                
                <!-- templates OS -->
                <div class="col-12 m-0 p-0 px-2 px-md-0 tab-pane fade show active" id="changeos-tab-pane" role="tabpanel"
                    aria-labelledby="changeos-tab" tabindex="0">
                    <?php include('./includes/machineparts/changeos.php'); ?>
                </div>


                <!-- Network -->
                <div class="col-12 m-0 p-0 px-3 px-md-0 tab-pane fade" id="network-tab-pane" role="tabpanel"
                    aria-labelledby="network-tab" tabindex="0">
                    <?php include('./includes/machineparts/network.php'); ?>
                </div>

                <!-- Events -->
                <div class="col-12 m-0 p-0 px-3 px-md-0 tab-pane fade" id="events-tab-pane" role="tabpanel"
                    aria-labelledby="events-tab" tabindex="0">
                    <?php include('./includes/machineparts/events.php'); ?>
                </div>
                
                <!-- Statistic -->
                <div class="m-0 p-0 px-0 px-md-0 tab-pane fade" id="statistics-tab-pane" role="tabpanel"
                    aria-labelledby="statistics-tab" tabindex="0">
                    <?php include('statistics.php'); ?>
                </div>

                <!-- SSH Key -->
                <div class="col-12 m-0 p-0 px-3 px-md-0 tab-pane fade" id="sshkey-tab-pane" role="tabpanel"
                    aria-labelledby="sshkey-tab" tabindex="0">
                    <?php include('./includes/machineparts/sshkey.php'); ?>
                </div>
                
                

            </div>

            <div class="row" style="height: 100px;"></div>
        </div><!-- end tabs -->
    </div>
</div>
<!-- End Access Parts -->