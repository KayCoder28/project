@extends('frontend.layouts.app')

@section('content')

	<div class="col-md-12 padding-right">
		<div class="product-details"><!--product-details-->
			<div class="col-sm-5">
				<img src="{{ $getProduct['status']==0 ? URL::to('upload/icon/new.png') : URL::to('upload/icon/sale.png') }}" class="newarrival" alt="" />
				<div class="view-product">

					<img id="img_main" src="{{ URL::to('upload/product/'.$getProduct['id_user'].'/'.$getArrImage[0]) }}" alt="" />
					<a id="img_zoom" href="{{ URL::to('upload/product/'.$getProduct['id_user'].'/'.$getArrImage[0]) }}" rel="prettyPhoto"><h3>ZOOM</h3></a>
					
				</div>
				<div id="similar-product" class="carousel slide" data-ride="carousel">
					
					  <!-- Wrapper for slides -->
					    <div class="carousel-inner">

							<div class="item active">
								@foreach(array_slice($getArrImage, 0, 3) as $image)
									<a><img class="choose" src="{{ URL::to('upload/product/'.$getProduct['id_user'].'/small_'.$image) }}" alt=""></a>
								@endforeach
							</div>

							<div class="item">
							  @foreach(array_slice($getArrImage, -2) as $image)
									<a><img class="choose" src="{{ URL::to('upload/product/'.$getProduct['id_user'].'/small_'.$image) }}" alt=""></a>
								@endforeach
							</div>
							
							
						</div>

					  <!-- Controls -->
					  <a class="left item-control" href="#similar-product" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					  </a>
					  <a class="right item-control" href="#similar-product" data-slide="next">
						<i class="fa fa-angle-right"></i>
					  </a>
				</div>

			</div>
			<div class="col-sm-7">
				<div class="product-information"><!--/product-information-->
					
					<h2>{{ $getProduct['name'] }}</h2>
					<p>WEB ID : {{ $getProduct['web_id'] }}</p>
					<span>Rating ({{ count($getRate	) }})  :</span>
					<form style="display: inline-block;" method="POST">
						@csrf

						<div class="rating">

				  			<div class="star one">
				  				
				  				<input type="hidden" value="1">
				  			</div>
				  			<div class="star two">
				  				
				  				<input type="hidden" value="2">
				  			</div>
				  			<div class="star three">
				  				
				  				<input type="hidden" value="3">
				  			</div>
				  			<div class="star four">
				  				
				  				<input type="hidden" value="4">
				  			</div>
				  			<div class="star five">
				  				
				  				<input type="hidden" value="5">
				  			</div>

				  			<span class="value" style="font-weight: bold; color: orange;"></span>
				  			
				  			<input type="text" name="id_product" value="{{ $getProduct['id'] }}" hidden="">
				  			<input type="text" name="id_user" value="{{ isset(Auth::user()->id) ? Auth::user()->id : '' }}" hidden="">
				  		</div>
					</form>
					<p class="ajax-rated"></p>
					<span>
						@if ($getProduct['status'] == 0)
	                        <span class="price">{{ number_format($getProduct['price']) }} $</span>
	                        @else
	                        <span class="price_sale">{{ number_format($getProduct['price']) }}$</span>
	                        <span class="price">{{ number_format($getProduct['price']*(100-$getProduct['sale'])/100) }}$</span>
                        @endif
						<!-- <label>Quantity:</label>
						<input type="text" value="3" /> -->
						<button type="button" class="btn btn-fefault cart">
							<i class="fa fa-shopping-cart"></i>
							Add to cart
						</button>
					</span>
					<p><b>Availability:</b> In Stock</p>
					<p><b>Condition:</b>{{ $getProduct['condition'] }}</p>
					<p><b>Brand: </b>{{ $Brand['brand'] }}</p>
					<p><b>Rating: </b>{{ isset($avgRate) ? number_format($avgRate,1) : '' }}  <img style="width: 12px;" src="{{ URL('upload/icon/star-rating.png') }}"></p>
					
				</div><!--/product-information-->
			</div>
		</div><!--/product-details-->
		
		<div class="category-tab shop-details-tab"><!--category-tab-->
			<div class="col-sm-12">
				<ul class="nav nav-tabs">
					<li><a href="#details" data-toggle="tab">Details</a></li>
					<li><a href="#company_profile" data-toggle="tab">Company Profile</a></li>
					<li><a href="#tag" data-toggle="tab">Tag</a></li>
					<li class="active"><a href="#reviews" data-toggle="tab">Reviews ({{ count($review)+count($review_sub) }})</a></li>
				</ul>
			</div>
			<div class="tab-content">
				
				<div class="tab-pane fade in" id="details">
					{{ $getProduct['detail'] }}
				</div>


				<div class="tab-pane fade in" id="company_profile">
					{{ $getProduct['company_profile'] }}
				</div>


				<div class="tab-pane fade active in" id="reviews" >
					<div class="col-sm-12">
						<ul class="review_list">
							@foreach($review as $review)
							<li class="media">
								<a class="pull-left">
									<img style="width: 120px; height: 100px;" class="media-object"  src="{{ URL::to('upload/'.$review['avatar_user']) }}" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li class="reply_user"><i class="fa fa-user"></i>{{ $review['name_user'] }}</li>
										<li><i class="fa fa-clock-o"></i>{{ date('H:i:s',strtotime($review['created_at'])) }}</li>
										<li><i class="fa fa-calendar"></i>{{ date('d/m/Y',strtotime($review['created_at'])) }}</li>
									</ul>
									<p>{{ $review['review'] }}</p>
									<a class="btn btn-primary reply" id="{{ $review['id'] }}" ><i class="fa fa-reply"></i>Reply this review</a>
								</div> 
							</li>
								@foreach($review_sub as $value)
									@if($value['id_sub'] == $review['id'])
										<li class="media second-media">
											<a class="pull-left">
												<img style="width: 120px; height: 100px;" class="media-object"  src="{{ URL::to('upload/'.$value['name_user']).'.jpg' }}" alt="">
											</a>
											<div class="media-body">
												<ul class="sinlge-post-meta">
													<li><i class="fa fa-user"></i>{{ $value['name_user'] }}</li>
													<li><i class="fa fa-clock-o"></i>{{ date('H:i:s',strtotime($value['created_at'])) }}</li>
													<li><i class="fa fa-calendar"></i>{{ date('d/m/Y',strtotime($value['created_at'])) }}</li>
												</ul>
												<p>{{ $value['review'] }}</p>
												<!-- <a class="btn btn-primary reply" id="{{ $value['id'] }}" ><i class="fa fa-reply"></i>Reply this review</a> -->
											</div>
										</li>
									@endif
								@endforeach
							@endforeach
						</ul>
					</div>




					<div class="col-sm-12">
						<ul>
							<li><a><i class="fa fa-user"></i>{{ Auth::check() ? Auth::user()->name : '' }}</a></li>

							<li><a><i class="fa fa-clock-o"></i>{{ date('H:i') }}</a></li>
							<li><a><i class="fa fa-calendar-o"></i>{{ date('d/m/Y') }}</a></li>
						</ul>					
                        <p class="auth_check"></p>
						<p><b>Write Your Review</b></p>
						@if (Session('success'))
		                    <div class="alert alert-success alert-block">
		                        <button type="button" class="close" data-dismiss="alert">×</button>
		                            <strong>{{ Session('success') }}</strong>
		                    </div>
		                @endif
						<form id="form_review" method="POST">
							@csrf
							<div class="alert alert-info reply_user">
								<button type="button" class="close_reply" data-dismiss="alert">×</button>
							</div>
							<textarea name="review" ></textarea>
							<input type="text" name="id_sub" id="id_sub" value="" hidden="">
							<!-- <b>Rating: </b> <img src="images/product-details/rating.png" alt="" /> -->
							<button type="submit" class="btn btn-default pull-right">
								Submit
							</button>
						</form>
					</div>
				</div>
				
			</div>
		</div><!--/category-tab-->
		
		<!-- <div class="recommended_items">
			<h2 class="title text-center">recommended items</h2>
			
			<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="item active">	
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="images/home/recommend1.jpg" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="images/home/recommend2.jpg" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="images/home/recommend3.jpg" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="item">	
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="images/home/recommend1.jpg" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="images/home/recommend2.jpg" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="images/home/recommend3.jpg" alt="" />
										<h2>$56</h2>
										<p>Easy Polo Black Edition</p>
										<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				  </a>
				  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
					<i class="fa fa-angle-right"></i>
				  </a>			
			</div>
		</div> -->
		
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
		    $("a[rel^='prettyPhoto']").prettyPhoto();
		    $('.choose').click(function(){
		    	var link = $(this).attr('src');
		    	var link_replace = link.replace('small_','');
		    	
		    	$('#img_zoom').attr('href',link_replace);
		    	$('#img_main').attr('src',link_replace);
		    })
		    $('form#form_review').submit(function(){	    	
		    	var auth_check = <?= Auth::check() ? 'true' : 'false' ?>;
		    	if (!auth_check) {
		    		$('p.auth_check').text('Please login to submit your review. Click ').append('<a href="{{ url("/member-login") }}">Here</a>');
		    		$('p.auth_check').attr('class','alert alert-danger');
		    		return false;
		    	}
		    })
		    $('a.reply').click(function(){
		    	$('html, body').animate({
				    scrollTop: $("form#form_review").offset().top
				  }, 800);
		    	var id = $(this).attr('id');
		    	var reply_user = $(this).parent().find('.reply_user').text();
		    	console.log(reply_user);
		    	$('input#id_sub').attr('value',id);
		    	$('div.reply_user').show();
		    	$('div.reply_user').append('You are replying to review of '+ reply_user);
		    });
		    $('.close_reply').click(function(){
		    	$('input#id_sub').attr('value','');
		    });


		    $('div.star').hover(function(){
			    $(this).prevAll().andSelf().addClass('hover');
			  },
			  function(){
			    $(this).prevAll().andSelf().removeClass('hover');
			  });


		    $('div.star').click(function(){
			    $value = $(this).find('input').attr('value');
			    if($(this).hasClass('rated')) {
			      $(this).parent().find('.star').removeClass('rated');
			      $(this).prevAll().andSelf().addClass('rated');
			      $(this).parent().find('.value').text($value+'.0');
			    } else {
			      $(this).prevAll().andSelf().addClass('rated');    
			      $(this).parent().find('.value').text($value+'.0');
			    }
			  })





		    //ajax rating
			    $.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });		   

			    $("div.star").click(function(e){
			        e.preventDefault();
			        var rate = $(this).find('input').val();
			        var id_product = $("input[name=id_product]").val();
			        var id_user = $("input[name=id_user]").val();
			          
			        $.ajax({

			           type:'POST',

			           url:'/ajaxRating',

			           data:{rate:rate,id_product:id_product,id_user:id_user},

			           success:function(data){
			           		if (data == 1) {
			           			$('p.ajax-rated').text('You have rate this product successfully  ✔');
			           		} else {
			           			$('p.ajax-rated').text('Please login to rate this product. Click ').append('<a href="{{ url("/member-login") }}">here</a>');
			           		}
			              

			           }
			        });
				});
			});
    </script>
@endsection