CREATE DATABASE `vitagro`;
USE `vitagro`;

CREATE TABLE `employees` (
    `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` INT NOT NULL,
    `role` VARCHAR(255) NOT NULL,
    `password1` VARCHAR(255) NOT NULL,
    `password2` VARCHAR(255) NOT NULL,
    `p_p` varchar(255) DEFAULT 'user-default.png',
    `last_seen` datetime NOT NULL DEFAULT current_timestamp()
    
    
);