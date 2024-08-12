@extends('frontend.layouts.app')

@section('content')
 
	<div class="container-fluid">
        <div class="product-details"><!--product-details-->
            
                <div class="product-information" style="padding-left: 0;"><!--/product-information-->
                    <div class="contact-form">
                        <h2 class="title text-center">Product Information</h2>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session('AtLeast') || Session('TooMuch') || Session('enterSale'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session('AtLeast') }}</strong>
                                    <strong>{{ Session('TooMuch') }}</strong>
                                    <strong>{{ Session('enterSale') }}</strong>
                            </div>
                        @endif
                        @if (Session('updated'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session('updated') }}</strong>
                            </div>
                        @endif
                        <form id="main-contact-form" class="contact-form row" name="contact-form" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="col-md-2">
                                <label>Name</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" name="name" value="{{ $getProduct['name'] }}">
                            </div>
                            <div class="col-md-2">
                                <label>Web_Id</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" name="web_id" value="{{ $getProduct['web_id'] }}">
                            </div>
                            <div class="col-md-2">
                                <label>Price</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" id="display" value="{{ number_format($getProduct['price']) }}">
                                <input hidden="" id="price" name="price" value="{{ $getProduct['price'] }}">
                            </div>
                            <div class="form-group col-md-3">
                            Status of product
                                </div>
                                <div class="form-group col-md-9">
                                    <div class="form-group col-md-12">
                                        <input type="radio" id="new" name="status" value="0" <?= ($getProduct["status"] == 0) ?  'checked'  : 
                                        '' ?> > New
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="radio" id="sale" name="status" value="1" <?= ($getProduct["status"] == 1) ?  'checked'  : 
                                        '' ?> > Sale
                                        <input type="text" id="value_sale" name="sale"   disabled="" value="{{ $getProduct['sale'] }}">%
                                    </div>
                                </div>
                            <div class="col-md-2">
                                <label>Condition</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" name="condition" value="{{ $getProduct['condition'] }}">
                            </div>
                            <div class="col-md-2">
                                <label>Category</label>
                            </div>
                            <div class="form-group col-md-10">
                                <select name="category" class="form-control form-control-line">
                                    <option value="">Please select</option>
                                    @foreach($Category as $key => $value)
                                    <option
                                        <?php if($value['id'] == $getProduct['id_category']) echo "selected"?>     value="{{ $key + 1 }}"
                                    >
                                        {{ $value['category'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Brand</label>
                            </div>
                            <div class="form-group col-md-10">
                                <select name="brand" class="form-control form-control-line">
                                    <option value="">Please select</option>
                                    @foreach($Brand as $key => $value)
                                    <option
                                        <?php if($value['id'] == $getProduct['id_brand']) echo "selected"?>     value="{{ $key + 1 }}"
                                    >
                                        {{ $value['brand'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="file" name="image[]" class="form-control" multiple>
                            </div>
                            <div class="col-sm-12">
                                <div class="view-product"> 
                                    <h4>Choose image you want to delete</h4>
                                    @foreach($getArrImage as $value)
                                        <div class="" style="position: relative; display: inline-block;">
                                            <img class="imageProduct" style="width: 100px ; height: 100px;" src="{{ URL::to('upload/product/'.Auth::user()->id.'/'.$value) }}" alt="">
                                            
                                            
                                            <input type="checkbox" name="image_delete[]" style="position: absolute; top: 3px; right: 3px;" value="{{ $value }}">
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group col-md-10">
                                <button style="margin-left: 0; margin-top: 50px;" type="submit" class="btn btn-default cart">Update your product</button>
                                <a class="btn btn-default" style="color: #fff; background: #989898; display: inline-block; margin: 50px 0 10px 0; border: 0 none; font-size: 15px; border-radius: 0" href="{{ url('/product/'.Auth::user()->id.'/list') }}">Cancel</a>
                            </div>
                        </form>
                        
                    </div>
                </div><!--/product-information--> 
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        document.getElementById("display").onblur =function (){    
            this.value = parseFloat(this.value.replace(/,/g, ""))
                            .toFixed()
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            
            document.getElementById("price").value = this.value.replace(/,/g, "")
            
        }
        $('#sale').click(function()
        {
          $('#value_sale').removeAttr("disabled");
        });

        $('#new').click(function()
        {
          $('#value_sale').attr("disabled","disabled");
          $('#value_sale').attr("value","");
        });
        $(window).on('load', function() {
            if ($('#sale').is(':checked')) {
                $('#value_sale').removeAttr("disabled");
            };
        });
        
    </script>
@endsection