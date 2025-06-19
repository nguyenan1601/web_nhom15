<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .auth-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: none;
        }
        .auth-card .card-header {
            background-color: transparent;
            border-bottom: none;
            padding: 1.5rem 1.5rem 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center py-5">
            <div class="col-md-6 col-lg-5">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
