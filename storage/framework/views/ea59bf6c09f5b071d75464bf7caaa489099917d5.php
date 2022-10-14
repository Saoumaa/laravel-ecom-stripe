<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bureau</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php $__currentLoopData = Auth()->user()->orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="card">
                        <div class="card-header">
                                    Commande passée le <?php echo e(Carbon\Carbon::parse($order->payment_created_at)->format('d/m/Y a H:i')); ?>  d'un montant de <strong><?php echo e(getPrice($order->amount)); ?></strong>                 

                        </div>    

                        <div class="card-body">

                            <h6>Liste des produits</h6>

                            <?php $__currentLoopData = unserialize($order->products); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div>Nom du produit: <?php echo e($product[0]); ?></div>
                            <div>Prix: <?php echo e(getPrice($product[1])); ?></div>
                            <div>Quantité: <?php echo e($product[2]); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>                    

                    </div>


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\app_memoire\resources\views/home.blade.php ENDPATH**/ ?>