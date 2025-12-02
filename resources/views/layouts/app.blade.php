<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Highlands Coffee')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Custom CSS --}}
    <style>
        body {
            background-color: #f8f5f0;
            font-family: "Segoe UI", sans-serif;
        }

        /* HEADER */
        .hl-header {
            background-color: #b22830; /* đỏ dâu Highlands */
            padding: 12px 0;
            color: white;
        }

        .hl-header .logo img {
            height: 55px;
            border-radius: 50%;
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

        /* Footer */
        footer a:hover {
            color: #b22830 !important;
        }
        footer i:hover {
            color: #b22830;
        }
    </style>

    @yield('style')
</head>

<body>

    {{-- HEADER --}}
    <header class="hl-header shadow-sm">
        <div class="container d-flex align-items-center justify-content-between">
            {{-- LOGO --}}
            <div class="logo d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Highlands Logo">
            </div>

            {{-- MENU --}}
            <nav>
                <a href="/trang_chu">Trang chủ</a>
                <a href="/menu">Menu</a>
                <a href="/my-orders">Trạng Thái</a>
                <a href="#">Liên hệ</a>
            </nav>
        </div>
    </header>

    {{-- CONTENT --}}
    <div class="container content-area">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row">
                {{-- Thông tin cửa hàng --}}
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Highlands Coffee</h5>
                    <p>Địa chỉ: 123 Đường ABC, Quận 1, TP.HCM</p>
                    <p>Email: contact@highlands.vn</p>
                    <p>Hotline: 1900 1234</p>
                </div>

                {{-- Liên kết --}}
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Liên kết nhanh</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Trang chủ</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Menu</a></li>
                        <li><a href="/dat_ban_de" class="text-white text-decoration-none">Đặt bàn</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Liên hệ</a></li>
                    </ul>
                </div>

                {{-- Mạng xã hội --}}
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Mạng xã hội</h5>
                    <a href="#" class="text-white me-3 fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3 fs-4"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white me-3 fs-4"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <hr class="bg-secondary">

            <div class="text-center">
                <p class="mb-0">&copy; 2025 Highlands Coffee. Bảo lưu mọi quyền.</p>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
