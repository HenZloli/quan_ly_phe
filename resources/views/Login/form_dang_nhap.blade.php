<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #f0e5d8, #f8f9fa);
            min-height: 100vh;
        }
        .card {
            max-width: 450px;
            margin: 70px auto;
            padding: 35px 25px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            background-color: rgba(255,255,255,0.95);
        }
        .btn-primary {
            background-color: #6f4e37;
            border-color: #6f4e37;
        }
        .btn-primary:hover {
            background-color: #563d2e;
            border-color: #563d2e;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="text-center mb-4">
       <img src="{{ asset('images/logo.png') }}" alt="Logo" width="70" style="border-radius:50%;">
        <h3>Đăng nhập</h3>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/login/">
        @csrf

        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
            <input type="email" class="form-control" name="username" placeholder="Email" required>
        </div>

        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
    </form>

    <p class="text-center mt-3">
        Chưa có tài khoản? <a href="/register/">Đăng ký</a>
    </p>

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


