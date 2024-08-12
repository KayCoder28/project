@extends('frontend.layouts.app')

@section('content')

        <div class="col-md-8">
            <div class="card">
                

                <div class="card-header"><h3>Add Product</h3></div>
                <br>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                
                @if (Session('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ Session('success') }}</strong>
                    </div>
                @endif
                @if (Session('error_file') || Session('enterSale'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ Session('error_file') }}</strong>
                            <strong>{{ Session('enterSale') }}</strong>
                    </div>
                @endif

                <div class="card-body">
                    <form id="main-contact-form" class="contact-form row" name="contact-form" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group col-md-12">
                            <select name="id_category">
                                <option value="">Please select category</option>
                                @foreach($getCategory as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['category'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <select name="id_brand">
                                <option value="">Please select brand</option>
                                @foreach($getBrand as $brand)
                                    <option value="{{ $brand['id'] }}">{{ $brand['brand'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ !empty(old('name')) ? old('name') : '' }}">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="file" name="image[]" class="form-control" multiple>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="web_id" class="form-control" placeholder="Web_id" value="{{ !empty(old('web_id')) ? old('web_id') : '' }}">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" id="display" value="{{ !empty(old('price')) ? old('price') : '' }}" placeholder="Price">
                            <input type="number" hidden="" id="price" name="price" value="">
                        </div>
                        <div class="form-group col-md-3">
                            Status of product
                        </div>
                        <div class="form-group col-md-9">
                            <div class="form-group col-md-12">
                                <input type="radio" id="new" name="status" value="0" checked=""> New
                            </div>
                            <div class="form-group col-md-12">
                                <input type="radio" id="sale" name="status" value="1"> Sale
                                <input type="text" id="value_sale" name="sale" value="" disabled="">%
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <input name="condition" id="condition" class="form-control" placeholder="Condition" value="{{ !empty(old('condition')) ? old('condition') : '' }}"></input>
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="detail" id="detail" class="form-control" placeholder="Detail"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="company_profile" id="company_profile" class="form-control" placeholder="Company_profile"></textarea>
                        </div>                                                 
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                        </div>
                    </form>
                </div>
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
            });
            
        </script>
@endsection
