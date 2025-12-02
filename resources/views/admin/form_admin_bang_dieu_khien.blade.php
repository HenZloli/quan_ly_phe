<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="#">☕ Cafe Admin</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="/menu">Menu khách</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/drinks">Thêm đồ uống</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/materials">Nguyên liệu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/admin/dashboard">Quản lý tài khoản</a>
            </li>
        </ul>
        {{-- Logout --}}
        <a href="/logout" class="btn btn-outline-light ms-3">Đăng xuất</a>
    </div>
</nav>


<div class="container py-5">
    <h2 class="mb-4">Quản lý tài khoản khách hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-3">
        <div class="table-responsive">


            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->username }}</td>

                        <td>
                            <span class="badge bg-{{ $user->role=='admin' ? 'danger' : ($user->role=='staff' ? 'success' : 'secondary') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>

                        <td>
                            <form method="POST" action="{{ route('admin.setRole', $user->id) }}">
                                @csrf
                                <select name="role" class="form-select d-inline w-auto">
                                    <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                                    <option value="staff" {{ $user->role=='staff'?'selected':'' }}>Staff</option>
                                    <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm mt-1">Cập nhật</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if(count($users) == 0)
                    <tr>
                        <td colspan="6" class="text-center text-muted">Chưa có tài khoản nào</td>
                    </tr>
                    @endif
                </tbody>
            </table>



        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
