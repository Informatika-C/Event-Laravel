<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	@if(Auth::guard('admin')->check())
		<div>admin</div>
		<a href="{{route('logout')}}">logout</a>
	@elseif(Auth::check())
		<div>user</div>
		<a href="{{route('logout')}}">logout</a>
	@else
		please login
		<a href="{{route('login')}}">login</a>
	@endif
</body>
</html>