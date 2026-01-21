<?php
// add_award_column.php - Add award column to user_portfolio table
require_once 'config/database.php';

$sql = "ALTER TABLE user_portfolio ADD COLUMN award VARCHAR(255) DEFAULT NULL";

if ($conn->query($sql) === TRUE) {
    echo "Column 'award' added successfully to user_portfolio table.";
} else {
    echo "Error adding column: " . $conn->error;
}

$conn->close();
?>
