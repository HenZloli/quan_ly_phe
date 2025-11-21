<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login kiểu Facebook</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background-color: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        width: 360px;
        text-align: center;
    }

    .login-container h1 {
        color: #1877f2;
        margin-bottom: 30px;
        font-size: 32px;
        font-weight: bold;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border-radius: 6px;
        border: 1px solid #ddd;
        font-size: 16px;
    }

    .login-container button {
        width: 100%;
        padding: 12px;
        background-color: #1877f2;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 12px;
    }

    .login-container button:hover {
        background-color: #165ec7;
    }

    .login-container a {
        display: block;
        margin-top: 12px;
        color: #1877f2;
        text-decoration: none;
        font-size: 14px;
    }

    .login-container a:hover {
        text-decoration: underline;
    }

    .error {
        color: red;
        margin-top: 12px;
        font-size: 14px;
    }
</style>
</head>
<body>

<div class="login-container">
    <h1>FaceFood</h1>
    <form method="post" action="product.php">
        <input type="text" name="username" placeholder="Số điện thoại hoặc email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit">Đăng nhập</button>
    </form>
    <a href="login.php">Quên mật khẩu?</a>
    <hr style="margin: 20px 0;">
    <button style="background-color: #42b72a;">Tạo tài khoản mới</button>
</div>

</body>
</html>