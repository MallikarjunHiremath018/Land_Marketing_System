<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch properties bought by the user
$sql = "SELECT p.title, p.description, p.price, p.location, up.purchase_date 
        FROM user_purchases up
        JOIN properties p ON up.property_id = p.property_id
        WHERE up.user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$purchased_properties = $stmt->fetchAll();

// Fetch properties added by the user
$sql = "SELECT title, description, price, location FROM user_properties WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$user_properties = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Land Marketing System</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

    <h2>Your Purchases</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Location</th>
                <th>Purchase Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchased_properties as $property): ?>
                <tr>
                    <td><?php echo $property['title']; ?></td>
                    <td><?php echo $property['description']; ?></td>
                    <td><?php echo $property['price']; ?></td>
                    <td><?php echo $property['location']; ?></td>
                    <td><?php echo $property['purchase_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Your Added Properties</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_properties as $property): ?>
                <tr>
                    <td><?php echo $property['title']; ?></td>
                    <td><?php echo $property['description']; ?></td>
                    <td><?php echo $property['price']; ?></td>
                    <td><?php echo $property['location']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="add_property.php">Add New Property</a>
</body>
</html>
