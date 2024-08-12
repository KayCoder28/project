@extends('admin.layouts.app')

@section('content')
	<!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
	<div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('admin.listProduct') }}</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.listProduct') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        @if (Session('deleted'))

            <div class="alert alert-success alert-block">

                <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ Session('deleted') }}</strong>

            </div>

        @endif
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Id User</th>
                                            <th scope="col">Active</th>
                                            <th scope="col">Action</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getAllProduct as $key => $value)
                                        <tr>
                                            <th scope="row">{{$key + 1}}</th>
                                            <td>{{$value['name']}}</td>
                                            <td>{{$value['id_user']}}</td>
                                            <td>{{$value['active'] == 1 ? 'Actived' : 'No active'}}</td>
                                            <td>
                                                <a class="sidebar-link  waves-dark sidebar-link" href="{{ url('/admin/product/view/'.$value['id']) }}" aria-expanded="false">
                                                    <i class="mdi mdi-eye">View</i>
                                                </a>
                                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/product/delete/'.$value['id']) }}" aria-expanded="false">
                                                    <i class="mdi mdi-delete">Delete</i>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                               
                                <div style="float: right; margin-right: 10px;">
                                    {{ $getAllProduct->links() }}

                            </div>
                             

                            </div>
                        </div>
            </div>
        </div>
    </div>
     <!-- end Container fluid  -->
@endsection