@extends('frontend.layouts.app')

@section('content')


					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						@foreach($getBlog as $key => $value)
						<div class="single-blog-post">
							<h3>{{$value['title']}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="">
								<img src="{{URL::to('/upload/Blog/image/'.$value['image']) }} " alt="">
							</a>
							<p>{{$value['description']}}</p>
							<a  class="btn btn-primary" href="{{ url('/blog/single/'.$value['id'])}}">Read More</a>
						</div>
						@endforeach
						<div style="float: right; margin-right: 10px;">
                                    {{ $getBlog->links() }}

                        </div>
						
						<!-- <div class="pagination-area">
							<ul class="pagination">
								<li><a href="" class="active">1</a></li>
								<li><a href="">2</a></li>
								<li><a href="">3</a></li>
								<li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
							</ul>
						</div> -->
					</div>
				<!-- </div> -->

@endsection