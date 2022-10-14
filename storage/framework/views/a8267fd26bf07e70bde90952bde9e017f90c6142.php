<?php $__env->startSection('extra-meta'); ?>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
 
	<?php if(Cart::count() > 0): ?>

	<div class="px-4 px-lg-0">

	  <div class="pb-5">
	    <div class="container">
	      <div class="row">
	        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

	          <!-- Shopping cart table -->
	          <div class="table-responsive">
	            <table class="table">
	              <thead>
	                <tr>
	                  <th scope="col" class="border-0 bg-light">
	                    <div class="p-2 px-3 text-uppercase">Produit</div>
	                  </th>
	                  <th scope="col" class="border-0 bg-light">
	                    <div class="py-2 text-uppercase">Prix</div>
	                  </th>
	                  <th scope="col" class="border-0 bg-light">
	                    <div class="py-2 text-uppercase">Quantité</div>
	                  </th>
	                  <th scope="col" class="border-0 bg-light">
	                    <div class="py-2 text-uppercase">Supprimer</div>
	                  </th>
	                </tr>
	              </thead>
	              <tbody>
	                 <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="<?php echo e(asset('storage/' . $product->model->image)); ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"> <a href="<?php echo e(route('products.show', ['slug' => $product->model->slug])); ?>" class="text-dark d-inline-block align-middle"><?php echo e($product->model->title); ?></a></h5><span class="text-muted font-weight-normal font-italic d-block">Catégories: <?php $__currentLoopData = $product->model->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($category->name); ?><?php echo e($loop->last ? '' : ', '); ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span>
	                      </div>
	                    </div>
	                  </th>
	                  <td class="border-0 align-middle"><strong><?php echo e(getPrice($product->subtotal())); ?></strong></td>
	                  <td class="border-0 align-middle">
	                  	<select name="qty" id="qty" data-id="<?php echo e($product->rowId); ?>" data-stock="<?php echo e($product->model->stock); ?>" 
	                  		class="custom-select">

	                  		<?php for($i = 1; $i <= 6 ; $i++): ?>
	                  			<option value="<?php echo e($i); ?>" <?php echo e($i == $product->qty ? 'selected' : ''); ?>><?php echo e($i); ?> </option>

	                  		<?php endfor; ?>

	                  	</select>

	                  </td>
	                  <td class="border-0 align-middle">

	                  	<form action="<?php echo e(route('cart.destroy', $product->rowId)); ?>" method="POST">
	                  		<?php echo csrf_field(); ?>
	                  		<?php echo method_field('DELETE'); ?>

	                  		<button type="submit" class="text-dark btn btn-danger"><i class="fa fa-trash"></i></a>

	                  	</form>

	                  </td>
	                </tr>



	                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


	              </tbody>
	            </table>
	          </div>
	          <!-- End -->
	        </div>
	      </div>

	      <div class="row py-5 p-4 bg-white rounded shadow-sm">
	        <div class="col-lg-6">
	          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Code coupon </div>
	          <div class="p-4">
	            <p class="font-italic mb-4">Si vous détenez un code Coupon, entrez-le dans le champ ci-dessous</p>
	            <div class="input-group mb-4 border rounded-pill p-2">
	              <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
	              <div class="input-group-append border-0">
	                <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Appliquer le  coupon</button>
	              </div>
	            </div>
	          </div>
	          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions pour le vendeur</div>
	          <div class="p-4">
	            <p class="font-italic mb-4">Si vous souhaitez ajouter des précisions à votre commande, merci de les rentrer dans le champ ci-dessous</p>
	            <textarea name="" cols="30" rows="2" class="form-control"></textarea>
	          </div>
	        </div>
	        <div class="col-lg-6">
	          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Détails de la commande  </div>
	          <div class="p-4">
	            <p class="font-italic mb-4">Les frais éventuels de livraison seront calculés suivant les informations que vous avez transmises.</p>
	            <ul class="list-unstyled mb-4">
	              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sous-total </strong><strong><?php echo e(getPrice(Cart::subtotal())); ?></strong></li>
	            <!--  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li> -->
	              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Taxe</strong><strong><?php echo e(getPrice(Cart::tax())); ?></strong></li>
	              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
	                <h5 class="font-weight-bold"><?php echo e(getPrice(Cart::total())); ?></h5>
	              </li>
	            </ul><a href="<?php echo e(route('checkout.index')); ?>" class="btn btn-dark rounded-pill py-2 btn-block">Passer a la caisse </a>
	          </div>
	        </div>
	      </div>

	    </div>
	  </div>
</div>
<?php else: ?>

	<div class="col-md-12">
    <h5>Votre panier est vide pour le moment.</h5>
    <p>Mais vous pouvez visiter la <a href="<?php echo e(route('products.index')); ?>">boutique</a> pour faire votre shopping.
    </p>
</div>

<?php endif; ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('extra-js'); ?>

<script >
		 var selects = document.querySelectorAll('#qty');
   			Array.from(selects).forEach((element) => {
   					element.addEventListener('change', function () {
   						var rowId = this.getAttribute('data-id');
   						var stock = this.getAttribute('data-stock');
   						var token =document.querySelector('meta[name="csrf-token"]').getAttribute('content');

   						fetch(
   							`/panier/${rowId}`,
   							{
   								headers: {
   									"Content-Type": "application/json",
				       				"Accept": "application/json, text-plain, */*",
				       				"X-Requested-With": "XMLHttpRequest",
				       				"X-CSRF-TOKEN": token

   								},
   								method: 'PATCH',
   								body:JSON.stringify({
			       				qty: this.value,
			       				stock: stock

			       			}) 
			   							}

			   					).then((data) => {
			   						console.log(data);
			   						location.reload();

			   					}).catch((error) => {
			   						console.log(error)

			   					})
   					});
   			});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\app_memoire\resources\views/cart/index.blade.php ENDPATH**/ ?>