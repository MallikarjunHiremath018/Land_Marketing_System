<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['property_id'])) {
    $property_id = $_GET['property_id'];
    $user_id = $_SESSION['user_id'];

    // Insert the purchase into the database
    $sql = "INSERT INTO user_purchases (user_id, property_id) VALUES (:user_id, :property_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'property_id' => $property_id]);

    echo "Purchase successful!";
}
?>
