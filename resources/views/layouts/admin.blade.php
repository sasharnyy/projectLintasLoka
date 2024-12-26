<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - LintasLoka Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, h1, p, ul, li {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #444;
        }

        header {
            background-color: #96A999;
            padding: 10px 20px;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 60px;
            margin-right: 10px;
        }

        .logo span {
            font-size: 24px;
            font-weight: bold;
            color: #2d4a2f;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-right: 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        .auth-buttons {
            display: flex;
            gap: 10px;
        }

        .auth-btn {
            padding: 5px 15px;
            border: none;
            cursor: pointer;
            background-color: #2d4a2f;
            color: #fff;
            border-radius: 5px;
        }

        .auth-btn:hover {
            background-color: #1e331f;
        }

        .tabs {
            display: flex;
            justify-content: flex-start;
            background-color: #ffffff;
            border-bottom: 2px solid #ddd;
        }

        .tab {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background: none;
            font-weight: bold;
            color: #888;
            text-decoration: none;
        }

        .tab.active {
            color: #000;
            border-bottom: 3px solid #2d4a2f;
        }

        .content {
            padding: 20px;
        }

        .dashboard-overview, .users-content, .reports-content, .orders-content, .sales-content, .reviews-content, .admin-list-content {
            background: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dashboard-overview h1, .users-content h1, .reports-content h1, .orders-content h1, .sales-content h1, .reviews-content h1, .admin-list-content h1 {
            margin-bottom: 15px;
            color: #2d4a2f;
        }

        .dashboard-overview p, .users-content p, .reports-content p, .orders-content p, .sales-content p, .reviews-content p, .admin-list-content p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="LintasLoka Logo">
                <span>LINTASLOKA - ADMIN</span>
            </div>
            <div class="auth-buttons">
                @if(Auth::guard('admin')->check())
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="auth-btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('admin.login') }}" class="auth-btn">Login</a>
                @endif
            </div>
        </div>
    </header>

    <main>
        <div class="tabs">
            <a href="{{ route('admin.dashboard') }}" class="tab {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.orders') }}" class="tab {{ request()->routeIs('admin.orders') ? 'active' : '' }}">Orders</a>
            <a href="{{ route('admin.sales') }}" class="tab {{ request()->routeIs('admin.sales') ? 'active' : '' }}">Sales</a>
            <a href="{{ route('admin.reviews') }}" class="tab {{ request()->routeIs('admin.reviews') ? 'active' : '' }}">Reviews</a>
            <a href="{{ route('admin.adminList') }}" class="tab {{ request()->routeIs('admin.adminList') ? 'active' : '' }}">Admin List</a>
        </div>

        <section class="content">
            @yield('content') 
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
