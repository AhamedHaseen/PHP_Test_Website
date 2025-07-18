-- Database setup for User Management System
-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS useraccounts;
USE useraccounts;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phonenumber VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active TINYINT(1) DEFAULT 1,
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
);

-- Optional: Create a sample admin user (password: admin123)
-- INSERT INTO users (firstname, lastname, email, phonenumber, password) 
-- VALUES ('Admin', 'User', 'admin@example.com', '1234567890', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Display table structure
DESCRIBE users;
