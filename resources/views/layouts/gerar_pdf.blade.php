<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token --><!-- Scripts --><!-- Fonts -->
    <!-- Styles -->
    <link href="{{ public_path('/css/pdf.css') }}" rel="stylesheet">
    <link href="{{ public_path('/css/bootstrap.min.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <main class="col-12">
            <div class="col-12 row">
            @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
