<?php include_once('funcurl.php');    ?>
<?php include_once('config.php');     ?>


<!doctype html>    
    <html lang="<?php echo($templatelang) ?>" <?php if($templatelang == 'Farsi'){ echo("dir='rtl'"); } ?> style="font-size: 0.9em !important;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Bootstsrap Icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <!-- Bootsrtap Bundle -->
        <script src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/js/bootstrap.bundle.min.js"></script>

        <!-- My CSS -->
        <link href="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/style.css" rel="stylesheet">
        
        <!-- RTL && LTR -->
        <?php if ($templatelang == 'Farsi'): ?>
            <link href="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/css/bootstrap.rtl.min.css" rel="stylesheet">
            <style> * {font-family: 'Vazirmatn' !important;}</style>
        <?php else: ?> 
            <link href="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/css/bootstrap.min.css" rel="stylesheet">    
            <!-- FONT: Plus Jakarta Sans  -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300&display=swap" rel="stylesheet">
            <style> * {font-family: 'Plus Jakarta Sans', sans-serif !important;} </style>
        <?php endif ?>


        <style>
            [v-cloak] { display: none; }
        </style>
    </head>
    
    <body class="bg-body-secondary" style="--bs-bg-opacity: 0.7;">
        <div id="app">
            <!-- Menu row -->
            <div class="container-fluid bg-white shadow-sm py-4" v-cloak>
                <div class="row">
                    <div class="d-flex flex-row justify-content-end">
                        <div class="btn-group float-end me-1" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary" disabled>
                                <span class=""><i class="bi bi-box-arrow-up-right"></i></span>
                            </button>
                            
                            <!-- Get Id from Wisefunc.php -->
                                <?php if($id != 0): ?>
                                    </a>
                                    <a href="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/viewpanel.php?id=<?php echo($id); ?>&u=<?php echo($u); ?>" target="_top" type="button" class="btn btn-primary">
                                        <span class="px-2 small">{{ lang('gotopanel') }}</span>
                                    </a>
                                <?php else: ?>
                                    <a class="btn btn-primary">
                                        <span class="px-2 small">Error: No id detected</span>
                                    </a>
                                <?php endif ?>
                            <!-- end -->

                        </div>    
                        <!-- Language -->
                        <div class="col-auto m-0 p-0">
                            <?php include('view/langbtn.php'); ?>
                        </div><!-- End Language -->
                    </div>
                </div>
            </div>
            
            <!-- Body row -->
            <div class="p-1 p-xl-4 pt-4" v-cloak>
                <div class="container-fluid pt-1 pb-3 px-1 px-md-3">
                    <!-- Fetching info -->
                    <div v-if="!machineIsLoaded">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <div class="p-0 m-0 p-3 p-md-5">
                                <p class="p-0 m-0 h5"> 
                                    <span>{{ lang('loadingmsg') }}</span>
                                    <span class="spinner-grow ms-1 align-middle" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                    <span class="spinner-grow ms-1 align-middle" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                    <span class="spinner-grow ms-1 align-middle" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                </p>
                            </div>
                        </div>  
                    </div><!-- End Fetching -->
                    
                    <!-- Ready to show info -->
                    <div v-else-if="machineIsLoaded">                    
                        <div class="row m-0 p-0 align-items-stretch">
                            <!-- HostName -->
                            <div class="row mt-1">
                                <div class="d-flex flex-row justify-content-between align-items-center p-3 mb-3">
                                    <div class="p-0 m-0">
                                        <span class="p-0 m-0 text-secondary h4">{{ lang('hostname') }}</span>
                                        <span class="p-0 m-0 px-2 text-primary h4" style="text-transform: capitalize;"> 
                                            <span v-if="machine.name">{{ machine.name }} </span>
                                            <span v-else-if="!machine.name"> --- </span>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- End HostName -->
                            
                            <!-- Left col -->
                            <div class="col-12 col-md-5 col-lg-4 m-0 px-2 mb-2 pe-md-3 mb-md-0">                                
                                <div class="bg-white rounded-4 border border-2 p-3 mb-2 h-100 shadow-sm">
                                    <!-- Account Info -->
                                    <div class="m-0 p-0 mt-1 mb-5">
                                        <span class="h5 p-0 m-0 text-secondary">{{ lang('accountinformationtitle') }}</span>
                                    </div>
                                    <!-- User, Pass -->
                                    <div class="row mt-4">
                                        <div class="row m-0 p-0 mt-1 px-3">
                                            <!-- UserNmae -->
                                            <div class="m-0 p-0">
                                                <span class="fs-6 p-0 m-0 text-secondary">
                                                    <i class="bi bi-person-check-fill pe-2"></i>
                                                    {{ lang('username') }}
                                                    <span class="m-0 p-0 px-1">:</span>
                                                </span>
                                                <span v-if="machineUserName" class="ps-1">
                                                    {{ machineUserName }}
                                                </span>
                                                <span v-if="!machineUserName" class="text-dark m-0 p-0 fs-6">
                                                    ---
                                                </span>
                                            </div>
                                            
                                            <!-- Password -->
                                            <div class="m-0 p-0">
                                                <div class="d-flex flex-row justify-content-between align-items-center">
                                                    <div class="fs-6 p-0 m-0 text-secondary" >
                                                        <i class="bi bi-unlock-fill pe-2"></i>
                                                        {{ lang('password') }}
                                                        <span class="m-0 p-0 px-1">:</span>
                                                        <a v-if="showpassword" class="p-0 m-0 text-decoration-none ps-1">
                                                            <span class="m-0 p-0">**********</span>
                                                            <i @click="changeVisibility()" class="m-0 p-0 bi bi-eye-slash-fill text-secondary ps-3"></i>
                                                        </a>
                                                        <a v-if="!showpassword" class="p-0 m-0 text-decoration-none ps-1">
                                                            <span class="m-0 p-0">{{ machineUserPass }}</span>    
                                                            <i @click="changeVisibility()" class="m-0 p-0 bi bi-eye-fill text-primary ps-3"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End User, Pass -->
                                    
                                    <div class="pb-md-4"><hr></div>

                                    <!-- IP Adrress -->
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <span class="fs-6 p-0 m-0 text-secondary">
                                            {{ lang('ipaddress') }}
                                            <span v-if="address && !alias" class="text-primary">
                                                <span class="px-1">
                                                    {{address}}
                                                </span>
                                            </span>
                                            <span v-if="alias" class="text-primary">
                                                <span class="px-1">
                                                    {{ alias }}
                                                </span>
                                            </span>
                                            <span v-if="!address && !alias" class="text-secondary">
                                                <span class="px-1">
                                                    ---
                                                </span>
                                            </span>
                                            <span class="m-0 p-0" >
                                                <button @click="CopyAddress" class="btn btn-sm btn-outline p-0 m-0 ms-1 p-1" style="font-size: 70%;">
                                                    <span v-if="!AddressCopied" class="small">
                                                        <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/ip.svg" alt="copy" style="width: 14px;">
                                                    </span>    
                                                    <span class="d-flex flex-row justify-content-center align-items-end text-primary" v-if="AddressCopied">
                                                        <i class="bi bi-check-all"></i>
                                                        <span class="small">Copied</span>
                                                    </span>
                                                </button>
                                            </span>
                                        </span>
                                    </div><!-- End IP -->
                                </div>
                            </div>
                            
                            <!-- Right col -->
                            <div class="col-12 col-md-7 col-lg-8 p-md-0">
                                <div class="row pe-0 pe-md-2">
                                    <!-- Machine Details [Ram, CPU, Disk] -->
                                    <div class="d-none d-lg-block mb-2 px-2">
                                        <div class="d-flex flex-row m-0 p-0">
                                            <!-- Memory -->
                                            <div class="col-3 m-0 pe-2">
                                                <div class="border border-2 rounded-4 shadow-sm bg-white py-4 m-0 p-0 px-3" style="height: 120px">
                                                    <div class="m-0 p-0 mb-3 text-start">
                                                        <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/ramicon.svg" width="18">
                                                        <span class="text-secondary m-0 p-0 ps-2">
                                                            {{ lang('memory') }}
                                                        </span>
                                                    </div>

                                                    <div v-if="!machineIsLoaded" class="text-start m-0 p-0">
                                                        <span class="m-0 p-0 fs-6 ps-2 text-primary">
                                                            ---
                                                        </span>
                                                    </div>
                                                    <div v-else class="m-0 p-0 text-start">
                                                        <span class="m-0 p-0 fs-6 text-primary ps-1">
                                                            {{ machine.memorySize }}
                                                            {{ lang('mb') }}
                                                        </span>
                                                        <span class="m-0 p-0 fs-6 ps-2 text-primary">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Disk -->
                                            <div class="col-3 m-0 pe-2">
                                                <div class="border border-2 rounded-4 shadow-sm bg-white py-4 m-0 p-0 px-3" style="height: 120px">
                                                    <div class="m-0 p-0 mb-3 text-start">
                                                        <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/diskicon.svg" width="18">
                                                        <span class="m-0 p-0 text-secondary ps-2">
                                                            {{ lang('disk') }}
                                                        </span>
                                                    </div>

                                                    <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                                                        <span class="m-0 p-0 fs-6 ps-2 text-primary">
                                                            ---
                                                        </span>
                                                    </div>
                                                    <div v-else class="m-0 p-0 text-primary text-start">
                                                        <span class="m-0 p-0 fs-6 text-primary ps-1">
                                                            {{ machine.diskSize }}
                                                            {{ lang('gb') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- CPU -->
                                            <div class="col-3 m-0 pe-2">
                                                <div class="border border-2 rounded-4 shadow-sm bg-white py-4 m-0 p-0 px-3" style="height: 120px">
                                                    <div class="m-0 p-0 mb-3 text-start">
                                                        <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/cpuicon.svg" width="18">
                                                        <span class="m-0 p-0 text-secondary ps-2">
                                                        {{ lang('cpu') }}
                                                        </span>
                                                    </div>

                                                    <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                                                        <span class="m-0 p-0 fs-6 ps-2 text-primary">
                                                            ---
                                                        </span>
                                                    </div>
                                                    <div v-else class="m-0 p-0 text-primary text-start">
                                                        <span class="m-0 p-0 fs-6 ps-1">
                                                            {{ machine.cpuCore }} 
                                                            {{ lang('core') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Current Action -->
                                            <div class="col-3 m-0 pe-0">
                                                <div class="border border-2 rounded-4 shadow-sm bg-white py-4 m-0 p-0 px-3" style="height: 120px">
                                                    <div class="m-0 p-0 mb-3 text-start">
                                                        <i class="bi bi-tools text-dark" style="--bs-text-opacity: 0.7;"></i>
                                                        <span class="m-0 p-0 text-secondary ps-2">
                                                            {{ lang('processing') }}
                                                        </span>
                                                    </div>

                                                    <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                                                        <span class="m-0 p-0 fs-6 ps-2 text-primary">
                                                            ---
                                                        </span>
                                                    </div>
                                                    <div v-else class="m-0 p-0 text-start">
                                                        <!-- no action -->
                                                        <div v-if="!actionMethod" class="m-0 p-0 fs-6 ps-1">
                                                            <span class="text-primary">
                                                                <span>---</span>
                                                            </span>
                                                        </div>
                                                        <div v-else class="m-0 p-0 fs-6 ps-1">
                                                            <span v-if="actionStatus == 'processing' || actionStatus == 'pending'" class="text-primary">
                                                                <span>{{ lang(actionMethod) }}</span>
                                                                <span class="spinner-grow align-middle ms-3 mx-0" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                                                <span class="spinner-grow align-middle mx-1" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                                                <span class="spinner-grow align-middle mx-0" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                                            </span>
                                                            <span v-else class="text-primary">
                                                                <span>
                                                                    {{ lang('machineisdoingnothing') }}
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Machine Status -->
                                    <div class="col-12 col-lg-6 m-0 px-2 ps-lg-2 pe-lg-2">
                                        <div class="d-flex flex-row justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-2 p-3 mb-2" style="height: 53px">
                                            <!-- active/passive     -->
                                            <div class="fs-6 p-0 m-0 text-secondary">
                                                {{ lang('machinestatus') }}
                                                <!-- Active/Passive -->    
                                                <span>
                                                    <span v-if="machine.status == 'active'" class="text-primary">
                                                        <span class="">                                                            
                                                            <span class="">
                                                            {{ lang('active') }}
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <span v-if="machine.status == 'passive'" class="text-primary">
                                                        <span class="">
                                                        {{ lang('passive') }}
                                                        </span>
                                                    </span>
                                                </span><!-- End A/P -->
                                            </div>

                                            <!-- Online/Offline -->
                                            <div class="d-none d-md-block">
                                                <span v-if="online" class="btn btn-sm rounded-pill btn-outline-success ms-1" style="width: 95px;">
                                                    <span class="px-1">
                                                        <span class="me-1">
                                                            {{ lang('online') }}
                                                        </span>
                                                        <span class="spinner-grow align-middle" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                                    </span>
                                                </span>
                                                <span v-if="offline" class="btn btn-sm rounded-pill btn-outline-secondary ms-1" style="width: 95px;">
                                                    <span class="px-1">
                                                        {{ lang('offline') }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- End Machine Status -->

                                    <!-- Last action -->
                                    <div class="col-12 col-lg-6 m-0 px-2 ps-lg-0 pe-lg-2">
                                        <div class="d-flex flex-row justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-2 p-3 mb-2" style="height: 53px">
                                            <div>
                                                <span class="fs-6 p-0 m-0 text-secondary">
                                                    {{ lang('lastaction') }}
                                                    <span class="text-primary">
                                                        <span class="">
                                                            <span v-if="!actionMethod">
                                                                err: no history
                                                            </span>
                                                            <span v-else-if="actionMethod">
                                                                <span>{{ lang(actionMethod) }}</span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="d-none d-md-block">
                                                <!-- No status -->
                                                <span v-if="!actionStatus" class="btn btn-sm rounded-pill btn-outline-secondary" style="width: 150px;">
                                                    <span class="px-1">
                                                        ???
                                                    </span>
                                                </span>
                                                <span v-else-if="actionStatus == 'completed'" class="btn btn-sm rounded-pill btn-outline-primary" style="width: 95px;">
                                                    <span class="px-1">
                                                        {{ lang('actionstatuscompleted') }}
                                                    </span>
                                                </span>
                                                <span v-else-if="actionStatus == 'processing' || actionStatus == 'pending'" class="btn btn-sm rounded-pill btn-outline-danger" style="width: 105px;">
                                                    <span v-if="actionStatus == 'processing'" class="px-1">
                                                        {{ lang('actionstatusprocessing') }}
                                                    </span>
                                                    <span v-if="actionStatus == 'pending'" class="px-1">
                                                        {{ lang('actionstatuspending') }}
                                                    </span>
                                                    <span class="spinner-grow ms-1 align-middle" style="--bs-spinner-width: 5px; --bs-spinner-height: 5px; --bs-spinner-animation-speed: 1s;"></span>
                                                </span>
                                                <span v-else class="btn btn-sm rounded-pill btn-outline-secondary" style="width: 150px;">
                                                    <span class="px-1">
                                                        {{ lang(actionStatus) }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- End action -->

                                    <!-- Template or software -->
                                    <div class="col-12 col-lg-6 m-0 px-2 ps-lg-2 pe-lg-2">
                                        <div class="d-flex flex-row justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-2 p-3 mb-2 mb-lg-0" style="height: 53px">
                                            <div>
                                                <span>
                                                    <!-- has nothing -->
                                                    <span v-if="!softName && !tempName" class="">
                                                        <span class="fs-6 p-0 m-0 text-secondary">
                                                            {{ lang('template') }}
                                                            <span class="px-1">:</span>
                                                        </span>
                                                        <span class="text-primary">
                                                            <span class="px-1 fs-6">
                                                                ---
                                                            </span>
                                                        </span>
                                                    </span>

                                                    <!-- conflict (has both) -->
                                                    <span v-if="softName && tempName" class="">
                                                        <span class="fs-6 p-0 m-0 text-secondary">
                                                            {{ lang('template') }}
                                                            <span class="px-1">:</span>
                                                        </span>
                                                        <span class="text-primary">
                                                            <span class="px-1 fs-6">
                                                                Conflict
                                                            </span>
                                                        </span>
                                                    </span>

                                                    <!-- If has template -->
                                                    <span v-if="tempName && !softName" class="">
                                                        <span class="fs-6 p-0 m-0 text-secondary">
                                                            {{ lang('template') }}
                                                            <span class="px-1">:</span>
                                                        </span>
                                                        <span v-if="tempIcon" class="ms-2">
                                                            <img :src="tempIcon" alt="templateicon" width="20">
                                                        </span>
                                                        <span v-if="tempName" class="text-primary">
                                                            <span class="px-1 fs-6">
                                                                {{ tempName }}
                                                            </span>
                                                        </span>
                                                    </span>

                                                    <!-- If has Software -->
                                                    <span v-if="softName && !tempName" class="">
                                                        <span class="fs-6 p-0 m-0 text-secondary">
                                                            {{ lang('installedsoftware') }}
                                                            <span class="px-1">:</span>
                                                        </span>
                                                        <!-- <span v-if="softIcon" class="ms-2">
                                                            <img :src="softIcon" alt="SoftwareIcon" width="20">
                                                        </span> -->
                                                        <span v-if="softName" class="text-primary">
                                                            <span class="px-1 fs-6">
                                                                {{ softName }}
                                                            </span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- End Temp -->
                                    
                                    <!-- Uptime -->
                                    <div class="col-12 col-lg-6 m-0 px-2 ps-lg-0 pe-lg-2">
                                        <div class="d-flex flex-row justify-content-between align-items-center bg-white rounded-4 shadow-sm border border-2 p-3" style="height: 53px">
                                            <div>
                                                <span class="fs-6 p-0 m-0 text-secondary">
                                                {{ lang('uptime') }}
                                                <span class="px-1">:</span>
                                                </span>
                                                <!-- Uptime module -->
                                                <span v-if="!detailIsLoaded" class="m-0 p-0">
                                                    <span class="m-0 p-0 text-start">
                                                        <span class="m-0 p-0 text-primary">
                                                            ---
                                                        </span>
                                                    </span>
                                                </span>
                                                <span v-else-if="detailIsLoaded" class="m-0 p-0 fs-6">
                                                    <span v-if="uptimeformated" class="m-0 p-0 text-start">
                                                        <span v-if="uptimeformated.day" class="m-0 p-0 text-primary">
                                                            {{ uptimeformated.day }}
                                                            <span v-if="uptimeformated.day == 1">{{ lang('days') }}</span>
                                                            <span v-if="uptimeformated.day > 1">{{ lang('days') }}</span>
                                                        </span>

                                                        <span v-if="uptimeformated.hr">
                                                            <span v-if="uptimeformated.day">
                                                                <span class="m-0 p-0 text-secondary"> {{ lang('and') }} </span>
                                                                <span class="m-0 p-0 text-primary">
                                                                    {{ uptimeformated.hr }}
                                                                    <span v-if="uptimeformated.hr == 1">{{ lang('hours') }}</span>
                                                                    <span v-if="uptimeformated.hr > 1">{{ lang('hours') }}</span>
                                                                </span>
                                                            </span>
                                                            <span v-else class="m-0 p-0 text-primary">
                                                                {{ uptimeformated.hr }}
                                                                <span v-if="uptimeformated.hr == 1">{{ lang('hours') }}</span>
                                                                <span v-if="uptimeformated.hr > 1">{{ lang('hours') }}</span>
                                                            </span>
                                                        </span>

                                                        <span v-if="!uptimeformated.day">
                                                            <span v-if="uptimeformated.minuts" class="text-primary">
                                                                <span v-if="uptimeformated.hr">
                                                                    <span class="text-secondary"> {{ lang('and') }} </span>
                                                                    <span class="text-primary">
                                                                        {{ uptimeformated.minuts }}
                                                                        <span v-if="uptimeformated.minuts == 1">{{ lang('minutes') }}</span>
                                                                        <span v-if="uptimeformated.minuts > 1">{{ lang('minutes') }}</span>
                                                                    </span>
                                                                </span>
                                                                <span v-if="!uptimeformated.hr">
                                                                    <span class="text-primary">
                                                                        {{ uptimeformated.minuts }}
                                                                        <span v-if="uptimeformated.minuts == 1">{{ lang('minutes') }}</span>
                                                                        <span v-if="uptimeformated.minuts > 1">{{ lang('minutes') }}</span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <span v-else-if="!uptimeformated" class="m-0 p-0 text-start">
                                                        <span class="m-0 p-0 text-primary">
                                                            ---
                                                        </span>
                                                    </span>
                                                </span><!-- End Uptime module -->
                                            </div>
                                        </div>
                                    </div><!-- End Temp -->

                                </div><!-- Machine Status -->
                            </div>
                        </div><!-- End Info -->       
                        
                        <!-- On large [Ram, CPU, Disk] -->
                        <div class="row m-0 p-0 d-lg-none">
                            <div class="col-12 p-0 m-0 px-2 mt-2">
                                <!-- Machine Details [Ram, CPU, Disk] -->
                                <div class="mb-2">
                                    <div class="row d-flex flex-row m-0 p-0">
                                        <!-- Memory -->
                                        <div class="col-6 col-md-4 m-0 p-0 pb-2 pe-2">
                                            <div class="border border-2 rounded-4 shadow-sm bg-white py-4 m-0 p-0 px-3" style="height: 100px">
                                                <div class="m-0 p-0 mb-3 text-start">
                                                    <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/ramicon.svg" width="18">
                                                    <span class="text-secondary m-0 p-0 ps-2">
                                                        {{ lang('memory') }}
                                                    </span>
                                                </div>

                                                <div v-if="!machineIsLoaded" class="text-start m-0 p-0">
                                                    <span class="m-0 p-0 fs-6 ps-2 text-primary">
                                                        ---
                                                    </span>
                                                </div>
                                                <div v-else class="m-0 p-0 text-start">
                                                    <span class="m-0 p-0 fs-6 text-primary ps-1">
                                                        {{ machine.memorySize }}
                                                        {{ lang('mb') }}
                                                    </span>
                                                    <span class="m-0 p-0 fs-6 ps-2 text-primary">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Disk -->
                                        <div class="col-6 col-md-4 m-0 p-0 pb-2 pe-2 d-none d-md-block">
                                            <div class="border border-2 rounded-4 shadow-sm bg-white py-4 m-0 p-0 px-3" style="height: 100px">
                                                <div class="m-0 p-0 mb-3 text-start">
                                                    <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/diskicon.svg" width="18">
                                                    <span class="m-0 p-0 text-secondary ps-2">
                                                        {{ lang('disk') }}
                                                    </span>
                                                </div>

                                                <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                                                    <span class="m-0 p-0 fs-6 ps-2 text-primary">
                                                        ---
                                                    </span>
                                                </div>
                                                <div v-else class="m-0 p-0 text-primary text-start">
                                                    <span class="m-0 p-0 fs-6 text-primary ps-1">
                                                        {{ machine.diskSize }}
                                                        {{ lang('gb') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- CPU -->
                                        <div class="col-6 col-md-4 m-0 p-0 pb-2">
                                            <div class="border border-2 rounded-4 shadow-sm bg-white py-4 m-0 p-0 px-3" style="height: 100px">
                                                <div class="m-0 p-0 mb-3 text-start">
                                                    <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/cpuicon.svg" width="18">
                                                    <span class="m-0 p-0 text-secondary ps-2">
                                                    {{ lang('cpu') }}
                                                    </span>
                                                </div>

                                                <div v-if="!machineIsLoaded" class="m-0 p-0 text-start">
                                                    <span class="m-0 p-0 fs-6 ps-2 text-primary">
                                                        ---
                                                    </span>
                                                </div>
                                                <div v-else class="m-0 p-0 text-primary text-start">
                                                    <span class="m-0 p-0 fs-6 ps-1">
                                                        {{ machine.cpuCore }} 
                                                        {{ lang('core') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div><!-- end -->
                            </div>
                        </div>
                    </div><!-- End Show info -->
                </div>
            </div>
        </div>
        <!-- Fotter file -->
        <footer>
            <?php include_once('view/footer.php');  ?>
        </footer>
    </body>
</html>
