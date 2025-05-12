<?php
require 'db_config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in.";
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle form submission to drop the selected class
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];

    $stmt = $pdo->prepare("DELETE FROM registrations WHERE user_id = ? AND class_id = ?");
    $stmt->execute([$user_id, $class_id]);

    echo "Class dropped successfully.<br><br>";
}

// Fetch classes the user is registered for
$stmt = $pdo->prepare("
    SELECT c.class_id, c.course_name, c.schedule
    FROM classes c
    JOIN registrations r ON c.class_id = r.class_id
    WHERE r.user_id = ?
");
$stmt->execute([$user_id]);
$classes = $stmt->fetchAll();

if (count($classes) > 0) {
    echo "<form method='POST'><h2>Drop a Class</h2>";
    foreach ($classes as $class) {
        echo "<input type='radio' name='class_id' value='{$class['class_id']}'> 
              {$class['course_name']} ({$class['schedule']})<br>";
    }
    echo "<input type='submit' value='Drop Class'>";
    echo "</form>";
} else {
    echo "You are not registered for any classes.";
}
?>
