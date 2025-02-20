<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
   
</head>
<body>
    <div class="container">
        <header>header</header>
        @yield('content')  
        <footer>Footer</footer>
    </div>
</body>
</html>