<!DOCTYPE html>
<html lang="pt-br" manifest="offline.manifest">
<head>
    <link rel="manifest" href="app.manifest">
    <meta charset="utf-8">
    <meta name="theme-color" content="#43A047">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SisFin</title>

    <!-- Styles -->
    <link href="{{ asset('css/spa.css') }}" rel="stylesheet">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <app> </app>	
    <!-- Scripts -->
    <script src="{{ asset('build/spa.bundle.js') }}"></script>
</body>
</html>
