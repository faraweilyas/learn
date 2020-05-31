<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link href="{{ pc_asset('/assets/css/default.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ pc_asset('/assets/css/fonts.css') }}" rel="stylesheet" type="text/css" media="all" />
    @yield('head')
    <style type="text/css" media="screen">
        .hide {display: none;}
        .float_left {float: left;}
        .float_right {float: right;}
        .clear {clear: both;}
    </style>
</head>
<body>
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="/">{{ env('APP_NAME') }}</a></h1>
        </div>
        <div id="menu">
            <ul>
                <li{!! activateLink('/') !!}><a href="/" accesskey="1">Homepage</a></li>
                <li{!! activateLink('about') !!}><a href="/about" accesskey="2">About Us</a></li>
                <li{!! activateLink('articles') !!}><a href="/articles" accesskey="3">Articles</a></li>
                <li{!! activateLink('articles/create') !!}><a href="/articles/create" accesskey="4">New Article</a></li>
                <li{!! activateLink('contact') !!}><a href="/contact" accesskey="5">Contact Us</a></li>
            </ul>
        </div>
    </div>
    @yield('header')
</div>
@yield('content')
<div id="copyright" class="container">
    <p>&copy; {{ date('Y')." ".env('APP_NAME') }}. All rights reserved.</p>
</div>
</body>
</html>
