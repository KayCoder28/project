@extends('frontend.layouts.app')

@section('content')
	@if(!empty($result))
		@foreach($result as $value)
	            <?php
	                $getArrImage = json_decode($value['image'],true);
	            ?>
	            
	            <div class="col-sm-4">
	                <div class="product-image-wrapper">
	                    <div class="single-products">
	                            <div class="productinfo text-center">
	                                <img src="{{ URL::to('upload/product/'.$value['id_user'].'/larger_'.$getArrImage[0]) }}" alt="" />
	                               

	                                @if ($value['status'] == 0)
	                                <span class="price">{{ number_format($value['price']) }}</span>
	                                @else
	                                <span class="price_sale">{{ number_format($value['price']) }}$</span>
	                                <span class="price">{{ number_format($value['price']*(100-$value['sale'])/100) }}$</span>
	                                @endif
	                                
	                                <p>{{ $value['name'] }}</p>
	                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
	                            </div>
	                            <div class="product-overlay">
	                                <div class="overlay-content">
	                                    @if ($value['status'] == 0)
	                                        <span class="price_overlay">{{ number_format($value['price']) }}</span>
	                                    @else
	                                        <span class="price_sale_overlay">{{ number_format($value['price']) }}$</span>
	                                        <span class="price_overlay">{{ number_format($value['price']*(100-$value['sale'])/100) }}$</span>
	                                    @endif
	                                    <p>{{ $value['name'] }}</p>
	                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
	                                </div>
	                            </div>
	                            <img class="new" src="{{ $value['status']==0 ? URL::to('upload/icon/new.png') : URL::to('upload/icon/sale.png') }}">
	                    </div>
	                    <div class="choose">
	                        <ul class="nav nav-pills nav-justified">
	                            <li><a href="{{ url('/detail-product/'.$value['id']) }}"><i class="fa fa-plus-square"></i>Product detail</a></li>
	                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        @endforeach
	    @elseif(!empty($result_price))
	    	@foreach($result as $value)
	            <?php
	                $getArrImage = json_decode($value['image'],true);
	            ?>
	            
	            <div class="col-sm-4">
	                <div class="product-image-wrapper">
	                    <div class="single-products">
	                            <div class="productinfo text-center">
	                                <img src="{{ URL::to('upload/product/'.$value['id_user'].'/larger_'.$getArrImage[0]) }}" alt="" />
	                               

	                                @if ($value['status'] == 0)
	                                <span class="price">{{ number_format($value['price']) }}</span>
	                                @else
	                                <span class="price_sale">{{ number_format($value['price']) }}$</span>
	                                <span class="price">{{ number_format($value['price']*(100-$value['sale'])/100) }}$</span>
	                                @endif
	                                
	                                <p>{{ $value['name'] }}</p>
	                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
	                            </div>
	                            <div class="product-overlay">
	                                <div class="overlay-content">
	                                    @if ($value['status'] == 0)
	                                        <span class="price overlay">{{ number_format($value['price']) }}</span>
	                                    @else
	                                        <span class="price_sale overlay">{{ number_format($value['price']) }}$</span>
	                                        <span class="price overlay">{{ number_format($value['price']*(100-$value['sale'])/100) }}$</span>
	                                    @endif
	                                    <p>{{ $value['name'] }}</p>
	                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
	                                </div>
	                            </div>
	                            <img class="new" src="{{ $value['status']==0 ? URL::to('upload/icon/new.png') : URL::to('upload/icon/sale.png') }}">
	                    </div>
	                    <div class="choose">
	                        <ul class="nav nav-pills nav-justified">
	                            <li><a href="{{ url('/detail-product/'.$value['id']) }}"><i class="fa fa-plus-square"></i>Product detail</a></li>
	                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        @endforeach
	    @else
	    	<p style="margin-left: 150px; display: inline-block;">Can't found any product with your keyword."</p>
	    @endif


@endsection