CREATE TABLE `land` (
  `land_id` INT(30) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `land_title` VARCHAR(200) NOT NULL,
  `land_dimension` VARCHAR(200) NOT NULL,
  `land_description` VARCHAR(255) NOT NULL,
  `code` TEXT NOT NULL,
  `land_type` TINYINT(1) NOT NULL DEFAULT 2 COMMENT '1 = Parcelle, 2 = Bassin',
  `avatar` TEXT NOT NULL DEFAULT 'no-image-available.png',
  `date_created` DATETIME NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;