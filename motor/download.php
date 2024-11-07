<?php
session_start();
require '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM motor");
$stmt->execute();
$motors = $stmt->fetchAll(PDO::FETCH_ASSOC);


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data_motor.csv"');


$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Nama Motor', 'Harga', 'Deskripsi', 'Gambar']); 

foreach ($motors as $motor) {
    fputcsv($output, $motor);
}

fclose($output);
exit();
