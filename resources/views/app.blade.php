<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Highlands Coffee')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <style>
        body {
            background-color: #f8f5f0;
            font-family: "Segoe UI", sans-serif;
        }

        /* HEADER */
        .hl-header {
            background-color: #7b3f00; /* Nâu Highlands */
            padding: 12px 0;
            color: white;
        }

        .hl-header .logo img {
            height: 55px;
        }

        .hl-header a {
            color: white !important;
            font-weight: 500;
            font-size: 17px;
            margin: 0 12px;
        }

        .hl-header a:hover {
            text-decoration: underline;
        }

        /* Setup khoảng cách cho nội dung */
        .content-area {
            margin-top: 30px;
        }

        /* Card Highlands */
        .hl-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <header class="hl-header shadow-sm">
        <div class="container d-flex align-items-center justify-content-between">

            {{-- LOGO --}}
            <div class="logo d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Highlands Logo" style="border-radius:50%;">
            </div>

            {{-- MENU --}}
            <nav>
                <a>Trang chủ</a>
                <a>Menu</a>
                <a">Cửa hàng</a>
                <a>Liên hệ</a>
                <a>Dashboard</a>
            </nav>

        </div>
    </header>

    {{-- CONTENT --}}
    <div class="container content-area">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
