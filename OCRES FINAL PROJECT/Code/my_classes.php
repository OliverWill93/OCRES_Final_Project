<?php
require 'db_config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in.";
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT c.course_code, c.course_name, c.instructor, c.schedule
    FROM classes c
    JOIN registrations r ON c.class_id = r.class_id
    WHERE r.user_id = ?
");
$stmt->execute([$user_id]);
$classes = $stmt->fetchAll();

echo "<h2>My Registered Classes</h2>";
if (count($classes) > 0) {
    foreach ($classes as $class) {
        echo "{$class['course_code']} - {$class['course_name']} ({$class['schedule']}) with {$class['instructor']}<br>";
    }
} else {
    echo "No classes registered.";
}
?>
