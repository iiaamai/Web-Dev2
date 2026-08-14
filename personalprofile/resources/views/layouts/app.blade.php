<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Profile App')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
            color: #222;
        }

        nav {
            background: #1f2937;
            padding: 16px 24px;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background 0.2s ease;
        }

        nav a:hover {
            background: #374151;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            color: #111827;
        }

        p, li {
            font-size: 1.02rem;
            line-height: 1.7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #e5e7eb;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('profile') }}">Personal Profile</a>
        <a href="{{ route('education') }}">Educational Background</a>
        <a href="{{ route('subjects') }}">List of Subjects</a>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
