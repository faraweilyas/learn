<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ pc_asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ pc_asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <section class="px-8 mb-6">
            <header class="container mx-auto flex justify-center">
                <h1>
                    <a href="/">
                        <img
                            style="width: 200px;"
                            src="/images/tweety.png"
                            alt="Tweety"
                        />
                    </a>
                </h1>
            </header>
        </section>
        {{ $slot }}
    </div>
    <script type="text/javascript" src="http://unpkg.com/turbolinks"></script>
</body>
</html>
