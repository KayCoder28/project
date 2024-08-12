@extends('frontend.layouts.app')

@section('content')
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
            	<h3>Your Product</h3>
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Create at</th>
                                    <th scope="col">Action</th>
                                 </tr>
                            </thead>
                            <tbody>
                                @foreach($getAllProduct as $key => $value)
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>{{ $value['name'] }}</td>
                                    <td>{{ number_format($value['price']) }}</td>
                                    <td>{{ $value['active'] == 1 ? 'Actived' : 'No active' }}</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($value['created_at'])) }}</td>
                                    <td>
                                        <a class="sidebar-link  waves-dark sidebar-link" href="{{ url('/product/view/'.$value['id']) }}" aria-expanded="false">
                                            <i class="mdi mdi-eye">View</i>
                                        </a>
                                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/product/delete/'.$value['id']) }}" aria-expanded="false">
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
     <!-- end Container fluid  -->
@endsection