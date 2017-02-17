
DROP DATABASE IF EXISTS ems;

CREATE DATABASE ems;

/*CREATE USER 'emsuser'@'localhost' IDENTIFIED BY 'emspass';*/

GRANT ALL PRIVILEGES ON ems.* TO emsuser@'localhost' IDENTIFIED BY 'emspass';

USE ems;

-- -----------------------------------------------------
-- Table USERS
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `username` VARCHAR(128),
    `name` VARCHAR(128),
    `surname` VARCHAR(128),
    `password` VARCHAR(128),
    `email` VARCHAR(128),
    `role` ENUM ('Admin_ORI', 'Admin_SEC', 'Coordinador', 'Alumno') DEFAULT 'Alumno',
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `modified` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `status` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- INSERTS `USERS`
-- -----------------------------------------------------

INSERT INTO `users` (`id`, `username`, `name`, `surname`, `password`, `email`, `role`, `created`, `modified`, `status`) VALUES
('1', 'rgcarrera', 'Ramon ', 'Gago Carrera', '3583a9864279f442056d6aee66aa147ed8c8284e', 'rgcarrera@gmail.com', 'Admin_ORI', NOW(), NOW(), '1'),
('2', 'agrodriguez', 'Alma', 'Gómez Rodríguez', '3583a9864279f442056d6aee66aa147ed8c8284e', 'agrodriguez@gmail.com', 'Coordinador', NOW(), NOW(), '1'),
('3', 'arsampayo', 'Alturo', 'Rodriguez Sampayo', '3583a9864279f442056d6aee66aa147ed8c8284e', 'arsampayo@gmail.com', 'Admin_SEC', NOW(), NOW(), '1'),
('4', 'jrmartina', 'Joshua', 'Rodriguez Martiña', '3583a9864279f442056d6aee66aa147ed8c8284e', 'jrmartina@gmail.com', 'Alumno', NOW(), NOW(), '1');



