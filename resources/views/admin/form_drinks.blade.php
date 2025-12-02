<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quản lý đồ uống</title>
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
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link active" href="/admin/drinks">Đồ uống</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/materials">Nguyên liệu</a></li>
        </ul>
        <a href="/logout" class="btn btn-outline-light ms-3">Đăng xuất</a>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4">Quản lý đồ uống</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Thêm đồ uống -->
    <div class="card p-3 mb-4">
        <form action="{{ route('admin.drinks.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <input type="text" name="name" class="form-control" placeholder="Tên đồ uống" required>
            </div>
            <div class="mb-2">
                <input type="number" name="price" class="form-control" placeholder="Giá tiền" required>
            </div>

            <h5>Nguyên liệu:</h5>
            @foreach($materials as $material)
                <div class="row mb-1 align-items-center">
                    <div class="col-auto form-check">
                        <input class="form-check-input" type="checkbox" name="materials[{{ $material->id }}][quantity]" value="10" id="material{{ $material->id }}">
                        <label class="form-check-label" for="material{{ $material->id }}">{{ $material->name }} ({{ $material->unit }})</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" name="materials[{{ $material->id }}][quantity]" class="form-control" value="10" min="1" placeholder="Số lượng">
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary mt-2">Thêm đồ uống</button>
        </form>
    </div>

    <!-- Danh sách đồ uống -->
    <div class="card p-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên đồ uống</th>
                    <th>Giá</th>
                    <th>Nguyên liệu</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drinks as $index => $drink)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $drink->name }}</td>
                    <td>{{ number_format($drink->price) }}₫</td>
                    <td>
                        @foreach($drink->materials as $mat)
                            {{ $mat->name }} ({{ $mat->pivot->quantity }}{{ $mat->unit }}),
                        @endforeach
                    </td>
                    <td>
                        <!-- Sửa -->
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $drink->id }}">Sửa</button>

                        <!-- Xóa -->
                        <form action="{{ route('admin.drinks.delete', $drink->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận xóa đồ uống này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>

                        <!-- Modal Sửa -->
                        <div class="modal fade" id="editModal{{ $drink->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $drink->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $drink->id }}">Sửa đồ uống</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <form action="{{ route('admin.drinks.update', $drink->id) }}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <div class="modal-body">
                                          <div class="mb-2">
                                              <label>Tên đồ uống</label>
                                              <input type="text" name="name" class="form-control" value="{{ $drink->name }}" required>
                                          </div>
                                          <div class="mb-2">
                                              <label>Giá</label>
                                              <input type="number" name="price" class="form-control" value="{{ $drink->price }}" required>
                                          </div>

                                          <h6>Nguyên liệu:</h6>
                                          @foreach($materials as $material)
                                              <div class="row mb-1 align-items-center">
                                                  <div class="col-auto form-check">
                                                      <input class="form-check-input" type="checkbox" name="materials[{{ $material->id }}][quantity]" 
                                                        id="editMaterial{{ $drink->id }}{{ $material->id }}"
                                                        @if($drink->materials->contains($material->id)) checked @endif
                                                      >
                                                      <label class="form-check-label" for="editMaterial{{ $drink->id }}{{ $material->id }}">
                                                          {{ $material->name }} ({{ $material->unit }})
                                                      </label>
                                                  </div>
                                                  <div class="col-auto">
                                                      <input type="number" name="materials[{{ $material->id }}][quantity]" class="form-control" min="1" value="{{ $drink->materials->find($material->id)->pivot->quantity ?? 10 }}">
                                                  </div>
                                              </div>
                                          @endforeach
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                          <button type="submit" class="btn btn-primary">Lưu</button>
                                      </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

                @if(count($drinks) == 0)
                    <tr><td colspan="5" class="text-center text-muted">Chưa có đồ uống nào</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
