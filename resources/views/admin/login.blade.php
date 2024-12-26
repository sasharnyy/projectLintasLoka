<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            width: 100%;
            max-width: 800px;
            overflow: hidden;
        }

        .logo-section {
            background-color: #8a9d91;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 50%;
        }

        .logo-section img {
            width: 150px;
            height: auto;
        }

        .logo-section h2 {
            margin-top: 20px;
            font-size: 30px;
            color: #2d3b34;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            width: 50%;
        }

        .form-section h2 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #333;
        }

        .form-section form {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
        }

        .form-section label {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }

        .form-section input {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
        }

        .form-section button {
            background-color: #2d4a2f;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            width: auto;
            align-self: flex-start;
        }

        .form-section button:hover {
            background-color: #1e331f;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
            }

            .logo-section {
                width: 100%;
                height: 50%;
            }

            .form-section {
                width: 100%;
                height: 50%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-section">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h2>Admin Panel</h2>
        </div>
        <div class="form-section">
            <h2>Admin Login</h2>
            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
                
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
                
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>
