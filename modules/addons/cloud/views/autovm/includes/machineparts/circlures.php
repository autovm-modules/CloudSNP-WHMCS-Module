<!-- same in middle, after bandwidth -->
<!-- Circular Graphs -->
<!-- Change d-none for curcular last two -->

<div class="row d-flex flex-row align-items-stretch m-0 p-0">

    <!--  circles -->
    <div class="col-12 col-md-8 col-xxl-9 p-0 m-0 mb-3 pe-md-2 pe-xxl-0">
        <div class="row border border-2 rounded-4 bg-white m-0 p-0 me-xxl-2 h-100 align-items-center">
            
            <div class="col-6 col-sm-6 col-md-4 m-0 p-0">
                <div class="ramRadial m-0 p-0"></div>
            </div>

            <div class="col-6 col-sm-6 col-md-4 m-0 p-0">
                <div class="cpuRadial m-0 p-0"></div>
            </div>

            <div class="col-6 col-sm-6 col-md-4 m-0 p-0 d-none d-md-block">
                <div class="diskRadial m-0 p-0"></div>
            </div>

        </div>
    </div><!-- end circles -->
 
    <!-- Buttons enabled -->
    <div v-if="actionStatus == 'completed' || actionStatus == 'failed'" class="col-12 col-md-4 col-xxl-3 p-0 m-0 mb-3">
        <div class="m-0 p-0 h-100">
            <div class="row m-0 p-0">
                <div class="col-6 col-lg-6 m-0 p-0 px-1 mb-2">
                    <div @click="doReboot" data-bs-toggle="modal" data-bs-target="#actionsModal"
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="/modules/servers/product/views/view/assets/img/resetbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('rebootaction') }}</p>
                    </div>
                </div>
                <div @click="doStop" data-bs-toggle="modal" data-bs-target="#actionsModal"
                    class="col-6 col-lg-6 m-0 m-0 p-0 px-1 pe-md-0 mb-2">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="/modules/servers/product/views/view/assets/img/offbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('stopaction') }}</p>
                    </div>
                </div>

                <div @click="doConsole" data-bs-toggle="modal" data-bs-target="#consoleModal"
                    class="col-6 col-lg-6 m-0 p-0 px-1">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="/modules/servers/product/views/view/assets/img/setupbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('consoleaction') }}</p>
                    </div>
                </div>
                <div @click="doStart" data-bs-toggle="modal" data-bs-target="#actionsModal"
                    class="col-6 col-lg-6 m-0 p-0 ps-1">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="/modules/servers/product/views/view/assets/img/onbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('startaction') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end Buttons -->

    
    <!-- BTN while processing -->
    <div v-else-if="actionStatus != 'completed' && actionStatus != 'failed'" class="col-12 col-md-4 col-xxl-3 p-0 m-0 mb-3">
        <div class="m-0 p-0 h-100">
            <div class="row m-0 p-0">
                <div class="col-6 col-lg-6 m-0 p-0 px-1 mb-2">
                    <div data-bs-toggle="modal" data-bs-target="#processingModal"
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="/modules/servers/product/views/view/assets/img/resetbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('rebootaction') }}</p>
                    </div>
                </div>
                <div data-bs-toggle="modal" data-bs-target="#processingModal"
                    class="col-6 col-lg-6 m-0 m-0 p-0 px-1 pe-md-0 mb-2">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="/modules/servers/product/views/view/assets/img/offbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('stopaction') }}</p>
                    </div>
                </div>

                <div data-bs-toggle="modal" data-bs-target="#processingModal"
                    class="col-6 col-lg-6 m-0 p-0 px-1">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="/modules/servers/product/views/view/assets/img/setupbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('consoleaction') }}</p>
                    </div>
                </div>
                <div data-bs-toggle="modal" data-bs-target="#processingModal"
                    class="col-6 col-lg-6 m-0 p-0 ps-1">
                    <div
                        class="border border-2 rounded-4 bg-white m-0 p-0 py-5 py-md-3 py-xl-5 px-3 mx-0 pt-md-5 text-center">
                        <img class="btn p-0 m-0" src="/modules/servers/product/views/view/assets/img/onbtn.svg" width=35 alt="internet">
                        <p class="text-secondary m-0 p-0 pt-3">{{ lang('startaction') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end Buttons -->


</div>
<!-- Circular Graphs -->

