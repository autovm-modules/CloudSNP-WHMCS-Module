<!-- Cost Table -->
<div v-if="planIsSelected" class="row m-0 p-0 py-5 my-5 border border-2 p-4 bg-body-secondary rounded-4 ms-md-2" style="height: 550px;">    
    <div class="col-12" style="--bs-bg-opacity: 0.1;">
        
        <!-- title -->
        <div class="row">
            <div class="m-0 p-0">
                <p class="text-dark h3">
                    Price Table
                </p>
            </div>
            <div class="m-0 p-0 mt-3">
                <span class="fs-6 pt-1 pb-4 text-secondary"> 
                    See your order details
                </span>
            </div>
        </div>

        <!-- Ready to show Table -->
        <div class="row p-0 m-0 mt-4">
            <!-- Machien Config price  -->
            <div class="col-12 col-md-12 m-0 p-0 mb-4">
                <?php include('configprice.php'); ?>
            </div>
        </div>
    

        <!-- Summery Table -->
        <div class="row mt-5">
            <div class="m-0 p-0">
                <p class="text-dark h4">
                    <i class="bi bi-currency-exchange text-secondary p-0 m-0 me-3 h5"></i>
                    <span>Total Cost</span>
                </p>
            </div>
        </div>
            
        <!-- Total Price -->
        <div class="col-12 col-md-12 py-4"> 
            <?php include('totalprice.php'); ?>
        </div>
    </div>
</div>




