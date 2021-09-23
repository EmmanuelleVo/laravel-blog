<!doctype html>
<html lang="{{config('app.locale')}}">
<head>
    @yield('main_title')
    <link rel="stylesheet" href="/app.css">
</head>

<body>
    @yield('main_content')
    <a href="/">Go back</a>
</body>
</html>
