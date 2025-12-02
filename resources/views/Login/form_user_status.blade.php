@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Đơn hàng của tôi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
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
                    <td>{{ $order->drink->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ number_format($order->price * $order->quantity) }}₫</td>
                    <td>
                        @php
                            $statusVN = match($order->status) {
                                'pending' => 'Đang chờ',
                                'accepted' => 'Đang làm',
                                'completed' => 'Hoàn thành',
                                'canceled' => 'Đã hủy',
                                default => $order->status,
                            };
                            $badge = match($order->status) {
                                'pending' => 'secondary',
                                'accepted' => 'info',
                                'completed' => 'success',
                                'canceled' => 'danger',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $statusVN }}</span>
                    </td>
                    <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td class="d-flex gap-2">
                        {{-- Hủy đơn --}}
                        @if($order->status == 'pending' || $order->status == 'accepted')
                        <form action="{{ route('user.cancelOrder', $order->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-danger">Hủy</button>
                        </form>
                        @endif

                        {{-- Xóa lịch sử --}}
                        @if($order->status == 'completed' || $order->status == 'canceled')
                        <form action="{{ route('user.deleteOrder', $order->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-outline-danger">Xóa</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach

                @if(count($orders) == 0)
                <tr>
                    <td colspan="7" class="text-center text-muted">Chưa có đơn hàng nào</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
