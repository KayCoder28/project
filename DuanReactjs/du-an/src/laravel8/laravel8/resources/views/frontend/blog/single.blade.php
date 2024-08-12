@extends('frontend.layouts.app')

@section('content')
<style type="text/css">
	div.star {
		float: right;
	}
	div.star  span{
		float: left;
	}
	div.star span i{
		color: black;
	}
	.ratings_hover  i{
		color: orange !important;
	}
	.ratings_over i{
		color: orange !important;
	}

</style>

					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
							<h3>{{$getBlog['title']}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<!-- <span>
									<i class="fa fa-star checked"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</span> -->
								<div id="addStar" class="star">
									<span class="ratting-star">
										<i class="fa fa-star checked"></i>
										<input type="hidden" value="1">
									</span>
									<span class="ratting-star">
										<i class="fa fa-star"></i>
										<input type="hidden" value="2">
									</span>
									<span class="ratting-star">
										<i class="fa fa-star"></i>
										<input type="hidden" value="3">
									</span>
									<span class="ratting-star">
										<i class="fa fa-star"></i>
										<input type="hidden" value="4">
									</span>
									<span class="ratting-star">
										<i class="fa fa-star"></i>
										<input type="hidden" value="5">
									</span>
								</div>
							</div>
							<a href="">
								<img src="{{URL::to('/upload/Blog/image/'.$getBlog['image'])}}" alt="">
							</a>
							{!! $getBlog['content'] !!}
							
							<div class="pager-area">
								<ul class="pager pull-right">
									<?php
										if(!empty($previous)){
									?>
										<li><a href="{{url('/blog/single/'.$previous)}}">Pre</a></li>
									<?php
										}
									?>
									<?php
										if(!empty($next)){
									?>
										<li><a href="{{url('/blog/single/'.$next)}}">Next</a></li>
									<?php
										}
									?>
									
								</ul>
							</div>
						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Rate this item:</li>
							<li>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li>
							<li class="color">(6 votes)</li>
						</ul>
						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="{{URL::to('/upload/images/blog/socials.png')}}" alt=""></a>

					</div><!--/socials-share-->

					<div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="{{URL::to('/upload/images/blog/man-one.jpg')}}" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div><!--Comments-->
					<div class="response-area">
						<h2><?php if(!empty($getComment)) echo count($getComment);?> RESPONSES</h2>
						<ul class="media-list">
						
							@foreach($getComment as $value)
							<?php if($value->id_comment == 0){ ?>
								<li class="media">
									
									<a class="pull-left" href="#">

										<img class="media-object" style="width: 100px !important; " src=" {{ URL::to('/upload/user/avatar/'.$value->image_user) }}" alt="">
									</a>
									
									<div class="media-body">
										<ul class="sinlge-post-meta">
											<li><i class="fa fa-user"></i>{{$value->name_user}}</li>
											<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
											<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
										</ul>
										<p>{{$value->comment}}</p>
										<a  class="btn btn-primary getIDcmt" id="{{$value->id}}" href="#comment"><i class="fa fa-reply"></i>Replay</a>
										{{$value->id}}
									</div>
								</li>
								@foreach($getComment as $value1)
								<?php if($value1->id_comment == $value->id){ ?>
									<li class="media second-media">
									<a class="pull-left" href="#">
										<img style="width: 100px !important; " class="media-object" style="width: auto !important; " src="{{ URL::to('/upload/user/avatar/'.$value1->image_user) }}" alt="">
									</a>
									<div class="media-body">
										<ul class="sinlge-post-meta">
											<li><i class="fa fa-user"></i>{{$value1->name_user}}</li>
											<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
											<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
										</ul>
										<p>{{$value1->comment}}</p>
										<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
									</div>
									</li>
								<?php }?>
								@endforeach
							<?php }?>
							@endforeach
							
						</ul>				
					
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div >
								<h2>Leave a replay</h2>
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
								<form id="comment" enctype="multipart/form-data" method="POST">
									@csrf
									<!-- <div class="blank-arrow">
										<label>Your Name</label>
									</div>
									<span>*</span>
									<input id="name_user" name="name_user" type="text" placeholder="write your name..."> -->
									<!-- <div class="blank-arrow">
										<label>Email Address</label>
									</div>
									<span>*</span>
									<input type="email" placeholder="your email address..."> -->
									<!-- <div class="blank-arrow">
										<label>Web Site</label>
									</div>
									<input type="email" placeholder="current city..."> -->
									<div class="blank-arrow">
										<label>Your Comment</label>
									</div>
									<span>*</span>
									<textarea id="comment" name="comment" rows="11"></textarea>
									<input type="hidden" id="id_comment" name="id_comment" value="0">
									<button id="submit_form" type="submit" class=" btn btn-primary">post comment</button>
								</form>
							</div>
							
						</div>
					</div><!--/Repaly Box-->
					
	
<script type="text/javascript">
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	});

	$(document).ready(function(){
		
		$('a.getIDcmt').click(function(){
			var id = $(this).attr('id');
			$('input#id_comment').val(id);
		});

		$('button#submit_form').click(function(){
			var loggedIn = "{{Auth::check()}}";
			// console.log(loggedIn);

			if ( loggedIn == "" ){ 
	    		alert('Please to login before comment!');
	    		// console.log('asdasd');
	    	}else
				return true;
		})

		//ratting
		$('.ratting-star').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_hover');
                // $(this).nextAll().removeClass('ratings_vote'); 
            },
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_hover');
                // set_votes($(this).parent());
            }
        );

        $('.ratting-star').click(function(e){
			var values =  $(this).find("input").val();
	        // $('p.rating_kq').text("rate: "+Values+" stars!");
	    	if ($(this).hasClass('ratings_over')) {
	            $('.ratting-star').removeClass('ratings_over');
	            $(this).prevAll().andSelf().addClass('ratings_over');
	        } else {
	        	$(this).prevAll().andSelf().addClass('ratings_over');
	        }

		    e.preventDefault();
		    
		    $.ajax({
	           type:'POST',
	           url:'/blog/ajaxRequest',
	           data:{values:values},
	           success:function(data){
	              console.log(data.success);
	           }
	        });
	    });  

	})

</script>

@endsection
