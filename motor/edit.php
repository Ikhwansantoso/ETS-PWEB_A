<?php
session_start();
require '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ../home.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM motor WHERE id = ?");
$stmt->execute([$_GET['id']]);
$motor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$motor) {
    header("Location: ../home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_motor = $_POST['nama_motor'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    
    $stmt = $conn->prepare("UPDATE motor SET nama_motor = ?, harga = ?, deskripsi = ? WHERE id = ?");
    $stmt->execute([$nama_motor, $harga, $deskripsi, $_GET['id']]);
    
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($gambar);
        
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $stmt = $conn->prepare("UPDATE motor SET gambar = ? WHERE id = ?");
            $stmt->execute([$gambar, $_GET['id']]);
        }
    }
    
    header("Location: ../home.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Motor</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('../backgroundlogin.jpg');
            background-size: cover;
            background-position: center;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            margin: 80px 0 20px;
            color: black;
        }

        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        footer {
            background-color: rgba(52, 58, 64, 0.9);
            color: #fff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>
<body>

<h2>Edit Data Motor</h2>

<div class="form-container">
    <form action="edit.php?id=<?= $motor['id']; ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="nama_motor" value="<?= htmlspecialchars($motor['nama_motor']); ?>" required>
        <input type="number" name="harga" value="<?= $motor['harga']; ?>" required>
        <textarea name="deskripsi" required><?= htmlspecialchars($motor['deskripsi']); ?></textarea>
        <input type="file" name="gambar">
        <button type="submit">Update Motor</button>
    </form>
</div>

<a href="../home.php" class="back-link">Kembali</a>

<footer>
    <p>&copy; <?= date("Y"); ?> Penjualan Motor. All rights reserved.</p>
</footer>

</body>
</html>
