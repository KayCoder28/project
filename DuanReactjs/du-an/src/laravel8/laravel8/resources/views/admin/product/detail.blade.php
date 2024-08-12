@extends('admin.layouts.app')
 
@section('content')
 

<!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('admin.detailProduct') }}</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.detailProduct') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-12">
                <div class="view-product"> 
                    @foreach($getArrImage as $value)
                        <a href=""><img style="width: 100px ; height: 100px" src="{{ URL::to('upload/product/'.$getProduct['id_user'].'/'.$value) }}" alt=""></a>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12">
                <div class="product-information"><!--/product-information-->
                    <div class="contact-form">
                        <h2 class="title text-center">Product Information</h2>
                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                            <div class="col-md-2">
                                <label>Name</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" readonly="" value="{{ $getProduct['name'] }}">
                            </div>
                            <div class="col-md-2">
                                <label>Web_Id</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" readonly="" value="{{ $getProduct['web_id'] }}">
                            </div>
                            <div class="col-md-2">
                                <label>Price</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" readonly="" value="{{ number_format($getProduct['price']) }}">
                            </div>
                            <div class="col-md-2">
                                <label>Condition</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" readonly="" value="{{ $getProduct['condition'] }}">
                            </div>
                            <div class="col-md-2">
                                <label>Category</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" readonly="" value="{{ $Category['category'] }}">
                            </div>
                            <div class="col-md-2">
                                <label>Brand</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" readonly="" value="{{ $Brand['brand'] }}">
                            </div>
                        </form>
                        <form method="POST">
                            @csrf
                            @if($getProduct['active'] == 0)
                                <button style="margin-left: 0" type="submit" class="btn btn-fefault cart">
                                    <i class="mdi mdi-check"></i>
                                    Active this product
                                </button>
                            @else
                                <button style="margin-left: 0" type="submit" class="btn btn-fefault cart" disabled="">
                                    <i class="mdi mdi-check"></i>
                                    This Product is already active
                                </button>
                            @endif
                        </form>
                    </div>
                </div><!--/product-information-->
            </div>
        </div>
    </div>




    <script src="{{ asset('admin/dist/js/jquery.js') }}"></script>
    <script src="{{ asset('admin/dist/js/price-range.js') }}"></script>
    <script src="{{ asset('admin/dist/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('admin/dist/js/main.js') }}"></script>
@endsection
