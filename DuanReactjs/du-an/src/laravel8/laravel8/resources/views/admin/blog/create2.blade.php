@extends('admin.layouts.app')

@section('content')
 <!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

<!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
       
           
            <!-- Column -->

            
                                <form class="form-horizontal form-material" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <!--  -->
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Content</label>
                                        <div class="col-md-12">
                                            <textarea rows="15" id="content2" name="content" class="form-control form-control-line">
                                                </textarea>
                                        </div>
                                    </div>
                                    
                                    
                                </form>
                            
        
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->



    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'content2', {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        } );
     </script>


@endsection