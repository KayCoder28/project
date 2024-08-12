@extends('frontend.layouts.app')

@section('content')
<form >
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Name" required="">
    </div>

    <div class="form-group">
        <button class="btn btn-success btn-submit">Submit</button>
    </div>
</form>

<script type="text/javascript">
	$.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-submit").click(function(e){
        e.preventDefault();
        var name = $("input[name=name]").val();
        $.ajax({
           type:'POST',
           url:'/blog/ajaxRequest',
           data:{name:name},
           success:function(data){
              console.log(data.success);
           }
        });
	});
</script>
@endsection