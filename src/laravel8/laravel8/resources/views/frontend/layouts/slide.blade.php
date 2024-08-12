
<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						@foreach($getHighlightProduct as $key => $value)
							<li data-target="#slider-carousel" data-slide-to="{{$key}}" class="{{ $key==0 ? 'active' : '' }}"></li>
						@endforeach
					</ol>
					
						<div class="carousel-inner">
							@foreach($getHighlightProduct as $key => $value)
							<?php
				                $getArrImage = json_decode($value['image'],true);
				            ?>
							<div class="item {{ $key==0 ? 'active' : '' }}">
								<div class="col-sm-6">
									<h1><span>{{ $value['brand']['brand'] }}</span></h1>
									<h2>{{ $value['name'] }}</h2>
									<p>{{ $value['detail'] }}</p>
									<a href="{{ url('/detail-product/'.$value['id']) }}"><button type="button" class="btn btn-default get">Get it now</button></a>
								</div>
								<div class="col-sm-6">
									<img src="{{ URL::to('upload/product/'.$value['id_user'].'/larger_'.$getArrImage[0]) }}" class="girl img-responsive" alt="" />
									<img src="{{ asset('frontend/images/home/pricing.png') }}"  class="pricing" alt="" />
								</div>
							</div>
							@endforeach
						</div>
					
					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				
			</div>
		</div>
	</div>
</section><!--/slider-->