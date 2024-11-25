<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $user_id = $_SESSION['user_id'];

    // Insert property into the database
    $sql = "INSERT INTO user_properties (user_id, title, description, price, location) 
            VALUES (:user_id, :title, :description, :price, :location)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'title' => $title, 'description' => $description, 'price' => $price, 'location' => $location]);

    echo "Property added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
</head>
<body>
    <h1>Add New Property</h1>
    <form method="POST" action="add_property.php">
        <label for="title">Title</label>
        <input type="text" name="title" required><br>

        <label for="description">Description</label>
        <textarea name="description" required></textarea><br>

        <label for="price">Price</label>
        <input type="number" name="price" step="0.01" required><br>

        <label for="location">Location</label>
        <input type="text" name="location" required><br>

        <button type="submit">Add Property</button>
    </form>
</body>
</html>
