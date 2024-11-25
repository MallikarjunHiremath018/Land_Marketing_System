-- Create database
CREATE DATABASE IF NOT EXISTS land_marketing_system;

-- Use the database
USE land_marketing_system;

-- Users Table (for storing user information)
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Properties Table (for storing property listings)
CREATE TABLE IF NOT EXISTS properties (
    property_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(15,2) NOT NULL,
    location VARCHAR(255) NOT NULL,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Activity Logs Table (for tracking admin actions or other activities)
CREATE TABLE IF NOT EXISTS activity_logs (
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255) NOT NULL,
    activity_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Insert some sample data into users table
INSERT INTO users (username, password, email, full_name, role)
VALUES
('admin', 'adminpassword', 'admin@landmarketing.com', 'Admin User', 'admin'),
('johndoe', 'johndoepassword', 'johndoe@example.com', 'John Doe', 'user');

-- Insert some sample data into properties table
INSERT INTO properties (title, description, price, location, user_id)
VALUES
('Beautiful Farmhouse', 'A stunning farmhouse in the countryside with 10 acres of land.', 1500000.00, 'Karnataka, India', 2),
('Luxury Villa', 'A modern luxury villa with pool and garden, near the beach.', 5000000.00, 'Goa, India', 2);

-- Insert some sample activity logs
INSERT INTO activity_logs (user_id, action)
VALUES
(1, 'Created a new property listing for Beautiful Farmhouse'),
(1, 'Created a new property listing for Luxury Villa'),
(2, 'Updated property listing for Luxury Villa');

-- Add a table to track user purchases
CREATE TABLE IF NOT EXISTS user_purchases (
    purchase_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    property_id INT,
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (property_id) REFERENCES properties(property_id)
);

-- Modify the properties table to allow users to add properties
CREATE TABLE IF NOT EXISTS user_properties (
    user_property_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(15,2) NOT NULL,
    location VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
