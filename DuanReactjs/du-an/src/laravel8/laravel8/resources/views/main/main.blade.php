<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!-- goi css va js -->
</head>
<body>

	@include("main.header")

    <!-- noi dung thay doi trang -->
	@yield("content")
    
    @include("main.footer")

</body>
</html>