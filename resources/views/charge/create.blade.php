<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create New Charge</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

	<script type="text/javascript">
	    // This identifies your website in the createToken call below
	    Stripe.setPublishableKey('pk_test_qx6HZIL9k78PB0LbUMIxa28C');
	    var stripeResponseHandler = function(status, response) {
	      var $form = $('#payment-form');
	      if (response.error) {
	        // Show the errors on the form
	        $form.find('.payment-errors').text(response.error.message);
	        $form.find('button').prop('disabled', false);
	      } else {
	        // token contains id, last4, and card type
	        var token = response.id;
	        // Insert the token into the form so it gets submitted to the server
	        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
	        // and re-submit
	        $form.get(0).submit();
	      }
	    };
	    jQuery(function($) {
	      $('#payment-form').submit(function(e) {
	        var $form = $(this);
	        // Disable the submit button to prevent repeated clicks
	        $form.find('button').prop('disabled', true);
	        Stripe.card.createToken($form, stripeResponseHandler);
	        // Prevent the form from submitting with the default action
	        return false;
	      });
	    });
  	</script>

</head>
<body>
	<div class="container">
	<h2>Create New Charge</h2>
	<form action="/charge/store" method="POST" id="payment-form">

		<div class="form-group">
			<label>
			  <span>Amount</span>
			  <input type="text" size="20" class="form-control" name="amount">
			</label>
		</div>

		<div class="form-group">
			<label>
			  <span>Currency</span>
			  <input type="text" size="4" class="form-control" name="currency" value="usd">
			</label>
		</div>

		<div class="form-group">
			<label>
			  <span>Description</span>
			  <textarea class="form-control" rows="3" name="description"></textarea>
			</label>
		</div>

		<hr>
		<span class="payment-errors"></span>
		<div class="form-row">
			<label>
				<span>Card Number</span>
				<input type="text" size="20" data-stripe="number" value="4242424242424242" />
			</label>
	    </div>

	    <div class="form-row">
			<label>
				<span>CVC</span>
				<input type="text" size="4" data-stripe="cvc" value="314" />
			</label>
	    </div>

	    <div class="form-row">
			<label>
				<span>Expiration (MM/YYYY)</span>
				<input type="text" size="2" data-stripe="exp-month" value="8" />
			</label>
	      	<span> / </span>
	      	<input type="text" size="4" data-stripe="exp-year" value="2016" />
	    </div>
		<br>
		<button type="submit" class="btn btn-primary">Submit Payment</button>
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">
	</form>
	</div>
</body>
</html>