CREATE DATABASE IF NOT EXISTS dice_game;
USE dice_game;

-- User Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- Game Records Table with win/lose
CREATE TABLE game_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    login_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    logout_datetime DATETIME,
    score INT DEFAULT 0,
    result VARCHAR(10),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
