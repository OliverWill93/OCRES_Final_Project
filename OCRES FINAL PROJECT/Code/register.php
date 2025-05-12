<?php
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $password]);
        echo "Registration successful!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<form method="POST">
    <h2>Register</h2>
    Full Name: <input type="text" name="name"><br>
    Email: <input type="email" name="email"><br>
    Phone: <input type="text" name="phone"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Register">
</form>
