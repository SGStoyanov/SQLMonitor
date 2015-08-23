<!DOCTYPE html>
<html lang="en">
<head>
    <title>SQL Monitor</title>
    <script type="text/javascript" src="libs/jquery/jquery.js"></script>
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap-theme.css">
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.js"></script>

    {{-- Datepicker components --}}
    <script type="text/javascript" src="libs/bower_components/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="libs/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="libs/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
</head>
<body>
    <div class="container">
        <div class="content">
            @yield('content')
            {{--<div class="title">Laravel 5</div>--}}
        </div>
    </div>
    @yield('footer')
</body>
</html>
