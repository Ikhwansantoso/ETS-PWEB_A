<?php
session_start();
require 'config.php';


$stmt = $conn->prepare("SELECT * FROM motor");
$stmt->execute();
$motors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Motor</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('backgroundlogin.jpg');
            background-size: cover;
            background-position: center;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }


        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: rgba(255, 255, 255, 0.8);
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
            padding: 10px 15px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: rgba(200, 200, 200, 0.5);
        }

        .welcome-message {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin: 80px auto 20px;
            width: 80%;
            max-width: 500px;
            color: #007bff;
        }

        .motor-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 1200px;
            margin: 20px auto;
            flex: 1;
            padding-top: 60px;
        }

        .motor-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 15px;
            width: calc(25% - 40px);
            box-sizing: border-box;
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 300px;
        }

        .motor-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .motor-info {
            text-align: center;
            flex-grow: 1;
        }

        .motor-info h3 {
            margin: 10px 0;
            color: #007bff;
        }

        .motor-info p {
            color: #666;
            font-size: 0.9em;
        }

        .motor-info span {
            display: block;
            font-weight: bold;
            color: #28a745;
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
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            margin-top: auto;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h1>IMOR.</h1>
    <div>
        <a href="motor/create.php">Tambah Motor</a>
        <a href="logout.php">Logout</a>
    </div>
</div>


<div class="welcome-message">
    <h2>Selamat datang, <?php echo $_SESSION['username'] ?>!</h2>
</div>

<h2>Daftar Motor</h2>
<div class="motor-container">
    <?php foreach ($motors as $motor): ?>
        <div class="motor-card">
            <img src="uploads/<?= htmlspecialchars($motor['gambar']); ?>" alt="<?= htmlspecialchars($motor['nama_motor']); ?>">
            <div class="motor-info">
                <h3><?= htmlspecialchars($motor['nama_motor']); ?></h3>
                <span>Harga: Rp<?= number_format($motor['harga'], 0, ',', '.'); ?></span>
                <p><?= htmlspecialchars($motor['deskripsi']); ?></p>
                <a href="motor/edit.php?id=<?= $motor['id']; ?>">Edit</a> |
                <a href="motor/delete.php?id=<?= $motor['id']; ?>">Hapus</a>
            </div>
            <a href="uploads/<?= htmlspecialchars($motor['gambar']); ?>" download class="back-link">Download Gambar</a>
        </div>
    <?php endforeach; ?>
</div>


<footer>
    <p>&copy; <?= date("Y"); ?> Penjualan Motor. @IMOR.</p>
</footer>

</body>
</html>
