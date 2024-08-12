@extends('frontend.layouts.app')

@section('content')

    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        
            @foreach($getAllProduct as $value)

                <?php
                    $getArrImage = json_decode($value['image'],true);
                ?>
                
                <div class="col-sm-4 home">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <img style="width: 242px; height: 252px;" src="{{ URL::to('upload/product/'.$value['id_user'].'/larger_'.$getArrImage[0]) }}" alt="" />
                                   

                                        @if ($value['status'] != 0 && $value['status'] != "")
                                            <span style="text-decoration: line-through" class="price_sale overlay">{{ number_format($value['price']) }}</span>
                                            <span  class="price overlay">{{ number_format($value['price']*(100-$value['sale'])/100) }}</span>
                                           
                                        @else
                                             <span class="price overlay">{{ number_format($value['price']) }}</span>
                                        @endif
                                    
                                    <p>{{ $value['name'] }}</p>
                                    <a href="#" id="{{ $value['id'] }}" class="btn btn-default add-to-cart add"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        @if ($value['status'] != 0 && $value['status'] != "")
                                            <span style="text-decoration: line-through" class="price_sale overlay">{{ number_format($value['price']) }}</span>
                                            <span  class="price overlay">{{ number_format($value['price']*(100-$value['sale'])/100) }}</span>
                                           
                                        @else
                                             <span class="price overlay">{{ number_format($value['price']) }}</span>
                                        @endif
                                        <p>{{ $value['name'] }}</p>
                                        <a href="" id="{{ $value['id'] }}" class="btn btn-default add-to-cart add" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
        
        <p class="result_price"></p>
    </div><!--features_items-->


    <div class="modal" id="myModal">
        <div style="margin: 100px auto;" class="modal-dialog">
            <div class="modal-content">

              
              <div class="modal-body">
                <button style="margin: 10px;" type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
             
              <div class="modal-body">
                <p style="font-size: 20px; display: inline-block;" class="cart-alert"></p>
              </div>
              
              <div class="modal-footer">
                <button type="button" id="button_modal" class="btn btn-success" ><a style="color: #fff;" href="{{ url('/yourCart') }}">Go to cart</a></button>
                <button type="button" id="button_modal" class="btn btn-success" data-dismiss="modal">Close</button>
              </div>

            </div>
        </div>
    </div>

    <!-- <div class="category-tab">
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
                <li><a href="#blazers" data-toggle="tab">Blazers</a></li>
                <li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
                <li><a href="#kids" data-toggle="tab">Kids</a></li>
                <li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tshirt" >
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery1.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery2.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery3.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery4.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane fade" id="blazers" >
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery4.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery3.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery2.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery1.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane fade" id="sunglass" >
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery3.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery4.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery1.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery2.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane fade" id="kids" >
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery1.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery2.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery3.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery4.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane fade" id="poloshirt" >
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery2.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery4.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery3.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('frontend/images/home/gallery1.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --><!--/category-tab-->

    <!-- <div class="recommended_items">
        <h2 class="title text-center">recommended items</h2>
        
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">   
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend1.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend2.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend3.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
                                    <img src="{{ asset('frontend/images/home/recommend1.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend2.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend3.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
    </div> --><!--/recommended_items-->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        function formatNumber (num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('a.add-to-cart').click(function(e){
            e.preventDefault();
            var getId = $(this).attr('id');
            console.log(getId);


            $.ajax({
                type:'GET',
                url:'/ajaxAddToCart',
                data:{getId:getId},
                success:function(response){
                    console.log(response);                   
                        $('p.cart-alert').text(response.success);
                    
                }
            })
        })







        $("div.slider-track").click(function(e){
            
            e.preventDefault();
            var getPrice = $('#sl2').trigger('change').val();
            console.log(getPrice)
            //var max = $('#max').val();

            
            $.ajax({

               type:'GET',

               url:'/ajaxPriceRange',

               data:{getPrice:getPrice},

               success:function(data){
                // data = JSON.parse(data);
                if (data.result) {
                    var result = data.result;
                    var html = '';
                    $.map(result, function(value, index){
                        var arrImg = JSON.parse(value['image']);
                        var img = "{{ URL::to('upload/product/') }}";
                        if (value['status'] == 0) {
                            var price = '<span class="price">'+formatNumber(value['price'])+' $</span>';
                        } else {
                            var price = '<span class="price_sale">'+formatNumber(value['price'])+' $</span>  <span class="price">'+formatNumber(value['price']*(100-value['sale'])/100)+' $</span>';
                        }
                        html+= '<div class="col-sm-4">' +
                                    '<div class="product-image-wrapper">' +
                                        '<div class="single-products">' +
                                            '<div class="productinfo text-center">'+ 
                                                '<img style="width: 242px; height: 252px;" src='+ img + '/' + value['id_user'] + '/larger_' + arrImg[0] + '/>' + price + 
                                                '<p>'+value['name']+'</p>' + 
                                                '<a href="#" class="btn btn-default add-to-cart">'+
                                                    '<i class="fa fa-shopping-cart"></i>Add to cart' +
                                                '</a>'+
                                            '</div>'+
                                        '<div class="product-overlay">'+
                                            '<div class="overlay-content">'+ 
                                                price + '<p>'+value['name']+'</p>' + 
                                                '<a href="#" class="btn btn-default add-to-cart">'+
                                                '<i class="fa fa-shopping-cart"></i>Add to cart</a>'+
                                            '</div>'+
                                        '</div>'+
        '<img class="new" src="{{ $value['status']==0 ? URL::to("upload/icon/new.png") : URL::to("upload/icon/sale.png") }}">'+
                                        '</div>' + 
                                    '<div class="choose">'+
                                        '<ul class="nav nav-pills nav-justified">'+
                                            '<li>'+
                                                '<a href="{{ url('/detail-product') }}'+'/'+value['id']+'">'+
                                                '<i class="fa fa-plus-square"></i>Product detail</a></li>'+
                                            '<li>'+
                                                '<a href="#">'+
                                                '<i class="fa fa-plus-square"></i>Add to compare</a>'+
                                            '</li>'+
                                        '</ul>' +
                                    '</div>'+
                                '</div>'+
                            '</div>';
                    }) 
                        $('.home').hide();
                        $('.features_items').html(html);
                        $('div.overlay-content').find('span').addClass('overlay');
                } else {
                    $('.home').hide();
                    $('.features_items').text("Can't find any product in this price range.");
                }
                
                        
                  

               }
            });
        });
    });
</script>