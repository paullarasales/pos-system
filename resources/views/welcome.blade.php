<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #333333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            animation: fadeInDown 1s ease-in-out;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: #555555;
            animation: fadeIn 1.5s ease-in-out;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
            animation: fadeIn 2s ease-in-out;
        }

        .button {
            background-color: #FF2D20;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        footer {
            margin-top: 40px;
            font-size: 0.9rem;
            color: #888888;
            animation: fadeIn 2.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <h1>Welcome to the POS System</h1>
    <p>Your reliable solution for managing sales and inventory.</p>
    <div class="button-container">
        <a href="{{ url('/login') }}" class="button">Login</a>
        <a href="{{ url('/inventory') }}" class="button">Go to Dashboard</a>
        <a href="{{ url('/employee/login') }}" class="button">Employee Login</a>
    </div>
    <footer>
        &copy; {{ date('Y') }} 2421cafebistro. All rights reserved.
    </footer>
</body>

</html>
