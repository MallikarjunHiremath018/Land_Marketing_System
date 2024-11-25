<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch properties from the database
$sql = "SELECT * FROM properties";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$properties = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Properties</title>
</head>
<body>
    <h1>Manage Properties</h1>
    <a href="add-property.php">Add New Property</a>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($properties as $property): ?>
                <tr>
                    <td><?php echo $property['title']; ?></td>
                    <td><?php echo $property['description']; ?></td>
                    <td><?php echo $property['price']; ?></td>
                    <td><?php echo $property['location']; ?></td>
                    <td><a href="edit-property.php?id=<?php echo $property['property_id']; ?>">Edit</a> | 
                        <a href="delete-property.php?id=<?php echo $property['property_id']; ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
