<form action="<?php echo e(route('products.search')); ?>" class="d-flex mr-3">
    <div class="form-group mb-0 mr-1">
        <input type="text" name="q" class="form-control" value="<?php echo e(request()->q ?? ''); ?>">
    </div>
    <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></button>
</form> <?php /**PATH D:\app_memoire\resources\views/partials/search.blade.php ENDPATH**/ ?>