<!-- Same  -->


<!-- Last Action -->
<div class="align-middle align-items-center">
    <p class="p-0 m-0">
        <span class="text-secondary fw-medium">{{ lang('lastaction') }}</span>
        <span v-if="actionMethod == 'reboot'">{{ lang('rebootaction') }}</span>
        <span v-if="actionMethod == 'stop'">{{ lang('stopaction') }}</span>
        <span v-if="actionMethod == 'start'">{{ lang('startaction') }}</span>
        <span v-if="actionMethod == 'console'">{{ lang('consoleaction') }}</span>
        <span v-if="actionMethod == 'setup'">{{ lang('setup') }}</span>
        <span v-if="actionMethod == 'suspend'">{{ lang('suspend') }}</span>
        <span v-if="actionMethod == 'unsuspend'">{{ lang('unsuspend') }}</span>
        <span v-if="actionMethod == 'snapshot'">{{ lang('snapshot') }}</span>
        
        <span v-if="actionStatus == 'completed'" class="text-secondary px-1"> ({{ lang('actionstatuscompleted') }})</span>
        <span v-if="actionStatus == 'pending'" class="text-danger px-1"> ({{ lang('actionstatuspending') }})</span>
        <span v-if="actionStatus == 'processing'" class="text-primary px-1"> ({{ lang('actionstatusprocessing') }})</span>
        <span v-if="actionStatus == 'failed'" class="text-primary px-1"> ({{ lang('failed') }})</span>
        <span v-if="actionStatus == 'cancelled'" class="text-primary px-1"> ({{ lang('cancelled') }})</span>
    </p>
</div>