@extends('admin.layouts.app')

@section('content')
	
	<div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('Country') }}</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Country') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
       
        	@if (Session('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                        <strong>{{ Session('success') }}</strong>

                </div>

            @endif
            <form method="POST">
            @csrf

            <div class="form-group row">
                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                <div class="col-md-6">
                    <input id="country" type="text" class="form-control @error('category') is-invalid @enderror" name="name" autofocus>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add Country') }}
                    </button>

                </div>
            </div>
        </form>
        <br>
        @if (Session('deleted'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session('deleted') }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($getCountry as $key => $value)
                                        <tr>
                                            <th scope="row">{{$key + 1}}</th>
                                            <td>{{$value['name']}}</td>
                                            <td>
                                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/country/delete/'.$value['id']) }}" aria-expanded="false">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="float: right; margin-right: 10px;">
                                    {{ $getCountry->links() }}

                                </div>
                                

                            </div>
                        </div>
            </div>
        </div>
        
    </div>
@endsection
