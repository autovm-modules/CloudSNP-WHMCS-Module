<div class="row justify-content-start align-items-center">
    <a class="col-auto fs-4 fw-light text-dark text-decoration-none" href="<?php echo($BackLinkAdmin); ?>">
    <?php if ($templatelang == 'Farsi'): ?>
        <i class="bi bi-arrow-right me-2 fs-4"></i>
    <?php else: ?> 
        <i class="bi bi-arrow-left me-2 fs-4"></i>
    <?php endif ?>
        {{ lang('backtoservices') }}
    </a>
</div>