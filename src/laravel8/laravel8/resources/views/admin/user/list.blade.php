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
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getAllUser as $key => $value)
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>
                                         <img src="{{ URL::to('/upload/user/avatar/'.$value->avatar) }}" alt="user"  style="width: 20px; height: 20px">
                                         
                                       </td>
                                    <td>{{$value['name']}}</td>
                                    <td>{{$value['email']}}</td>
                                    <td>{{$value['level'] == 1 ? 'admin' : 'member'}}</td>
                                    <td>
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/user/profile/'.$value['id']) }}" aria-expanded="false">
                                            <i class="mdi mdi-account-edit">Edit</i>
                                        </a>
                                        &nbsp &nbsp
                                        <?php if($value['level'] == 0) { ?>
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/delete-member/'.$value['id']) }}" aria-expanded="false">
                                            <i class="mdi mdi-delete">Delete</i>
                                        </a>
                                        <?php } ?>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="float: right; margin-right: 10px;">
                            {{ $getAllUser->links() }}
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- end Container fluid  -->
@endsection