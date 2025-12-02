<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - Đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .card { border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: bold; font-size: 20px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="#">☕ Cafe Staff</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link active" href="/staff">Đơn hàng</a></li>
            <li class="nav-item"><a class="nav-link" href="/menu">Menu khách</a></li>
        </ul>

            <a href="/logout" class="btn btn-outline-light ms-3">Đăng xuất</a>
    </div>
</nav>

<div class="container py-4">
    <h3 class="mb-4">Đơn hàng đang chờ</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Khách</th>
                    <th>Món</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->user->username ?? 'Khách vãng lai' }}</td>
                    <td>{{ $order->drink->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ number_format($order->price) }}₫</td>
                    <td>
                        <span class="badge bg-{{ $order->status=='pending'?'secondary':($order->status=='accepted'?'info':($order->status=='completed'?'success':'danger')) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td class="d-flex gap-2">
                        @if($order->status == 'pending')
                        <form action="{{ route('staff.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="accepted">
                            <button class="btn btn-sm btn-primary">Nhận đơn</button>
                        </form>
                        @endif

                        @if($order->status == 'accepted')
                        <form action="{{ route('staff.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="completed">
                            <button class="btn btn-sm btn-success">Hoàn thành</button>
                        </form>
                        @endif

                        @if($order->status != 'completed' && $order->status != 'canceled')
                        <form action="{{ route('staff.cancelOrder', $order->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-danger">Hủy</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach

                @if(count($orders) == 0)
                <tr><td colspan="8" class="text-center text-muted">Chưa có đơn hàng nào</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
