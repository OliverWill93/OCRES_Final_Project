<?php
require 'db_config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $class_id = $_POST['class_id'];

    $stmt = $pdo->prepare("INSERT INTO registrations (user_id, class_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $class_id]);

    echo "Class registered successfully!<br><br>";
}

// Show available classes
$stmt = $pdo->query("SELECT * FROM classes");
$classes = $stmt->fetchAll();

echo "<form method='POST'><h2>Available Classes</h2>";
foreach ($classes as $class) {
    echo "<input type='radio' name='class_id' value='{$class['class_id']}'> 
          {$class['course_code']} - {$class['course_name']} 
          ({$class['schedule']} with {$class['instructor']})<br>";
}
echo "<input type='submit' value='Register'>";
echo "</form>";
?>
