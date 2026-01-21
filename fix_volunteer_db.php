<?php
require_once 'config/database.php';

// Add qualifications column to volunteers table if not exists
$conn->query("ALTER TABLE volunteers ADD COLUMN qualifications TEXT DEFAULT ''");

// Drop and recreate volunteer_timelines table
$conn->query("DROP TABLE IF EXISTS volunteer_timelines");
$conn->query("CREATE TABLE volunteer_timelines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    volunteer_id INT,
    agenda_name VARCHAR(255) NOT NULL,
    agenda_date DATETIME NOT NULL,
    FOREIGN KEY (volunteer_id) REFERENCES volunteers(id) ON DELETE CASCADE
)");

echo "Volunteer database fixes applied.\n";
$conn->close();
?>
