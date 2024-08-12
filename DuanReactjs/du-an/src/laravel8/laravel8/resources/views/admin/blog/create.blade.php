@extends('admin.layouts.app')

@section('content')
 <!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title"><?php if(!empty($getBlog)) {
                                                    echo 'Edit Blog';
                                        }else{ echo 'Create Blog';}?></h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?php if(!empty($getBlog)) {
                                                    echo 'Edit Blog';
                                        }else{ echo 'Create Blog';}?></li>
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
        <!-- Row -->
        <div class="row">
           
            <!-- Column -->

            <div class="col-lg-12 col-xlg-12 col-md-12">
                <div class="card">

                    <div class="row">
                        <div class="col-lg-7 col-xlg-7 col-md-12">
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
                                        <label class="col-md-12">Title <span style="color: red">(*)</span></label>
                                        <div class="col-md-12">
                                            <input  type="text" placeholder="" class="form-control form-control-line" name="title" id="title" 
                                                <?php if(!empty($getBlog)) {?> 
                                                    value="{{ $getBlog['title'] }}" 
                                                <?php }?> 
                                            >
                                        </div>
                                    </div>
                                    <!--  -->
				                    <div class="form-group">
				                        <label class="col-sm-12">Image</label>
				                        <div class="col-sm-12">
				                           <input type="file" name="image" id="image"  >
                                          
				                        </div>
				                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Description</label>
                                        <div class="col-md-12">
                                            <textarea rows="3" id="description" name="description" class="form-control form-control-line"><?php if(!empty($getBlog)) {
                                                    echo $getBlog['description'];
                                                }?></textarea>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <label class="col-md-12">Content</label>
                                        <div class="col-md-12">
                                            <textarea rows="15" id="content" name="content" class="form-control form-control-line">
                                                <?php if(!empty($getBlog)) {
                                                    echo $getBlog['content'];
                                                }?></textarea>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Create Blog</button>
                                        </div>
                                    </div>
                                    <!--  -->
                                </form>
                            </div>
                        </div>
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



    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('content', {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html')}}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images')}}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash')}}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')}}'
        } );
     </script>


@endsection