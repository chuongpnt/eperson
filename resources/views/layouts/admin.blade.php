<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.admin.head')
</head>


<body class="hold-transition skin-blue sidebar-mini">

<div id="app">
    <div id="wrapper">

    @include('partials.admin.topbar')
    @include('partials.admin.sidebar')

    <event-hub></event-hub>
    <router-view></router-view>

    </div>
</div>

{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}

@include('partials.admin.javascripts')
</body>
</html>
