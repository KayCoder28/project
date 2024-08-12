<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <style type="text/css">
        	div.demo {
        		width: 50px;
        		height: 50px;
        		display: inline-block;
        		background: blue;
        	}
        	table {
        		max-width: 100%;
    			background-color: transparent;
        	}
        	thead {
        		    display: table-header-group;
				    vertical-align: middle;
				    border-color: inherit;
        	}
        	tbody {
        			display: table-row-group;
				    vertical-align: middle;
				    border-color: inherit;
        	}
        </style>
    </head>
    <body>
       <div class="demo"></div>
        <p>Thông tin khách hàng:</p>
        <p>Full name: {{ $getRequest['name'] }}</p>
        <p>Phone: {{ $getRequest['phone'] }}</p>
        <p>Address: {{ $getRequest['address'] }}</p>
    	<p></p>
    	<p></p>
    	<p>Thong tin giỏ hàng:</p>
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
    </body>
</html>