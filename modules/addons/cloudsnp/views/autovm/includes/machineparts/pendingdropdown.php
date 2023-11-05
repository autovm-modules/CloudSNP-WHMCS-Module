<!-- SAME , this is newer-->

<!-- Action processing -->
<div  class="col-auto m-0 p-0">
    <div class="m-0 p-0 me-2">
        <div class="dropdown">
            
            <!-- No status -->
            <button v-if="!actionStatus" class="btn bg-warning text-dark px-2 px-md-3 px-lg-4 small dropdown-toggle" style="--bs-bg-opacity: 0.4;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="m-0 p-0 ps-2 fw-medium">Nothing</span>
            </button>

            <!-- Pending or Processing  -->
            <button v-else-if="actionStatus == 'pending' || actionStatus == 'processing'" class="btn bg-danger text-danger px-2 px-md-3 px-lg-4 small dropdown-toggle" style="--bs-bg-opacity: .2;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="spinner-grow spinner-grow-sm" role="status"></div>
                <span class="m-0 p-0 ps-2 fw-medium">{{ lang(actionMethod) }}</span>
                <span class="m-0 p-0 ps-1 small pe-3">({{ lang(actionStatus) }})</span>
            </button>
            
            <!-- Completed -->
            <button v-else-if="actionStatus == 'completed'" class="btn bg-primary text-primary px-2 px-md-3 px-lg-4 small dropdown-toggle" style="--bs-bg-opacity: .2;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="m-0 p-0 ps-2 fw-medium">{{ lang(actionMethod) }}</span>    
                <span class="m-0 p-0 ps-2 small pe-3">({{ lang(actionStatus) }})</span>
            </button>

            <!-- other -->
            <button v-else class="btn bg-warning text-dark px-2 px-md-3 px-lg-4 small dropdown-toggle" style="--bs-bg-opacity: 0.4;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="m-0 p-0 ps-2 fw-medium">{{ lang(actionMethod) }}</span>
                <span class="m-0 p-0 ps-1 small pe-3">({{ lang(actionStatus) }})</span>
            </button>
            
            
            <ul class="dropdown-menu" style="width: 250px; padding: 10px 5px;">
                <li class="dropdown-item">
                    <span class="fw-medium">{{ lang('currentaction') }}</span>
                    <span class="text-primary" v-if="!actionMethod"> Nothing </span>
                    <span class="text-primary" v-else-if="actionMethod">{{ lang(actionMethod) }}</span>
                </li>
                <li class="dropdown-item fw-medium">
                    <span class="fw-medium">{{ lang('status') }}</span>
                    <span class="px-1">:</span>
                    <span class="text-primary" v-if="!actionStatus">(...)</span>
                    <span class="text-primary" v-else-if="actionStatus">{{ lang(actionStatus) }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>