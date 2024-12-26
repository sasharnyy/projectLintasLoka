<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard') - LintasLoka Travel</title>
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

        nav {
            margin-left: auto; 
        }

        nav ul {
            display: flex;
            list-style: none;
            margin-right: 5px;
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

        .auth-btn1 {
            padding: 5px 15px;
            border: none;
            cursor: pointer;
            background-color: #DF8E0D;
            color: #fff;
            border-radius: 5px;
        }

        .auth-btn:hover {
            background-color: #1e331f;
        }

        .auth-btn1:hover {
            background-color: #b7760e;
        }

        .auth-buttons a {
            text-decoration: none; 
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
        }

        .tab.active {
            color: #000;
            border-bottom: 3px solid #2d4a2f;
        }

        .content {
            padding: 0;
            background: #f4f4f4;
        }

        .image-content {
            position: relative;
            text-align: center;
        }

        .image-content img {
            width: 100%;
            height: auto;
            display: block;
        }

        .text-overlay {
            position: absolute;
            top: 10%;
            left: 5%;
            right: 44%;
            color: #fff;
            padding: 20px;
            border-radius: 9px;
            text-align: justify;
        }

        .text-overlay h1 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .text-overlay p {
            font-size: 20px;
            line-height: 1.8;
        }

        @media (max-width: 768px) {
            .text-overlay {
                top: 20%;
                left: 5%;
                right: 5%;
                padding: 15px;
            }

            .text-overlay h1 {
                font-size: 20px;
            }

            .text-overlay p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="LintasLoka Logo">
                <span>LINTASLOKA TRAVEL</span>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Cek Tiket</a></li>
                    <li><a href="#">Outlet Kami</a></li>
                    <li><a href="#">Layanan Pelanggan</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                @if(Auth::check())
                    <form action="{{ route('user.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="auth-btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('user.register') }}" class="auth-btn">Daftar</a>
                    <a href="{{ route('user.login') }}" class="auth-btn1">Masuk</a>
                @endif
            </div>
        </div>
    </header>

    <main>
        <section class="content">
            @yield('content')  
        </section>
    </main>
    @yield('scripts')
</body>
</html>
