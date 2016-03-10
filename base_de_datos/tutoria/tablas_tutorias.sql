-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema tablas_tutorias
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tablas_tutorias
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tablas_tutorias` DEFAULT CHARACTER SET utf8 ;
USE `tablas_tutorias` ;

-- -----------------------------------------------------
-- Table `tablas_tutorias`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`roles` (
  `ID` INT(100) NOT NULL AUTO_INCREMENT,
  `Tipo` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`tut_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`tut_usuarios` (
  `usuario` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `password` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `rol` INT(100) NULL DEFAULT NULL,
  PRIMARY KEY (`usuario`),
  INDEX `rol` (`rol` ASC),
  CONSTRAINT `tut_usuarios_ibfk_2`
    FOREIGN KEY (`rol`)
    REFERENCES `tablas_tutorias`.`roles` (`ID`)
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`profesores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`profesores` (
  `DNI` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `nombre` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `usuario` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`DNI`),
  INDEX `usuario` (`usuario` ASC),
  CONSTRAINT `profesores_ibfk_2`
    FOREIGN KEY (`usuario`)
    REFERENCES `tablas_tutorias`.`tut_usuarios` (`usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`cursos` (
  `nombre` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `DNI_tutor` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`nombre`),
  INDEX `DNI_prof` (`DNI_tutor` ASC),
  CONSTRAINT `cursos_ibfk_1`
    FOREIGN KEY (`DNI_tutor`)
    REFERENCES `tablas_tutorias`.`profesores` (`DNI`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`alumnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`alumnos` (
  `N_EXP` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `usuario` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `nombre` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `curso` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `Fecha_nac` DATE NOT NULL,
  `aut_re` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`N_EXP`),
  INDEX `usuario` (`usuario` ASC),
  INDEX `curso` (`curso` ASC),
  CONSTRAINT `alumnos_ibfk_1`
    FOREIGN KEY (`usuario`)
    REFERENCES `tablas_tutorias`.`tut_usuarios` (`usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `alumnos_ibfk_2`
    FOREIGN KEY (`curso`)
    REFERENCES `tablas_tutorias`.`cursos` (`nombre`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`modulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`modulo` (
  `IDM` INT(10) NOT NULL AUTO_INCREMENT,
  `IDGR` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `nombre` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `DNI_prof` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`IDM`),
  INDEX `IDGR` (`IDGR` ASC),
  INDEX `DNI_prof` (`DNI_prof` ASC),
  INDEX `nombre` (`nombre` ASC),
  CONSTRAINT `modulo_ibfk_1`
    FOREIGN KEY (`IDGR`)
    REFERENCES `tablas_tutorias`.`cursos` (`nombre`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `modulo_ibfk_2`
    FOREIGN KEY (`DNI_prof`)
    REFERENCES `tablas_tutorias`.`profesores` (`DNI`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`tut_aut`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`tut_aut` (
  `IDAut` INT(100) NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `IDC` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `facilitar_info` TINYINT(1) NOT NULL DEFAULT '0',
  `actividades` TINYINT(1) NOT NULL DEFAULT '0',
  `circustancias` VARCHAR(500) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`IDAut`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`tut_encuestas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`tut_encuestas` (
  `IDE` INT(10) NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`IDE`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`tut_tipo_op`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`tut_tipo_op` (
  `tipo` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`tipo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`tut_opciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`tut_opciones` (
  `IDO` INT(10) NOT NULL AUTO_INCREMENT,
  `opcion` VARCHAR(500) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `tipo` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  PRIMARY KEY (`IDO`),
  INDEX `tipo` (`tipo` ASC),
  CONSTRAINT `tut_opciones_ibfk_2`
    FOREIGN KEY (`tipo`)
    REFERENCES `tablas_tutorias`.`tut_tipo_op` (`tipo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 27
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`tut_preguntas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`tut_preguntas` (
  `IDP` INT(10) NOT NULL AUTO_INCREMENT,
  `IDE` INT(10) NOT NULL,
  `nombre` VARCHAR(300) CHARACTER SET 'utf8' NOT NULL,
  `tipo` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`IDP`),
  INDEX `IDE` (`IDE` ASC),
  INDEX `tipo` (`tipo` ASC),
  CONSTRAINT `tut_preguntas_ibfk_1`
    FOREIGN KEY (`IDE`)
    REFERENCES `tablas_tutorias`.`tut_encuestas` (`IDE`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `tut_preguntas_ibfk_2`
    FOREIGN KEY (`tipo`)
    REFERENCES `tablas_tutorias`.`tut_tipo_op` (`tipo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 67
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`tut_respuestas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`tut_respuestas` (
  `IDR` INT(255) NOT NULL AUTO_INCREMENT,
  `IDE` INT(10) NOT NULL,
  `IDP` INT(100) NOT NULL,
  `puntuacion` INT(1) NULL DEFAULT NULL,
  `fecha` DATE NOT NULL,
  `usuario` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `Bien` VARCHAR(500) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `Mejorar` VARCHAR(500) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`IDR`),
  INDEX `IDE` (`IDE` ASC),
  INDEX `IDP` (`IDP` ASC),
  INDEX `IDO` (`puntuacion` ASC),
  INDEX `usuario` (`usuario` ASC),
  CONSTRAINT `tut_respuestas_ibfk_2`
    FOREIGN KEY (`IDE`)
    REFERENCES `tablas_tutorias`.`tut_encuestas` (`IDE`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `tut_respuestas_ibfk_3`
    FOREIGN KEY (`IDP`)
    REFERENCES `tablas_tutorias`.`tut_preguntas` (`IDP`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `tut_respuestas_ibfk_4`
    FOREIGN KEY (`usuario`)
    REFERENCES `tablas_tutorias`.`tut_usuarios` (`usuario`)
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 34
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`tut_respuestasea`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`tut_respuestasea` (
  `IDR` INT(255) NOT NULL AUTO_INCREMENT,
  `IDE` INT(100) NOT NULL,
  `IDP` INT(100) NOT NULL,
  `puntuacion` INT(1) NULL DEFAULT NULL,
  `IDM` INT(100) NOT NULL,
  `bien` VARCHAR(500) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `mejorar` VARCHAR(500) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `fecha` DATE NOT NULL,
  `usuario` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  PRIMARY KEY (`IDR`),
  INDEX `IDE` (`IDE` ASC),
  INDEX `IDP` (`IDP` ASC),
  INDEX `IDO` (`puntuacion` ASC),
  INDEX `usuario` (`usuario` ASC),
  INDEX `modulo` (`IDM` ASC),
  CONSTRAINT `tut_respuestasea_ibfk_1`
    FOREIGN KEY (`IDP`)
    REFERENCES `tablas_tutorias`.`tut_preguntas` (`IDP`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `tut_respuestasea_ibfk_3`
    FOREIGN KEY (`IDE`)
    REFERENCES `tablas_tutorias`.`tut_encuestas` (`IDE`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `tut_respuestasea_ibfk_5`
    FOREIGN KEY (`IDM`)
    REFERENCES `tablas_tutorias`.`modulo` (`IDM`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `tut_respuestasea_ibfk_6`
    FOREIGN KEY (`usuario`)
    REFERENCES `tablas_tutorias`.`tut_usuarios` (`usuario`)
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 43
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `tablas_tutorias`.`tut_usuarios_enc`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tablas_tutorias`.`tut_usuarios_enc` (
  `usuario` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `Curso` VARCHAR(100) CHARACTER SET 'utf8' NOT NULL,
  `en_ac` TINYINT(1) NOT NULL DEFAULT '0',
  `en_ea` TINYINT(1) NULL DEFAULT '0',
  PRIMARY KEY (`usuario`),
  INDEX `Curso` (`Curso` ASC),
  CONSTRAINT `tut_usuarios_enc_ibfk_1`
    FOREIGN KEY (`usuario`)
    REFERENCES `tablas_tutorias`.`tut_usuarios` (`usuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `tut_usuarios_enc_ibfk_2`
    FOREIGN KEY (`Curso`)
    REFERENCES `tablas_tutorias`.`cursos` (`nombre`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
