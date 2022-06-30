-- CREATE DATABASE `vitagro`;
-- USE `vitagro`;

-- CREATE TABLE `employees` (
--     `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
--     `name` VARCHAR(255) NOT NULL,
--     `email` VARCHAR(255) NOT NULL,
--     `phone` INT NOT NULL,
--     `role` VARCHAR(255) NOT NULL,
--     `password1` VARCHAR(255) NOT NULL,
--     `password2` VARCHAR(255) NOT NULL,
--     `p_p` varchar(255) DEFAULT 'user-default.png',
--     `last_seen` datetime NOT NULL DEFAULT current_timestamp()
    
    
-- );


CREATE TABLE IF NOT EXISTS `tbl_admin` (
`user_id` int(20) NOT NULL,
  `fullname` varchar(120) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `temp_password` varchar(100) DEFAULT NULL,
  `user_role` int(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS `attendance_info` (
`aten_id` int(20) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `atn_user_id` int(20) NOT NULL,
  `in_time` varchar(200) DEFAULT NULL,
  `out_time` varchar(150) DEFAULT NULL,
  `total_duration` varchar(100) DEFAULT NULL
);


CREATE TABLE IF NOT EXISTS `task_info` (
`task_id` int(50) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `t_title` varchar(120) NOT NULL,
  `t_description` text,
  `t_start_time` varchar(100) DEFAULT NULL,
  `t_end_time` varchar(100) DEFAULT NULL,
  `t_user_id` int(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = incomplete, 1 = In progress, 2 = complete'
);

CREATE DATABASE `parcelles`;
USE `parcelles`;

CREATE TABLE IF NOT EXISTS `land` (
  `land_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `land_name` VARCHAR(255) NOT NULL,
  `land_description` VARCHAR(255) NOT NULL,
  `land_dimension` INT NOT NULL,
  `activities` VARCHAR(255) NOT NULL,
  `land_image` VARCHAR(255) NOT NULL

);