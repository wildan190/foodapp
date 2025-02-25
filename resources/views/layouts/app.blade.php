<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        /* Sidebar (Desktop) */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #fff;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding-top: 20px;
        }

        .sidebar h4 {
            font-weight: bold;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }

        .sidebar a {
            color: #333;
            padding: 12px 15px;
            display: block;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar .active {
            background: #007bff;
            color: white;
            border-radius: 5px;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 1030;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        /* Konten Utama */
        .main-content {
            margin-left: 250px;
            margin-top: 56px;
            padding: 20px;
        }

        @media (max-width: 767px) {
            .navbar {
                left: 0;
                padding: 10px;
            }

            .main-content {
                margin-left: 0;
                margin-top: 56px;
            }

            .sidebar {
                display: none;
            }
        }

        /* Bottom Navigation (Mobile) */
        .bottom-nav {
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .bottom-nav a {
            color: #333;
            text-decoration: none;
            text-align: center;
            padding: 10px 0;
            flex: 1;
            font-size: 14px;
        }

        .bottom-nav a:hover {
            color: #007bff;
        }

        /* Mobile Sidebar Menu */
        .mobile-menu {
            position: fixed;
            top: 56px;
            left: 0;
            width: 100%;
            background: white;
            z-index: 1050;
            display: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .mobile-menu.show {
            display: block;
        }
    </style>
</head>

<body>

    <!-- Sidebar (Desktop Only) -->
    <div class="d-none d-md-block sidebar">
        <h4>Menu</h4>
        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('customers.index') }}" class="nav-link {{ Request::is('customers*') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Customer
            </a>
            <a href="{{ route('suppliers.index') }}" class="nav-link {{ Request::is('suppliers*') ? 'active' : '' }}">
                <i class="fas fa-truck"></i> Supplier
            </a>
            <a href="{{ route('menus.index') }}" class="nav-link {{ Request::is('menus*') ? 'active' : '' }}">
                <i class="fas fa-utensils"></i> Menu
            </a>
            <a href="{{ route('sales.index') }}" class="nav-link {{ Request::is('sales*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i> Sales
            </a>
            <a href="{{ route('transactions.index') }}" class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}">
                <i class="fas fa-money-bill"></i> Transaction
            </a>
        </nav>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">POS System</a>

            <!-- Hamburger Menu Button -->
            <button class="navbar-toggler d-md-none" type="button" id="mobileMenuButton">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Desktop User Dropdown -->
            <div class="collapse navbar-collapse justify-content-end d-none d-md-block">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Sidebar Menu -->
    <div class="mobile-menu p-3" id="mobileMenu">
        <nav class="nav flex-column">
            <a href="#" class="nav-link"><i class="fas fa-user"></i> Profile</a>
            <a href="#" class="nav-link"><i class="fas fa-cog"></i> Settings</a>
            <a href="#" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </div>

    <!-- Konten Utama -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bottom Navigation (Mobile) -->
    <nav class="d-md-none fixed-bottom bg-white bottom-nav d-flex justify-content-around py-2">
        <a href="{{ route('dashboard') }}" class="text-dark"><i class="fas fa-tachometer-alt"></i><br><small>Dashboard</small></a>
        <a href="{{ route('customers.index') }}" class="text-dark"><i class="fas fa-user"></i><br><small>Customer</small></a>
        <a href="{{ route('sales.index') }}" class="text-dark"><i class="fas fa-shopping-cart"></i><br><small>Sales</small></a>
    </nav>

    <!-- Bootstrap & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $('#mobileMenuButton').click(function() {
            $('#mobileMenu').toggleClass('show');
        });
    </script>

</body>

</html>
