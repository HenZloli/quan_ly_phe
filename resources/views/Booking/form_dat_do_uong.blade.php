@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Menu đồ uống</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @foreach($drinks as $drink)
        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <h5>{{ $drink->name }}</h5>
                <p>Giá: {{ number_format($drink->price) }}₫</p>
                <form action="{{ route('menu.order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="drink_id" value="{{ $drink->id }}">
                    <input type="number" name="quantity" value="1" min="1" class="form-control mb-2">
                    <button type="submit" class="btn btn-primary w-100">Đặt món</button>
                </form>
            </div>
        </div>
        @endforeach

        @if(count($drinks) == 0)
            <p class="text-muted">Chưa có đồ uống nào</p>
        @endif
    </div>
</div>
@endsection
