@extends('app')

@section('breadcrumbs', Breadcrumbs::render('accounts.create'))

@section('content')
<h2>Create New Account</h2>
<form action="/account" method="POST" id="payment-form">
	<span class="payment-errors"></span>

	<div class="form-group">
		<label>
		  <span>Your email</span>
		  <input type="text" size="20" name="email" class="form-control">
		</label>
	</div>

	<div class="form-group">
		<label>
		  <span>Country (US)</span>
		  <input type="text" size="20" name="country" data-stripe="number" class="form-control">
		</label>
	</div>

	<div class="form-group">
		<label>
			<span>Managed</span>
			<select class="form-control" name="managed">
			<option value="false">false</option>
			<option value="true" selected>true</option>
			</select>
		</label>
	</div>

	<button type="submit" class="btn btn-primary">Submit Payment</button>
	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
</form>
@stop
