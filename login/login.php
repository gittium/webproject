<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - เบเกอรี่</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF7E6; /* สีครีม */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            color: #D2691E; /* สีช็อกโกแลตอ่อน */
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            color: #8B4513; /* สีน้ำตาลอ่อน */
            font-size: 14px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #D3D3D3;
            border-radius: 5px;
            background-color: #FAF0E6; /* สีครีม */
        }
        .login-button {
            padding: 10px 20px;
            background-color: #D2691E;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .notification {
            display: none;
            color: #FF6347; /* สีแดงแจ้งเตือน */
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>เข้าสู่ระบบ</h2>
        <form action="login_db.php" method="post">
            <div class="input-group">
                <label for="username">ชื่อผู้ใช้:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" id="password" name="password"required>
            </div>
            <p class="notification" id="notification">ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</p>
            <button class="login-button" type="submit" name="login_user">เข้าสู่ระบบ</button>
            </div>
        </form>

    
</body>
</html>

