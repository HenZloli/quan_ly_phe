<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Xin chào, {{ Auth::user()->name }}</h1>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Đăng xuất</button>
</form>

</body>
</html>
