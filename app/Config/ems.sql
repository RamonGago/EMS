
DROP DATABASE IF EXISTS ems;

CREATE DATABASE ems;

/*CREATE USER 'emsuser'@'localhost' IDENTIFIED BY 'emspass';*/

GRANT ALL PRIVILEGES ON ems.* TO emsuser@'localhost' IDENTIFIED BY 'emspass';

USE ems;

-- -----------------------------------------------------
-- Table USERS (USUARIOS): OBLIGATORIO email @alumnos.uvigo.es
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED AUTO_INCREMENT ,
    `username` VARCHAR(50),
    `name` VARCHAR(50),
    `surname` VARCHAR(50),
    `dni` VARCHAR(12),
    `address` VARCHAR(128),
    `phone` INT(15),
    `birthdate` DATE,
    `faculty` VARCHAR(50) DEFAULT NULL,
    `course` INT(2) DEFAULT NULL,
    `email` VARCHAR(50),
    `password` VARCHAR(50),
    `role` ENUM ('Admin_ORI', 'Admin_SEC', 'Coordinador', 'Alumno') DEFAULT 'Alumno',
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `modified` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `status` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table DESTINATIONS (DESTINOS)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `destinations`;

CREATE TABLE IF NOT EXISTS `destinations` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `country` VARCHAR(128),
    `university` VARCHAR(128),
    `description` VARCHAR(128),
    `places` INT(2),
    `duration` INT(2),
    `contact_person` VARCHAR(128),
    `destination_requirements` VARCHAR(128),
    `origin_requirements` VARCHAR(128),
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table PLACES (PLAZAS)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `places`;

CREATE TABLE IF NOT EXISTS `places` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `user_id` INT UNSIGNED,
  `destination_id` INT UNSIGNED,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- -----------------------------------------------------
-- Table LEARNING_AGREEMENTS (CONTRATOS DE ESTUDIO)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `learning_agreements`;

CREATE TABLE IF NOT EXISTS `learning_agreements` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `destination_subjects` VARCHAR(128),
    `origin_subjects` VARCHAR(128),
    `duration` INT(2),
    `contact_person` VARCHAR(128),
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `modified` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `user_id` INT UNSIGNED,
    `place_id` INT  UNSIGNED,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table EXTENSION_REQUESTS (AMPLIACIONES)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `extension_requests`;

CREATE TABLE IF NOT EXISTS `extension_requests` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `description` VARCHAR(128),
    `months` INT(2),
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `modified` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `user_id` INT UNSIGNED,
    `place_id` INT UNSIGNED,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table RESIGNATIONS (RENUNCIAS)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resignations`;

CREATE TABLE IF NOT EXISTS `resignations` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `description` VARCHAR(128),
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `modified` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `user_id` INT UNSIGNED,
    `place_id` INT UNSIGNED,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table DOCUMENTS (DOCUMENTOS)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `documents`;

CREATE TABLE IF NOT EXISTS `documents` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `type` ENUM ('Aceptación de plaza', 'Contrato financiero', 'Ficha de perceptores', 'Aceptación uso de datos', 'Contrato seguro On Campus', 'Contrato de estudios', 'Modificación contrato de estudios', 'Certificado de llegada', 'Ampliación de estancia', 'Renuncia de plaza', 'Certificado de fin de estancia') DEFAULT NULL,
    `description` VARCHAR(128) DEFAULT NULL,
    `file` VARCHAR(255) DEFAULT NULL,
    `file_dir` VARCHAR(255) DEFAULT NULL,
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `modified` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `user_id` INT UNSIGNED,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table SCHOOL_YEARS (AÑOS ACADÉMICOS)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `school_years`;

CREATE TABLE IF NOT EXISTS `school_years` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `date` VARCHAR(128),
    `description` VARCHAR(128),
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table DEADLINES (PLAZOS)
-- -----------------------------------------------------
DROP TABLE IF EXISTS `deadlines`;

CREATE TABLE IF NOT EXISTS `deadlines` (
    `id` INT UNSIGNED AUTO_INCREMENT,
    `name` VARCHAR(128),
    `description` VARCHAR(128),
    `type` ENUM ('10 días', '15 días', '20 días', '1 mes', '2 meses', '3 meses', '6 meses', '10 meses') DEFAULT '1 mes',
    `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `modified` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `document_id` INT UNSIGNED DEFAULT NULL,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- -----------------------------------------------------
-- FOREIGN KEYS
-- -----------------------------------------------------

/* TABLE PLACES*/

ALTER TABLE places
    ADD FOREIGN KEY (user_id)
REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    ADD FOREIGN KEY (destination_id)
REFERENCES destinations (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;


/* TABLE LEARNING_AGREEMENTS*/

ALTER TABLE learning_agreements
    ADD FOREIGN KEY (user_id)
REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    ADD FOREIGN KEY (place_id)
REFERENCES places (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;


/* TABLE EXTENSION_REQUESTS*/

ALTER TABLE extension_requests
    ADD FOREIGN KEY (user_id)
REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    ADD FOREIGN KEY (place_id)
REFERENCES places (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;


/* TABLE RESIGNATIONS*/

ALTER TABLE resignations
    ADD FOREIGN KEY (user_id)
REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    ADD FOREIGN KEY (place_id)
REFERENCES places (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;


/* TABLE DOCUMENTS*/

ALTER TABLE documents
    ADD FOREIGN KEY (user_id)
REFERENCES users (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;


/* TABLE PERIODS*/

ALTER TABLE deadlines
   ADD FOREIGN KEY (document_id)
REFERENCES documents (id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;


-- -----------------------------------------------------
-- INSERTS `USERS`
-- -----------------------------------------------------

INSERT INTO `users` (`id`, `username`, `name`, `surname`, `dni`, `address`, `phone`, `birthdate`,`faculty`, `course`, `email`, `password`, `role`, `created`, `modified`, `status`) VALUES
('1', 'rgcarrera', 'Ramon', 'Gago Carrera', '53613886N', 'Avda. Buenos Aires nº24 3º 32003', '652354782', '1990-07-07', 'ESEI', NULL,'rgcarrera@gmail.com', '3583a9864279f442056d6aee66aa147ed8c8284e',  'Admin_ORI', NOW(), NOW(), '1'),
('2', 'agrodriguez', 'Alma', 'Gómez Rodríguez', '77548923J', 'Calle Celso Emilio Ferreiro nº2 1ºE 32004', '641896572', '1969-11-25', 'ESEI', NULL, 'agrodriguez@gmail.com', '3583a9864279f442056d6aee66aa147ed8c8284e', 'Coordinador', NOW(), NOW(), '1'),
('3', 'arsampayo', 'Alturo', 'Rodriguez Sampayo', '68315282L', 'Avda. Habana nº45 7º 32002', '632985412', '1960-04-14','ESEI', NULL, 'arsampayo@gmail.com', '3583a9864279f442056d6aee66aa147ed8c8284e', 'Admin_SEC', NOW(), NOW(), '1'),
('4', 'jrmartina', 'Joshua', 'Rodriguez Martiña', '11543374D', 'Calle Santo Domingo nº15 4º 32005', '689523140', '1993-10-1','ESEI', '4','jrmartina@gmail.com', '3583a9864279f442056d6aee66aa147ed8c8284e', 'Alumno', NOW(), NOW(), '1'),
('5', 'drbarros', 'Domingo', 'Rivera Barros', '60521487P', 'Calle Erverdelo Nº123 3ºA', '635896547', '1994-11-23','ESEI', '3','drbarros@gmail.com', '3583a9864279f442056d6aee66aa147ed8c8284e', 'Alumno', NOW(), NOW(), '1'),
('6', 'jrrodriguez', 'Jose Manuel', 'Rodriguez Rodriguez', '15498654B','Avda. de Marín Nº54 2ºC', '632326589', '1991-1-10','ESEI', '3','jrrodriguez@gmail.com', '3583a9864279f442056d6aee66aa147ed8c8284e', 'Alumno', NOW(), NOW(), '1'),
('7', 'asdiaz', 'Ana Isabel', 'Suárez Díaz', '539611718V','Calle Nogueira de Ramuín nº1 4º', '645892103', '1995-05-16','ESEI', '4','asdiaz@gmail.com', '3583a9864279f442056d6aee66aa147ed8c8284e', 'Alumno', NOW(), NOW(), '1');

-- -----------------------------------------------------
-- INSERTS `DESTINATIONS`
-- -----------------------------------------------------

INSERT INTO `destinations` (`id`, `country`, `university`, `description`, `places`, `duration`, `contact_person`,`destination_requirements`, `origin_requirements`) VALUES
  ('1', 'Alemania', 'Universität Kassel', 'Universidad pública situada en el estado federado de Hesse', '3', '6', 'Derek Richter', 'B1 Alemán', 'Ninguno'),
  ('2', 'Francia', 'Université de Nantes', 'Universidad pública situada en  Loire-Atlantique', '1', '6', 'Louis Leblanc', 'B1 Francés', 'Ninguno'),
  ('3', 'Italia', 'Universitá degli Studi di Catania', ' Es la Universidad más antigua de Sicilia y la 13º en Italia con aproximadamente 62.000 estudiantes', '2', '6', 'Giuseppe Barbanera', 'Ninguno', 'Ninguno'),
  ('4', 'Polonia', 'Bialystok University of Technology', 'Universidad pública polaca', '2', '10', 'Aleska Rosenstock', 'Ninguno', 'Ninguno');


-- -----------------------------------------------------
-- Table PLACES (PLAZAS)
-- -----------------------------------------------------

INSERT INTO `places` (`id`, `user_id`, `destination_id`) VALUES
  ('1', '4', '1'),
  ('2', '6', '1'),
  ('3', '7', '2'),
  ('4', '5', '4');


-- -----------------------------------------------------
-- INSERTS `LEARNING_AGREEMENTS`
-- -----------------------------------------------------

INSERT INTO `learning_agreements` (`id`, `destination_subjects`, `origin_subjects`, `duration`, `contact_person`, `created`, `modified`,`user_id`, `place_id`) VALUES
  ('1', 'A01, A08, A12, A17, A18', 'G150501, G150502, G150503, G150504, G150503 ', '6', 'Derek Richter', NOW(), NOW(), '4', '1'),
  ('2', 'A02, A03, A13, A17, A20', 'G150969, G150970, G150503, G150405, G150506 ', '6', 'Derek Richter', NOW(), NOW(), '6', '2'),
  ('3', 'F01, F05, F10, F11, F12', 'G150501, G150405, G150968, G150502, G150602 ', '6', 'Louis Leblanc', NOW(), NOW(), '7', '3'),
  ('4', 'P06, P09, P13, P15, P16, P21, P25, P26, P27, P30', 'G150505, G150302, G150606, G150504, G150503, G150505, G150506, G150605, G150970, G150969 ', '10', 'Aleska Rosenstock', NOW(), NOW(), '5', '4');

-- -----------------------------------------------------
-- INSERTS `EXTENSION_REQUESTS`
-- -----------------------------------------------------

INSERT INTO `extension_requests` (`id`, `description`, `months`, `created`, `modified`, `user_id`, `place_id`) VALUES
  ('1', 'Ampliación de estancia', '4', NOW(), NOW(), '4', '1'),
  ('2', 'Ampliación de estancia', '4', NOW(), NOW(), '7', '3');

-- -----------------------------------------------------
-- INSERTS `RESIGNATIONS`
-- -----------------------------------------------------

INSERT INTO `resignations` (`id`, `description`, `created`, `modified`, `user_id`, `place_id`) VALUES
  ('1', 'Renuncia de plaza por motivos personales', NOW(), NOW(), '6', '2');


-- -----------------------------------------------------
-- INSERTS `DOCUMENTS`
-- -----------------------------------------------------
/* PROBLEMA: A la hora de poner los plazos recibe el document_id pero este pertenece a un user_id, se le borraría este último?*/

INSERT INTO `documents` (`id`,`type`, `file`, `file_dir`, `created`, `modified`,`user_id`) VALUES
  ('1', 'Petición plaza erasmus', 'plaza_erasmus.pdf', '1', NOW(), NOW(),'4'),
  ('2', 'Petición destinos erasmus', 'destinos_erasmus.pdf', '2', NOW(), NOW(),'4'),
  ('3', 'Aceptación o renuncia de plaza asignada', 'aceptacion_erasmus.pdf', '3', NOW(), NOW(),'4'),
  ('4', 'Contrato financiero', 'datos_financieros.pdf', '4', NOW(), NOW(),'4'),
  ('5', 'Ficha de perceptores', 'ficha_perceptores.pdf', '5', NOW(), NOW(),'4'),
  ('6', 'Autorización uso de datos', 'autorización_uso_datos.pdf', '6', NOW(), NOW(),'4'),
  ('7', 'Contrato seguro On Campus', 'seguro_on_campus.pdf', '7', NOW(), NOW(),'4'),
  ('8', 'Contrato de estudios', 'contrato_estudios.pdf', '8', NOW(), NOW(), '4'),
  ('9', 'Modificación contrato de estudios', 'modificación_contrato_estudios.pdf', '9', NOW(), NOW(), '4'),
  ('10', 'Certificado de llegada', 'certificado_llegada.pdf', '10', NOW(), NOW(),'4'),
  ('11', 'Ampliación de estancia', 'ampliacion_estancia.pdf', '11', NOW(), NOW(), '4'),
  ('12', 'Renuncia de plaza', 'renuncia_plaza.pdf', '12', NOW(), NOW(), '6'),
  ('13', 'Certificado de fin de estancia', 'certificado_fin_estancia.pdf', '13', NOW(), NOW(), NULL);


-- -----------------------------------------------------
-- INSERTS `SCHOOL_YEARS`
-- -----------------------------------------------------

INSERT INTO `school_years` (`id`, `date`, `description`) VALUES
  ('1', '2016-2017', 'Año académico Erasmus +'),
  ('2', '2017-2018', 'Año académico Erasmus +');

-- -----------------------------------------------------
-- INSERTS `PERIODS`
-- -----------------------------------------------------

/* No tiene sentido asociar un document_id...*/
/*NO SE HACER LOS PLAZOS*/

INSERT INTO `deadlines` (`id`, `name`, `description`,`type`, `created`, `modified`,`document_id`) VALUES
  ('1', 'Plazo de solicitud de plaza erasmus', 'El plazo expirará dentro de un mes contando a partir del siguiente día laboral tras la publicación', '1 mes', NOW(), NOW(), '1'),
  ('2', 'Plazo de solicitud de destino erasmus', 'El plazo expirará dentro de 15 días contando a partir del siguiente día laboral tras la publicación', '15 días', NOW(), NOW(), '2'),
  ('3', 'Plazo de entrega de la aceptación o renuncia de plaza erasmus', 'El plazo expirará dentro de un mes contando a partir del siguiente día laboral tras la publicación', '1 mes', NOW(), NOW(), '3'),
  ('4', 'Plazo de entrega del contrato finaciero', 'El plazo expirará dentro de un mes contando a partir del siguiente día laboral tras la publicación', '1 mes', NOW(), NOW(), '4'),
  ('5', 'Plazo de entrega de la ficha de perceptores', 'El plazo expirará dentro de un mes contando a partir del siguiente día laboral tras la publicación', '1 mes', NOW(), NOW(), '5'),
  ('6', 'Plazo de entrega de la autorización del uso de datos', 'El plazo expirará dentro de un mes contando a partir del siguiente día laboral tras la publicación', '1 mes', NOW(), NOW(), '6'),
  ('7', 'Plazo de entrega del contrato del seguro On Campus', 'El plazo expirará dentro de un mes contando a partir del siguiente día laboral tras la publicación', '1 mes', NOW(), NOW(), '7'),
  ('8', 'Plazo de entrega del contrato de estudios', 'El plazo expirará dentro de un mes contando a partir del siguiente día laboral tras la publicación', '1 mes', NOW(), NOW(), '8'),
  ('9', 'Plazo de modificación del contrato de estudios', 'El plazo expirará dentro de un mes contando a partir del siguiente día laboral tras la publicación', '1 mes', NOW(), NOW(), '9'),
  ('10', 'Plazo de entrega del certificado de llegada', 'El plazo expirará dentro de un mes contando a partir del siguiente día laboral tras la publicación', '1 mes', NOW(), NOW(), '10'),
  ('11', 'Plazo de petición de amplicación de estancia', 'El plazo expirará dentro de 6 meses  contando a partir del siguiente día laboral tras la publicación', '6 meses', NOW(), NOW(), '11'),
  ('12', 'Plazo de petición de renuncia de plaza erasmus', 'El plazo expirará dentro de 10 meses contando a partir del siguiente día laboral tras la publicación', '10 meses', NOW(), NOW(), '12'),
  ('13', 'Plazo de entrega del certificado de fin de estancia', 'El plazo expirará dentro de un mes contando a partir del siguiente día laboral tras la publicación', '1 mes', NOW(), NOW(), '13');
