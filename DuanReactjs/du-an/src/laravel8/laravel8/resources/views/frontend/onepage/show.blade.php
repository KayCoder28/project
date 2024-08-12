@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    {{ $getPage[0]['content'] }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
