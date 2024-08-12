@extends('frontend.layouts.app')

@section('content')

	<section id="cart_items">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Check out</li>
			</ol>
		</div><!--/breadcrums-->
		@if(!empty($product))
		<!-- <div class="step-one">
			<h2 class="heading">Step1</h2>
		</div>
		<div class="checkout-options">
			<h3>New User</h3>
			<p>Checkout options</p>
			<ul class="nav">
				<li>
					<label><input type="checkbox"> Register Account</label>
				</li>
				<li>
					<label><input type="checkbox"> Guest Checkout</label>
				</li>
				<li>
					<a href=""><i class="fa fa-times"></i>Cancel</a>
				</li>
			</ul>
		</div> --><!--/checkout-options-->

		<!-- <div class="register-req">
			<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
		</div> --><!--/register-req-->

		<div class="shopper-informations">
			<div class="row">
				<div class="col-sm-8">
					<div class="shopper-info">
						<p>Shopper Information</p>
						@if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
						<form method="POST" action="">
							@csrf
							<input type="text" placeholder="Email" name="email">
							<input type="text" placeholder="User Name" name="name">
							<input type="phone" placeholder="Phone" name="phone">
							<input type="address" placeholder="Address" name="address">
							<button type="submit" class="btn btn-primary">Continue</button>
						</form>
						
						
					</div>
				</div>
				<!-- <div class="col-sm-5 clearfix">
					<div class="bill-to">
						<p>Bill To</p>
						<div class="form-one">
							<form>
								<input type="text" placeholder="Email*">
								<input type="text" placeholder="First Name *">
								<input type="text" placeholder="Last Name *">

							</form>
						</div>
						<div class="form-two">
							<form>
								<input type="text" placeholder="Address *">
								<input type="text" placeholder="Phone *">
								<select>
									<option>-- Country --</option>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="order-message">
						<p>Shipping Order</p>
						<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
						<label><input type="checkbox"> Shipping to bill address</label>
					</div>	
				</div> -->					
			</div>
		</div>
		<div class="review-payment">
			<h2>Review & Payment</h2>
		</div>

		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu" id="">
						<td class="image">Item</td>
						<td class="description"></td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach($product as $key => $product)
					<?php
		                $getArrImage = json_decode($product['image'],true);
		            ?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{ URL::to('upload/product/'.$product['id_user'].'/small_'.$getArrImage[0]) }}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $product['name'] }}</a></h4>
								<p>Web ID: {{ $product['web_id'] }}</p>
							</td>
							<td class="cart_price">
								$<span class="price_product">{{ $product['price'] }}</span>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_down"> - </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $product['qty'] }}" autocomplete="off" size="2" min="0">
									<a class="cart_quantity_up"> + </a>
								</div>
							</td>
							<td class="cart_total">
								$<span class="product_total_price">{{ $product['price'] *  $product['qty']}}</span>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{ url('/cart-qty-delete/'.$product['id']) }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>

					@endforeach

					
						<td colspan="4">&nbsp;</td>
						<td colspan="2">
							<table class="table table-condensed total-result">
								
								<tr class="shipping-cost">
									<td>Shipping Cost</td>
									<td>Free</td>										
								</tr>
								<tr>
									<td>Total</td>
									<td>$<span class="cart_total_price">{{ $sum }}</span></td>
								</tr>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="payment-options">
			<span>
				<label><input type="checkbox"> Direct Bank Transfer</label>
			</span>
			<span>
				<label><input type="checkbox"> Check Payment</label>
			</span>
			<span>
				<label><input type="checkbox"> Paypal</label>
			</span>
		</div>
		@else
			<h3>You don't have any product in your cart.</h3>
		@endif
	</section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		
	    $('.product_total_price').each(function() {
	        $(this).text($(this).parent().prev().find('.cart_quantity_input').val() * $(this).parent().prev().prev().find('span.price_product').text());
	    });
	    
	    


	    
	    
		
		
		$('.cart_quantity_up').click(function(){
			$(this).prev().val(+ $(this).prev().val()+ 1);


			$(this).parent().parent().next().find('span.product_total_price').text($(this).prev().val() * $(this).parent().parent().prev().find('span.price_product').text());

			var sum = 0;
		    $('.product_total_price').each(function() {
		        sum += Number($(this).text());
		        
		    });
		    
		    $('.cart_total_price').text(sum);
		})
		$('.cart_quantity_down').click(function(){
			$(this).next().val(+ $(this).next().val()- 1);


			$(this).parent().parent().next().find('span.product_total_price').text($(this).next().val() * $(this).parent().parent().prev().find('span.price_product').text());

			var sum = 0;
			$('.product_total_price').each(function() {
		        sum += Number($(this).text());
		    });
		    
		    $(this).parents().find('.cart_total_price').text(sum);
		})
	})
</script>