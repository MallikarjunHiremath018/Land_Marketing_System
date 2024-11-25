<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];

    // Insert user data into the database
    $sql = "INSERT INTO users (username, password, email, full_name) VALUES (:username, :password, :email, :full_name)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email, 'full_name' => $full_name]);

    echo "Registration successful!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Land Marketing System</title>
</head>
<body>
    <form method="POST" action="register.php">
        <label for="username">Username</label>
        <input type="text" name="username" required><br>

        <label for="password">Password</label>
        <input type="password" name="password" required><br>

        <label for="email">Email</label>
        <input type="email" name="email" required><br>

        <label for="full_name">Full Name</label>
        <input type="text" name="full_name" required><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
