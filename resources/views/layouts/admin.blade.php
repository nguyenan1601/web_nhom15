<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin - Quản Lý Cửa Hàng Điện Thoại')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #64748b;
        --accent-color: #f59e0b;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --dark-color: #1e293b;
        --light-color: #f8fafc;
        --border-color: #e2e8f0;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
        color: #334155;
        background-color: #f8fafc;
    }

    .admin-navbar {
        background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
        box-shadow: 0 2px 10px rgba(37, 99, 235, 0.1);
    }

    .admin-navbar .navbar-brand {
        font-weight: 700;
        color: white !important;
    }

    .admin-navbar .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .admin-navbar .nav-link:hover {
        color: white !important;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
    }

    .admin-sidebar {
        background: white;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        height: calc(100vh - 56px);
        position: sticky;
        top: 56px;
    }

    .admin-sidebar .nav-link {
        color: var(--secondary-color);
        padding: 12px 20px;
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .admin-sidebar .nav-link:hover,
    .admin-sidebar .nav-link.active {
        color: var(--primary-color);
        background-color: rgba(37, 99, 235, 0.1);
        border-left-color: var(--primary-color);
    }

    .admin-content {
        padding: 20px;
    }

    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }

    .card-header {
        background-color: white;
        border-bottom: 1px solid var(--border-color);
        font-weight: 600;
        color: var(--dark-color);
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: var(--dark-color);
        background-color: var(--light-color);
    }

    .badge {
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 6px;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-confirmed {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .status-processing {
        background-color: #e0e7ff;
        color: #5b21b6;
    }

    .status-shipped {
        background-color: #ccfbf1;
        color: #047857;
    }

    .status-delivered {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-completed {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-cancelled {
        background-color: #fee2e2;
        color: #991b1b;
    }

    @media (max-width: 768px) {
        .admin-sidebar {
            position: static;
            height: auto;
        }
    }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Admin Navigation -->
    <nav class="navbar navbar-expand-lg admin-navbar fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.orders.index') }}">
                <i class="fas fa-cog me-2"></i>Admin Panel
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders.index') }}">
                            <i class="fas fa-shopping-cart me-1"></i>Quản Lý Đơn Hàng
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Về Trang Chủ
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-1"></i>Đăng Xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid" style="margin-top: 56px;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0">
                <div class="admin-sidebar">
                    <div class="nav flex-column">
                        <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" 
                           href="{{ route('admin.orders.index') }}">
                            <i class="fas fa-shopping-cart me-2"></i>Đơn Hàng
                        </a>
                        <!-- Có thể thêm các menu khác tại đây -->
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="col-md-10">
                <div class="admin-content">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
