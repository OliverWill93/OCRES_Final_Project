<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>OCRES Landing Page</title>
</head>
<body>
    <h1>Welcome to the Online Course Registration and Enrollment System (OCRES)</h1>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p>You are logged in.</p>
        <ul>
            <li><a href="register_class.php">Register for Classes</a></li>
            <li><a href="my_classes.php">View My Registered Classes</a></li>
            <li><a href="drop_class.php">Drop a Class</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    <?php else: ?>
        <p>Please log in or register to continue.</p>
        <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    <?php endif; ?>
</body>
</html>
