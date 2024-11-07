<?php
session_start();
require 'config.php';

if (isset($_COOKIE['user'])) {
    $cookie = $_COOKIE['user'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE cookie = ?");
    $stmt->execute([$cookie]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user'] = $user['username'];
        header("Location: home.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        if ($rememberMe) {
            $stmt = $conn->prepare('UPDATE users SET cookie = ? WHERE username = ?');
            $stmt->execute([$username, $username]);
            setcookie('user', $user['username'], time() + (30 * 24 * 60 * 60), "/"); // 30 hari
        }
        header("Location: home.php");
        exit();
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('backgroundlogin.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            padding: 30px;
            width: 300px;
            text-align: center;
            animation: fadeIn 1s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card h2 {
            margin: 0 0 15px;
            color: #333;
        }
        .card input[type="text"],
        .card input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .card button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .card button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin: 10px 0;
            font-size: 0.9em;
        }
        .remember-me {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 15px;
            font-size: 0.9em;
            color: #333;
        }
        .remember-me input {
            margin-right: 8px;
            transform: scale(1.2); 
        }
        .register-link {
            display: block;
            color: #007bff;
            margin-top: 15px;
            font-size: 0.9em;
            text-decoration: none;
            text-align: center;
        }
        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <div class="error"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form action="index.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <div class="remember-me">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remeber me</label>
        </div>
        <button type="submit">Masuk</button>
    </form>
    <a href="register.php" class="register-link">Belum punya akun? Daftar di sini</a>
</div>

</body>
</html>
