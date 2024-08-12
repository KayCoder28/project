@extends('admin.layouts.app')

@section('content')


<!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{ __('admin.listBrand') }}</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.listBrand') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if (Session('success'))

            <div class="alert alert-success alert-block">

                <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ Session('success') }}</strong>

            </div>

        @endif
        <form method="POST">
            @csrf

            <div class="form-group row">
                <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('Brand') }}</label>

                <div class="col-md-6">
                    <input id="country" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" autofocus>

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
                        {{ __('Add brand') }}
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
                                    <th scope="col">Brand</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getAllBrand as $key => $value)
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>{{$value['brand']}}</td>
                                    <td>
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/delete-brand/'.$value['id']) }}" aria-expanded="false">
                                            <i class="mdi mdi-delete">Delete</i>
                                        </a>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
