<?php
session_start();
require '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_motor = $_POST['nama_motor'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar'];

    
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($gambar['name']);

    if (move_uploaded_file($gambar['tmp_name'], $uploadFile)) {
        $stmt = $conn->prepare("INSERT INTO motor (nama_motor, harga, deskripsi, gambar) VALUES (:nama_motor, :harga, :deskripsi, :gambar)");
        $stmt->bindParam(':nama_motor', $nama_motor);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':deskripsi', $deskripsi);
        $stmt->bindParam(':gambar', $gambar['name']);

        if ($stmt->execute()) {
            header("Location: ../home.php");
            exit();
        } else {
            echo "<p>Gagal menyimpan data ke database.</p>";
        }
    } else {
        echo "<p>Gagal mengunggah gambar. Pastikan direktori 'uploads/' tersedia dan memiliki izin yang tepat.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Motor</title>
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
            padding-top: 70px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar h1 {
            margin: 0;
            font-size: 1.5em;
        }

        .navbar a {
            color: #333;
            margin: 0 15px;
            text-decoration: none;
            font-size: 1em;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            margin: 20px auto; 
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h1>IMOR.</h1>
    <div>
    </div>
</div>

<div class="form-container">
    <h2>Tambah Motor</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama_motor">Nama Motor:</label>
        <input type="text" id="nama_motor" name="nama_motor" required>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" required>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>

        <label for="gambar">Gambar:</label>
        <input type="file" id="gambar" name="gambar" accept="image/*" required>

        <input type="submit" value="Simpan Motor">
    </form>
</div>

<footer>
    <p>&copy; <?= date("Y"); ?> Penjualan Motor. @IMOR.</p>
</footer>

</body>
</html>

