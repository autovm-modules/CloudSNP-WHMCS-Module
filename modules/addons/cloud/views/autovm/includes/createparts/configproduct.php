<!-- Configure plans -->
<div class="row m-0 p-0 py-5 my-5">    
    <div class="col-12" style="--bs-bg-opacity: 0.1;">
        
        <!-- title -->
        <div class="row">
            <div class="m-0 p-0">
                <span class="text-dark h5">
                    Configure plans
                </span>
            </div>
            <div class="m-0 p-0">
                <span class="fs-6 pt-1 pb-4 text-secondary">
                    Configure this plan in your favore
                </span>
            </div>
        </div>
    
        <!-- No selection -->
        <div v-if="planId == null" class="row mt-5">
            <div class="col-12 mb-5" >
                <div class="alert alert-primary border-0" role="alert" style="--bs-alert-bg: #cfe2ff73; --bs-alert-border-color: #9ec5fe6e;">
                    Please, select a Plan first form above list
                </div>
            </div>
        </div>

        <!-- order details -->
        <div v-if="planId != null" class="row mt-5">
            <p>
                planTrafficPrice= {{ planTrafficPrice }}
            </p>
            <p>
                planMemoryPrice= {{ planMemoryPrice }}
            </p>
            <p>
                planCpuCorePrice= {{ planCpuCorePrice }}
            </p>
            <p>
                planCpuLimitPrice= {{ planCpuLimitPrice }}
            </p>
            <p>
                planDiskPrice= {{ planDiskPrice }}
            </p>
        </div> <!-- end order  -->

    </div>
</div>
<!-- end plan -->

