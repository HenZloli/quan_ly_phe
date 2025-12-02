<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nguyên liệu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .card { border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: bold; font-size: 20px; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="#">☕ Cafe Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="/menu">Menu khách</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/drinks">Thêm đồ uống</a></li>
            <li class="nav-item"><a class="nav-link active" href="/admin/materials">Nguyên liệu</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Quản lý tài khoản</a></li>
        </ul>
        <!-- Số dư admin -->
        <div class="text-white">
            💵 Số dư: 
            <span class="badge bg-success">
                {{ number_format(Auth::user()->balance ?? 0) }}₫
            </span>
        </div>
        <a href="/logout" class="btn btn-outline-light ms-3">Đăng xuất</a>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4">Quản lý nguyên liệu</h2>

    <!-- Flash messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Form thêm nguyên liệu -->
    <div class="card mb-4 p-3 shadow-sm">
        <h5>Thêm nguyên liệu mới</h5>
        <form action="{{ route('admin.materials.store') }}" method="POST" class="row g-2 align-items-center">
            @csrf
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Tên nguyên liệu" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="quantity" class="form-control" placeholder="Số lượng" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="unit" class="form-control" placeholder="Đơn vị" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100">Thêm</button>
            </div>
        </form>
    </div>

    <!-- Bảng nguyên liệu -->
    <div class="card p-3 shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Số lượng</th>
                        <th>Đơn vị</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $index => $material)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $material->name }}</td>
                        <td>{{ $material->quantity }}</td>
                        <td>{{ $material->unit }}</td>
                        <td>
                            <!-- Nút sửa -->
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $material->id }}">Sửa</button>

                            <!-- Nút xóa -->
                            <form action="{{ route('admin.materials.delete', $material->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận xóa nguyên liệu này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>

                            <!-- Modal sửa nguyên liệu -->
                            <div class="modal fade" id="editModal{{ $material->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $material->id }}" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $material->id }}">Sửa nguyên liệu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action="{{ route('admin.materials.update', $material->id) }}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <div class="modal-body">
                                          <div class="mb-3">
                                              <label>Tên nguyên liệu</label>
                                              <input type="text" name="name" class="form-control" value="{{ $material->name }}" required>
                                          </div>
                                          <div class="mb-3">
                                              <label>Số lượng</label>
                                              <input type="number" name="quantity" class="form-control" value="{{ $material->quantity }}" required>
                                          </div>
                                          <div class="mb-3">
                                              <label>Đơn vị</label>
                                              <input type="text" name="unit" class="form-control" value="{{ $material->unit }}" required>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                      </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                    @if(count($materials) == 0)
                        <tr>
                            <td colspan="5" class="text-center text-muted">Chưa có nguyên liệu nào</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
