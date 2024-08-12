@extends('admin.layouts.app')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('admin.profile') }}</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.profile') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
     <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                        <img src="{{ URL::to('/upload/user/avatar/'.Auth::user()->avatar) }}" alt="user" class="rounded-circle" width="150">

                            <h4 class="card-title m-t-10">{{ $getUser['name'] }}</h4>
                            <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                            <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                            </div>
                        </center>
                    </div>
                    <div>
                        <hr> </div>
                   
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                        @endif
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
                        <form class="form-horizontal form-material" enctype="multipart/form-data" method="POST">
                            @csrf
                            <!--  -->
                            <div class="form-group">
                                <label class="col-md-12">Full Name <span style="color: red">(*)</span></label>
                                <div class="col-md-12">
                                    <input value="{{ $getUser['name'] }}" type="text" placeholder="Full Name" class="form-control form-control-line" name="name" id="name">
                                </div>
                            </div>
                            <!--  -->
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input readonly value="{{ $getUser['email'] }}" type="email" placeholder="Email" class="form-control form-control-line" name="email" id="email">
                                </div>
                            </div>
                            <!--  -->
                            <div class="form-group">
                                <label class="col-md-12">Password New</label>
                                <div class="col-md-12">
                                    <input type="password" value="" class="form-control form-control-line" name="password" id="password">
                                </div>
                            </div>
                            <!--  -->
                            <div class="form-group">
                                <label class="col-md-12">Password New Confirm</label>
                                <div class="col-md-12">
                                    <input type="password" value="" class="form-control form-control-line" name="password-c" id="password-c">
                                </div>
                            </div>
                            <!--  -->
                            <div class="form-group">
                                <label class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input value="{{ $getUser['phone'] }}" type="text" placeholder="Phone" class="form-control form-control-line" name="phone" id="phone">
                                </div>
                            </div>
                            <!--  -->
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <input value="{{ $getUser['address'] }}" type="text" placeholder="Address" class="form-control form-control-line" name="address" id="address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Avatar</label>
                                <div class="col-md-12">
                                    <input type="file" class="form-control form-control-line" name="avatar" id="avatar">
                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-12">Select Country</label>
                                <div class="col-sm-12">
                                    <select name="country" class="form-control form-control-line">
                                        <option value="">Please select</option>


                                        @foreach($getCountry as $key => $value)
                                        <option
                                            <?php if(!empty($getUser['country']) && $value['id'] == $getUser['country']) echo "selected"?>     value="{{ $value['id'] }}"
                                        >
                                            {{ $value['name'] }}
                                        </option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>
                            <!--  -->
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Update Profile</button>
                                </div>
                            </div>
                            <!--  -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection