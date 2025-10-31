CREATE DATABASE IF NOT EXISTS user_db;
USE user_db;

-- User data table
CREATE TABLE IF NOT EXISTS user_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender CHAR(1),
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    county VARCHAR(50),
    card_no VARCHAR(10) UNIQUE NOT NULL,
    pin VARCHAR(4) NOT NULL,
    acc_no VARCHAR(10) UNIQUE NOT NULL,
    balance DECIMAL(10,2) DEFAULT 500.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Transactions table
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    acc_no VARCHAR(10) NOT NULL,
    transaction TEXT NOT NULL,
    credit BOOLEAN DEFAULT FALSE,
    timing DATETIME NOT NULL,
    FOREIGN KEY (acc_no) REFERENCES user_data(acc_no) ON DELETE CASCADE
);