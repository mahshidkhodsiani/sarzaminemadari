<?php
ob_start();
session_start();

include '../config.php';

// پردازش فرم لاگین
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username= '$username' AND password= '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['all_data'] = $row;
        header('Location: index.php');
        exit;
    } else {
        $error = "نام کاربری یا رمز عبور اشتباه است";
    }
    $conn->close();
}

// اگر کاربر قبلا لاگین کرده باشد، به صفحه اصلی هدایت شود
if (isset($_SESSION['all_data'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صفحه ورود</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <style>
        body {
            background: url('https://source.unsplash.com/1920x1080/?technology') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Tahoma', sans-serif;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-card h3 {
            margin-bottom: 25px;
            text-align: center;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-login {
            border-radius: 10px;
            background-color: #198754;
            color: white;
        }

        .btn-login:hover {
            background-color: #157347;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h3>ورود به حساب کاربری</h3>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">یوزر نیم</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="نام کاربری" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">رمز عبور</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور" required>
            </div>
            <button type="submit" name="login" class="btn btn-login w-100">ورود</button>
        </form>
    </div>

</body>

</html>