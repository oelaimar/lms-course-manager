<?php
require_once __DIR__ . "/includes/config.php";

echo "<h1>Docker PHP + Nginx + MySQL Works!</h1>";

$result = $conn->query("SELECT 'Connected to MySQL!' AS msg");

$row = $result->fetch_assoc();
echo "<p>" . $row['msg'] . "</p>";
?>
