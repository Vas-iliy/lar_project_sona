<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sona | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/style.css" type="text/css">
    <link rel="stylesheet" href="{{asset(env('THEME'))}}/css/site.css" type="text/css">
</head>

<body>

@yield('navigations')

@if(isset($errors))
    <div style="background-color:red; text-align: center;" >
        <ul>
            @foreach($errors->all() as $error)
                <li style="list-style-type: none"><h3>{{$error}}</h3></li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('status'))
    <div class="box success-box">
        {{session('status')}}
    </div>
@endif

@yield('content')


<!-- Footer Section Begin -->
@yield('footer')
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="{{asset(env('THEME'))}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset(env('THEME'))}}/js/bootstrap.min.js"></script>
<script src="{{asset(env('THEME'))}}/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset(env('THEME'))}}/js/jquery.nice-select.min.js"></script>
<script src="{{asset(env('THEME'))}}/js/jquery-ui.min.js"></script>
<script src="{{asset(env('THEME'))}}/js/jquery.slicknav.js"></script>
<script src="{{asset(env('THEME'))}}/js/owl.carousel.min.js"></script>
<script src="{{asset(env('THEME'))}}/js/main.js"></script>
</body>

</html>
