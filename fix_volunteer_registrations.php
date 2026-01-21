<?php
// fix_volunteer_registrations.php - Add missing columns to volunteer_registrations
require_once 'config/database.php';

$queries = [
    "ALTER TABLE volunteer_registrations ADD COLUMN name VARCHAR(255) DEFAULT ''",
    "ALTER TABLE volunteer_registrations ADD COLUMN origin VARCHAR(255) DEFAULT ''",
    "ALTER TABLE volunteer_registrations ADD COLUMN program_studi VARCHAR(255) DEFAULT ''",
    "ALTER TABLE volunteer_registrations ADD COLUMN fakultas VARCHAR(255) DEFAULT ''",
    "ALTER TABLE volunteer_registrations ADD COLUMN phone VARCHAR(20) DEFAULT ''",
    "ALTER TABLE volunteer_registrations ADD COLUMN email VARCHAR(255) DEFAULT ''",
    "ALTER TABLE volunteer_registrations ADD COLUMN cv_path VARCHAR(255) DEFAULT ''"
];

foreach ($queries as $query) {
    try {
        $conn->query($query);
        echo "Executed: $query\n";
    } catch (Exception $e) {
        echo "Error or already exists: $query\n";
    }
}

echo "Volunteer registrations table updated.\n";
?>
