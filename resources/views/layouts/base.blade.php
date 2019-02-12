<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    @include('partials.head')
</head>


<body class="hold-transition skin-blue sidebar-mini">

<div id="wrapper" class="home-pg">

	@include('partials.header')
	
	@yield('content')
	
	@include('partials.footer')
</div>

@include('partials.javascripts')
@yield('extra_js')
</body>
</html>
