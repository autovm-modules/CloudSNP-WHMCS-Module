<!-- SAME -->









<!-- Action processing -->
<div v-if="actionStatus == 'processing' || actionStatus == 'pending'" class="col-auto m-0 p-0 d-none d-md-block">
    <div class="m-0 p-0 me-2">
        <div class="dropdown">
            <button class="btn bg-danger text-danger px-2 px-md-3 px-lg-4 small dropdown-toggle" style="--bs-bg-opacity: .2;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="spinner-grow spinner-grow-sm" role="status"></div>
                <span class="m-0 p-0 ps-2" v-if="actionStatus == 'pending'">{{ lang('pending') }}</span>
                <span class="m-0 p-0 ps-2" v-if="actionStatus == 'processing'">{{ lang('processing') }}</span>
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item">
                    <span class="small">{{ lang('lastaction') }}</span>
                    <span class="small text-primary" v-if="actionMethod == 'reboot'">{{ lang('rebootaction') }}</span>
                    <span class="small text-primary" v-if="actionMethod == 'stop'">{{ lang('stopaction') }}</span>
                    <span class="small text-primary" v-if="actionMethod == 'start'">{{ lang('startaction') }}</span>
                    <span class="small text-primary" v-if="actionMethod == 'console'">{{ lang('consoleaction') }}</span>
                    <span class="small text-primary" v-if="actionMethod == 'setup'">{{ lang('setup') }}</span>
                    <span class="small text-primary" v-if="actionMethod == 'destroy'">{{ lang('destroyaction') }}</span>
                    <span class="small text-primary" v-if="actionMethod == 'suspend'">{{ lang('suspend') }}</span>
                    <span class="small text-primary" v-if="actionMethod == 'unsuspend'">{{ lang('unsuspend') }}</span>
                    <span class="small text-primary" v-if="actionMethod == 'snapshot'">{{ lang('snapshot') }}</span>
                    
                    <!-- any action else -->
                    <span v-if="actionMethod && actionMethod != 'reboot' && actionMethod != 'stop' && actionMethod != 'start' && actionMethod != 'console' && actionMethod != 'setup' && actionMethod != 'destroy' && actionMethod != 'suspend' && actionMethod != 'unsuspend' && actionMethod != 'snapshot'"
                    class="small text-primary">
                        ???
                    </span>
                </li>
                <li class="dropdown-item">
                    <span class="small">{{ lang('status') }}</span>
                    <span class="px-1 small">:</span>
                    <span class="small text-primary" v-if="actionStatus == 'completed'">{{ lang('actionstatuscompleted') }}</span>
                    <span class="small text-primary" v-if="actionStatus == 'pending'">{{ lang('actionstatuspending') }}</span>
                    <span class="small text-primary" v-if="actionStatus == 'processing'">{{ lang('actionstatusprocessing') }}</span>
                    <span class="small text-primary" v-if="actionStatus == 'failed'">{{ lang('failed') }}</span>
                    <span class="small text-primary" v-if="actionStatus == 'cancelled'">{{ lang('cancelled') }}</span>

                    <!-- anything esle -->
                    <span v-if="actionStatus && actionStatus != 'completed' && actionStatus != 'pending' && actionStatus != 'processing' && actionStatus != 'failed' && actionStatus != 'cancelled'"
                    class="small text-primary">
                        ???
                    </span>

                </li>
            </ul>
        </div>
    </div>
</div>