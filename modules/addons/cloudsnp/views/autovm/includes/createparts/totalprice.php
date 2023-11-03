<div v-if="NewMachinePrice != null" class="row m-0 p-0">
    <div class="col-12 m-0 p-0">
        <div class="d-flex flex-row align-items-center justify-content-end">
            <span v-if="CurrenciesRatioCloudToWhmcs != null " class="m-0 p-0 px-2" style="background-color: rgba(255, 255, 255, 0); border: 0px;">
                {{ ConverFromAutoVmToWhmcs(NewMachinePrice) }} {{ userCurrencySymbolFromWhmcs }}
            </span>
            <span class="m-0 p-0 px-2 py-1" style="width: 80px;">
                /{{ lang('monthly') }}
            </span>
        </div>
    </div>
    <div class="col-12 m-0 p-0">
        <div class="d-flex flex-row align-items-center justify-content-end">
            <span v-if="CurrenciesRatioCloudToWhmcs != null" class="m-0 p-0 px-2" style="background-color: rgba(255, 255, 255, 0); border: 0px;">
                {{ ConverFromAutoVmToWhmcsHourly(NewMachinePrice / (30 * 24)) }} {{ userCurrencySymbolFromWhmcs }}
            </span>
            <span class="m-0 p-0 px-2 py-1" style="width: 80px;">
                /{{ lang('hourly') }}
            </span>
        </div>
    </div>
</div>