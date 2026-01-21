-- Database fixes for student_event_volunteer_system

-- Add terms column to events table if not exists
ALTER TABLE events ADD COLUMN terms TEXT DEFAULT '';

-- Add end_date column to events table if not exists
ALTER TABLE events ADD COLUMN end_date DATETIME DEFAULT NULL;

-- Add logo_path column to events table if not exists
ALTER TABLE events ADD COLUMN logo_path VARCHAR(255) DEFAULT '';

-- Create event_timelines table if not exists
CREATE TABLE IF NOT EXISTS event_timelines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT,
    agenda_name VARCHAR(255) NOT NULL,
    agenda_date DATETIME,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

-- Optional: Add any other missing columns or tables as needed

-- Add email column to event_registrations table
ALTER TABLE event_registrations ADD COLUMN email VARCHAR(255) DEFAULT '';

-- Add qualifications column to volunteers table
ALTER TABLE volunteers ADD COLUMN qualifications TEXT DEFAULT '';

-- Drop and recreate volunteer_timelines table to fix columns
DROP TABLE IF EXISTS volunteer_timelines;
CREATE TABLE volunteer_timelines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    volunteer_id INT,
    agenda_name VARCHAR(255) NOT NULL,
    agenda_date DATETIME NOT NULL,
    FOREIGN KEY (volunteer_id) REFERENCES volunteers(id) ON DELETE CASCADE
);

-- Add columns to volunteer_registrations table
ALTER TABLE volunteer_registrations ADD COLUMN name VARCHAR(255) DEFAULT '';
ALTER TABLE volunteer_registrations ADD COLUMN origin VARCHAR(255) DEFAULT '';
ALTER TABLE volunteer_registrations ADD COLUMN program_studi VARCHAR(255) DEFAULT '';
ALTER TABLE volunteer_registrations ADD COLUMN fakultas VARCHAR(255) DEFAULT '';
ALTER TABLE volunteer_registrations ADD COLUMN phone VARCHAR(20) DEFAULT '';
ALTER TABLE volunteer_registrations ADD COLUMN email VARCHAR(255) DEFAULT '';
ALTER TABLE volunteer_registrations ADD COLUMN cv_path VARCHAR(255) DEFAULT '';
ALTER TABLE volunteer_registrations ADD COLUMN jobdesk TEXT DEFAULT '';
ALTER TABLE volunteer_registrations ADD COLUMN division VARCHAR(255) DEFAULT '';
ALTER TABLE volunteer_registrations ADD COLUMN activity_date DATE DEFAULT NULL;

-- Allow null for event_id and volunteer_id in user_portfolio
ALTER TABLE user_portfolio MODIFY event_id INT NULL;
ALTER TABLE user_portfolio MODIFY volunteer_id INT NULL;
