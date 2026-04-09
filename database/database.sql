CREATE DATABASE IF NOT EXISTS sc;
USE sc;

CREATE TABLE IF NOT EXISTS users (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    location VARCHAR(255),
    contact VARCHAR(20),
    dob DATE,
    gender ENUM('male', 'female', 'other') DEFAULT 'male',
    profile_pic VARCHAR(255),
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);