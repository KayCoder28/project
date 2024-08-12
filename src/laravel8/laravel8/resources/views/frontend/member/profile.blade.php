@extends('frontend.layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register Member') }}</div>

                <div class="card-body">
                    @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                        @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br>
                    <form method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Full Name (*)') }}</label>

                            <div class="col-md-8">
                                <input 
                                    id="name" 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    name="name" 
                                    value="{{ $getUser['name'] }}" 
                                    autocomplete="name" 
                                    autofocus
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email (*)') }}</label>

                            <div class="col-md-8">
                                <input 
                                readonly 
                                    id="name" 
                                    type="text" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    name="email" 
                                    value="{{ $getUser['email'] }}" 
                                    autocomplete="email" 
                                    autofocus
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Password (*)') }}</label>

                            <div class="col-md-8">
                                <input 
                                    id="name" 
                                    type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" 
                                    value="{{ old('password') }}" 
                                    autocomplete="password" 
                                    autofocus
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-8">
                                <input 
                                    id="phone" 
                                    type="text" 
                                    class="form-control @error('phone') is-invalid @enderror" 
                                    name="phone" 
                                    value="{{ $getUser['phone'] }}" 
                                    autocomplete="phone" 
                                    autofocus
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-8">
                                <input 
                                    id="address" 
                                    type="text" 
                                    class="form-control @error('address') is-invalid @enderror" 
                                    name="address" 
                                    value="{{ $getUser['address'] }}" 
                                    autocomplete="address" 
                                    autofocus
                                >
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Avatar (*)') }}</label>

                            <div class="col-md-8">
                                <input 
                                    id="avatar" 
                                    type="file" 
                                    class="form-control @error('avatar') is-invalid @enderror" 
                                    name="avatar"    
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Country (*)') }}</label>

                            <div class="col-md-8">
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


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
