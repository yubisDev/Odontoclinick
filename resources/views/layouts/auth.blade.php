<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Odontoclinick')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #D3D3D3;
        }
        .auth-card {
            background-color: #ffffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="w-100" style="max-width: 400px;">
        <div class="auth-card">
            @yield('content')
        </div>
    </div>
</body>
</html>
