@extends('layouts.app') <!-- nếu có layout chung -->

@section('content')
<div class="card mx-auto mt-5" style="max-width:500px; padding:30px; box-shadow:0 8px 20px rgba(0,0,0,0.2); border-radius:15px;">
    <h3 class="text-center mb-4">Tạo tài khoản mới</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="/admin/users">
        @csrf
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" class="form-control" name="username" placeholder="Username" required>
        </div>

        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>

        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select">
                <option value="user">Nhân viên</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Tạo tài khoản</button>
    </form>
</div>
@endsection
