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

CREATE TABLE IF NOT EXISTS friendships (
    id INT(11) NOT NULL AUTO_INCREMENT,
    sender_uid INT NOT NULL,
    reciver_uid INT NOT NULL,
    status ENUM('pending', 'accepted', 'declined', 'blocked', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (sender_uid) REFERENCES users(uid),
    FOREIGN KEY (reciver_uid) REFERENCES users(uid)
);

CREATE TABLE IF NOT EXISTS communities (
    cid INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    location VARCHAR(255),
    description TEXT,
    cover_image VARCHAR(255),
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(uid)
);

CREATE TABLE IF NOT EXISTS community_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uid INT NOT NULL,
    cid INT NOT NULL,
    role ENUM('owner', 'admin', 'moderator', 'member') DEFAULT 'member',
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uid) REFERENCES users(uid),
    FOREIGN KEY (cid) REFERENCES communities(cid) ON DELETE CASCADE
);

-- Table for direct user-to-user messages
CREATE TABLE IF NOT EXISTS direct_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_uid INT NOT NULL,
    receiver_uid INT NOT NULL,
    content TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_uid) REFERENCES users(uid),
    FOREIGN KEY (receiver_uid) REFERENCES users(uid)
);

-- Table for user-to-community (group) messages (renamed as community_messages)
CREATE TABLE IF NOT EXISTS community_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cid INT NOT NULL,
    sender_uid INT NOT NULL,
    content TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cid) REFERENCES communities(cid) ON DELETE CASCADE,
    FOREIGN KEY (sender_uid) REFERENCES users(uid)
);