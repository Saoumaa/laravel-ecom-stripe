<?php $__env->startSection('extra-meta'); ?>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-script'); ?>


   <script src="https://js.stripe.com/v3/"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="col-md-12">
    <a href="<?php echo e(route('cart.index')); ?>" class="btn btn-sm btn-success mt-3">Revenir au panier</a>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h4 class="text-center pt-5">Procéder au paiement</h4>
            <form action="<?php echo e(route('checkout.store')); ?>" method="POST" class="my-4" id="payment-form">
                <?php echo csrf_field(); ?>
                <div id="card-element">
                <!-- Elements will create input elements here -->
                </div>

                <!-- We'll put the error messages in this element -->
                <div id="card-errors" role="alert"></div>

                <button class="btn btn-success btn-block mt-3" id="submit">
                    <i class="fa fa-credit-card" aria-hidden="true"></i> Payer maintenant (<?php echo e(getPrice(Cart::total())); ?>)
                </button>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-js'); ?>

<script>
	
		var stripe = Stripe("pk_test_51Hwb4QLhws6xnxzhtHHSzd8vllf8tS8eFc3n3Wfe9E8gJD6Xqbk4Vp5NUIAwrzEgOoQuoRWFB6RSq18OhFXI27yI00ybfloFpb");
		var elements = stripe.elements();


		var style = {
	      base: {
	        color: "#32325d",
	        fontFamily: 'Arial, sans-serif',
	        fontSmoothing: "antialiased",
	        fontSize: "16px",
	        "::placeholder": {
	          color: "#32325d"
	        }
	      },
	      invalid: {
	        fontFamily: 'Arial, sans-serif',
	        color: "#fa755a",
	        iconColor: "#fa755a"
	      }
	    };

	     var card = elements.create("card", { style: style });
    // Stripe injects an iframe into the DOM
    	card.mount("#card-element");

    	card.addEventListener('change',({error}) => {
    		const displayError = document.getElementById('card-errors');
    		if (error) {
    			displayError.classList.add('alert','alert-warning');
    			displayError.textContent = error.message;
    		} else {

    			displayError.classList.remove('alert','alert-warning');
    			displayError.textContent = '';
    		}


    	});

    	var submitButton = document.getElementById('submit');

	submitButton.addEventListener('click', function(ev) {
  	ev.preventDefault();
  	submitButton.disabled = true ;
  	stripe.confirmCardPayment("<?php echo e($clientSecret); ?>", {
    payment_method: {
      card: card
     
    }
  }).then(function(result) {
    if (result.error) {
      // Show error to your customer (e.g., insufficient funds)
      submitButton.disabled = false ;
      console.log(result.error.message);
    } else {
      // The payment has been processed!
      if (result.paymentIntent.status === 'succeeded') {

      	var paymentIntent = result.paymentIntent; 
      	var token =document.querySelector('meta[name="csrf-token"]').getAttribute('content');
       
       	var form = document.getElementById('payment-form');
       	var url = form.action;
       	

       	fetch(
       		url,
       		{
       			headers: {

       				"Content-Type": "application/json",
       				"Accept": "application/json, text-plain, */*",
       				"X-Requested-With": "XMLHttpRequest",
       				"X-CSRF-TOKEN": token


       			},
       			method: 'post',
       			body:JSON.stringify({
       				paymentIntent: paymentIntent

       			}) 
       		}
  
       		).then((data) => {
            if (data.status === 400) {

              var redirect = '/boutique';
            }  else {

              var redirect = '/merci';
            }

       			//console.log(data)
       			window.location.href = redirect;


       		}).catch((error) => {
       			console.log(error)
       		})

      }
    }
  });
});
 

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\app_memoire\resources\views/checkout/index.blade.php ENDPATH**/ ?>