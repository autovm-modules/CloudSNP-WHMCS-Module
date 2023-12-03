<div v-if="planIsSelected" class="d-flex flex-row justify-content-end m-0 p-0 pt-5 mb-5 pb-5">
    <div class="m-0 p-0">
        <a class="btn px-4 bg-secondary" style="--bs-bg-opacity: 0.3;" href="<?php echo($PersonalRootDirectoryURL); ?>/index.php?m=cloudsnp&action=pageIndex">{{ lang('cancel') }}</a>
        <a class="btn btn-primary mx-3"  @click="create" data-bs-toggle="modal" data-bs-target="#createModal">{{ lang('createmachine') }}</a>
    </div>
</div> 