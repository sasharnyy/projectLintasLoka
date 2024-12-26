<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: row;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 800px;
            max-width: 90%;
            overflow: hidden;
        }

        .logo-section {
            background-color: #8a9d91;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 50%;
            padding: 20px;
        }

        .logo-section img {
            width: 150px;
            height: auto;
        }

        .logo-section h2 {
            margin-top: 15px;
            font-size: 28px;
            color: #2d3b34;
            text-align: center;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            width: 50%;
        }

        .form-section h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        .form-section p {
            margin-bottom: 15px;
            color: #666;
            font-size: 14px;
        }

        .form-section p a {
            color: #004d40;
            text-decoration: none;
            font-weight: bold;
        }

        .form-section form {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 300px;
        }

        .form-section label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        .form-section input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 100%;
        }

        .form-section button {
            background-color: #004d40;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            width: 30%;
            align-self: flex-start;
        }

        .form-section button:hover {
            background-color: #00332c;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .logo-section, .form-section {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-section">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h2>LINTASLOKA</h2>
        </div>
        <div class="form-section">
            <h2>Get Started</h2>
            <p>Already Registered? <a href="{{ route('user.login') }}">Sign In</a></p>
            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('user.register') }}">
                @csrf
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>

                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>

                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</body>
</html>
