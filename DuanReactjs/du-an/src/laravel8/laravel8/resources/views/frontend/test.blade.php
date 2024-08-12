<?php 

   

    foreach ($demo as $key => $value) {
        echo $value;
    }
?>

    

@foreach ($demo as $key => $value)
    <p>{{$value}}</p>
@endforeach
