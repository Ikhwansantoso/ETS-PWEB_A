<?php
session_start();
require '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM motor WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: ../home.php");
