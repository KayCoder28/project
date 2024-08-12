@extends('admin.layouts.app')

@section('content')
	<!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
	<div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('admin.listUser') }}</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.listUser') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                    <div class="card">
                    	@if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                             </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <a class="btn btn-success" href="{{ url('/admin/page/add') }}" >
                                Create page
                            </a>
                           
                        </div>
                    </div>
            </div>
        </div>
    </div>
     <!-- end Container fluid  -->
@endsection