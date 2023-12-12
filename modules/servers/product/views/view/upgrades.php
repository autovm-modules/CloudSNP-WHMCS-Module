<div class="row mt-4 justify-content-center">
    <div class="col-12">
        <!-- btn -->
        <div class="row justify-content-end pb-5">
                    <button class="col-auto btn btn-primary px-5" disabled>
                        {{ lang('upgradecloud') }} 
                    </button>
                </div>
        <div class="row justify-content-end px-2 px-md-4 px-xl-5 pt-5 pb-5 border border-2 rounded-4 bg-light" style="--bs-bg-opacity: 0.6;">
            <div class="col-12">
                
                


                <!-- CPU -->
                <div class="row my-5">
                    <div class="col-4 col-md-2 p-0 m-0 text-start">
                        <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/cpuicon.svg" alt="cpuicon">
                    <span class="p-0 m-0 ps-1 ps-md-3">
                        {{ lang('cpu') }} 
                    </span>
                    </div>
                    
                    <div class="col-4 col-md-10 col-lg-8 col-xxl-7 p-0 m-0">
                        <div class="progress rounded-5 flex-grow-1" 
                        style="height:20px"
                        role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            
                        <div v-if="!config.cpu" class="progress-bar rounded-5 progress-bar-striped progress-bar-animated" style="width: 100%; height:20px">
                            {{ lang('loadingmsg') }} 
                        </div>    
                        <div v-else-if="config.cpu == 0" class="progress-bar rounded-5" style="width: 100%; height:20px">no CPU</div>
                        <div v-else-if="config.cpu == 1" class="progress-bar rounded-5" style="width: 15%; height:20px">1 Core</div>
                        <div v-else-if="config.cpu == 2" class="progress-bar rounded-5" style="width: 30%; height:20px">2 Core</div>
                        <div v-else-if="config.cpu == 3" class="progress-bar rounded-5" style="width: 45%; height:20px">4 Core</div>
                        <div v-else-if="config.cpu == 4" class="progress-bar rounded-5" style="width: 70%; height:20px">6 Core</div>
                        <div v-else-if="config.cpu == 5" class="progress-bar rounded-5" style="width: 95%; height:20px">8 Core</div>
                            
                        </div>
                    </div>
                </div>





                <!-- Memory -->
                <div class="row my-5">
                    <div class="col-4 col-md-2 p-0 m-0 text-start">
                        <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/ramicon.svg" alt="cpuicon">
                        <span class="p-0 m-0 ps-1 ps-md-3">
                            {{ lang('memory') }}
                        </span>
                    </div>
                    
                    <div class="col-8 col-md-10 col-lg-8 col-xxl-7 p-0 m-0">
                        <div class="progress rounded-5 flex-grow-1" style="height:20px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div v-if="!config.memory" class="progress-bar rounded-5 progress-bar-striped progress-bar-animated" style="width: 100%; height:20px">{{ lang('loadingmsg') }}</div>
                            <div v-else-if="config.memory == 1024" class="progress-bar rounded-5" style="width: 20%; height:20px">1 GB</div>
                            <div v-else-if="config.memory == 2048" class="progress-bar rounded-5" style="width: 30%; height:20px">2 GB</div>
                            <div v-else-if="config.memory == 4096" class="progress-bar rounded-5" style="width: 40%; height:20px">4 GB</div>
                            <div v-else-if="config.memory == 8192" class="progress-bar rounded-5" style="width: 55%; height:20px">8 GB</div>
                            <div v-else-if="config.memory == 16384" class="progress-bar rounded-5" style="width: 70%; height:20px">16 GB</div>
                        </div>
                    </div>
                </div>







                <!-- Storage -->
                <div class="row my-5">
                    <div class="col-4 col-md-2 p-0 m-0 text-start">
                        <img src="<?php echo($PersonalRootDirectoryURL); ?>/modules/servers/product/views/view/assets/img/diskicon.svg" alt="cpuicon">
                        <span class="p-0 m-0 ps-1 ps-md-3">
                            {{ lang('disk') }}
                        </span>
                    </div>
                    
                    <div class="col-8 col-md-10 col-lg-8 col-xxl-7 p-0 m-0">
                        <div class="progress rounded-5 flex-grow-1" style="height:20px" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            
                            
                            <div v-if="!config.storage"  class="progress-bar rounded-5 progress-bar-striped progress-bar-animated" style="width: 100%; height:20px">{{ lang('loadingmsg') }}</div>
                            
                            <div v-else-if="config.storage == 20"  class="progress-bar rounded-5" :style="config.storagestyle">{{ config.storage }} GB</div>
                            <div v-else-if="config.storage == 100"  class="progress-bar rounded-5" :style="config.storagestyle">{{ config.storage }} GB</div>
                            <div v-else-if="config.storage == 150"  class="progress-bar rounded-5" :style="config.storagestyle">{{ config.storage }} GB</div>
                            <div v-else-if="config.storage == 200"  class="progress-bar rounded-5" :style="config.storagestyle">{{ config.storage }} GB</div>
                            <div v-else-if="config.storage == 250"  class="progress-bar rounded-5" :style="config.storagestyle">{{ config.storage }} GB</div>
                        </div>
                    </div>
                </div>
                


            </div>
        </div>
    </div>
</div>


