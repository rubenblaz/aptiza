-- MySQL Script generated by MySQL Workbench
-- 03/08/16 10:12:52
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema fcts2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema fcts2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `fcts2` DEFAULT CHARACTER SET utf8 ;
USE `fcts2` ;

-- -----------------------------------------------------
-- Table `fcts2`.`cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`cursos` (
  `IDCICLO` INT(10) NOT NULL AUTO_INCREMENT,
  `CICLO` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`IDCICLO`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`usuarios` (
  `EMAIL` VARCHAR(100) CHARACTER SET 'latin1' NOT NULL,
  `PASS` VARCHAR(100) CHARACTER SET 'latin1' NOT NULL,
  `NOMBRE` VARCHAR(20) CHARACTER SET 'latin1' NOT NULL,
  PRIMARY KEY (`EMAIL`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `fcts2`.`alumnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`alumnos` (
  `N_EXP` VARCHAR(100) NOT NULL,
  `EMAIL` VARCHAR(100) NOT NULL,
  `NOMBRE` VARCHAR(100) NOT NULL,
  `APELLIDOS` VARCHAR(100) NOT NULL,
  `CURSO` INT(100) NOT NULL,
  `CALIFICACION` VARCHAR(100) NULL DEFAULT NULL,
  `IDEMPRESA` VARCHAR(100) NULL DEFAULT NULL,
  `TELEFONO_M` VARCHAR(100) NULL DEFAULT NULL,
  `TELEFONO_F` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`EMAIL`),
  UNIQUE INDEX `N_EXP` (`N_EXP` ASC),
  INDEX `CURSO` (`CURSO` ASC),
  INDEX `IDEMPRESA` (`IDEMPRESA` ASC),
  CONSTRAINT `alumnos_ibfk_1`
    FOREIGN KEY (`CURSO`)
    REFERENCES `fcts2`.`cursos` (`IDCICLO`),
  CONSTRAINT `alumnos_ibfk_2`
    FOREIGN KEY (`EMAIL`)
    REFERENCES `fcts2`.`usuarios` (`EMAIL`)
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`modelo_encuesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`modelo_encuesta` (
  `IDMODELO` INT(10) NOT NULL AUTO_INCREMENT,
  `TIPO` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`IDMODELO`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`encuesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`encuesta` (
  `IDENCUESTA` INT(10) NOT NULL AUTO_INCREMENT,
  `IDUSUARIO` VARCHAR(100) NOT NULL,
  `IDCICLO` INT(10) NOT NULL,
  `IDMODELO` INT(10) NOT NULL,
  PRIMARY KEY (`IDENCUESTA`),
  INDEX `IDUSUARIO` (`IDUSUARIO` ASC),
  INDEX `IDCICLO` (`IDCICLO` ASC),
  INDEX `IDMODELO` (`IDMODELO` ASC),
  CONSTRAINT `encuesta_ibfk_2`
    FOREIGN KEY (`IDCICLO`)
    REFERENCES `fcts2`.`cursos` (`IDCICLO`),
  CONSTRAINT `encuesta_ibfk_3`
    FOREIGN KEY (`IDMODELO`)
    REFERENCES `fcts2`.`modelo_encuesta` (`IDMODELO`),
  CONSTRAINT `encuesta_ibfk_4`
    FOREIGN KEY (`IDUSUARIO`)
    REFERENCES `fcts2`.`usuarios` (`EMAIL`)
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`tipos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`tipos` (
  `IDT` INT(100) NOT NULL AUTO_INCREMENT,
  `TIPO` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`IDT`),
  UNIQUE INDEX `TIPO` (`TIPO` ASC),
  INDEX `TIPO_2` (`TIPO` ASC),
  INDEX `TIPO_3` (`TIPO` ASC),
  INDEX `IDT` (`IDT` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`modelo_pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`modelo_pregunta` (
  `IDPREGUNTA` INT(10) NOT NULL AUTO_INCREMENT,
  `TEXTO` VARCHAR(100) NOT NULL,
  `TIPO` INT(10) NULL DEFAULT NULL,
  PRIMARY KEY (`IDPREGUNTA`),
  INDEX `TIPO` (`TIPO` ASC),
  CONSTRAINT `modelo_pregunta_ibfk_1`
    FOREIGN KEY (`TIPO`)
    REFERENCES `fcts2`.`tipos` (`IDT`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`modelo_opcion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`modelo_opcion` (
  `IDOPCION` INT(10) NOT NULL AUTO_INCREMENT,
  `OPCION` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`IDOPCION`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`elige`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`elige` (
  `IDENCUESTA` INT(10) NOT NULL,
  `IDPREGUNTA` INT(10) NOT NULL,
  `IDOPCION` INT(10) NOT NULL,
  PRIMARY KEY (`IDENCUESTA`, `IDPREGUNTA`),
  INDEX `IDPREGUNTA` (`IDPREGUNTA` ASC),
  INDEX `IDOPCION` (`IDOPCION` ASC),
  CONSTRAINT `elige_ibfk_1`
    FOREIGN KEY (`IDENCUESTA`)
    REFERENCES `fcts2`.`encuesta` (`IDENCUESTA`),
  CONSTRAINT `elige_ibfk_2`
    FOREIGN KEY (`IDPREGUNTA`)
    REFERENCES `fcts2`.`modelo_pregunta` (`IDPREGUNTA`),
  CONSTRAINT `elige_ibfk_3`
    FOREIGN KEY (`IDOPCION`)
    REFERENCES `fcts2`.`modelo_opcion` (`IDOPCION`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`empresas` (
  `EMAIL` VARCHAR(100) NOT NULL,
  `CIF` VARCHAR(100) NOT NULL,
  `CONVENIO` VARCHAR(100) NOT NULL,
  `FECHA_DE_CONVENIO` DATE NOT NULL,
  `NOMBRE` VARCHAR(100) NOT NULL,
  `ALIAS` VARCHAR(100) NOT NULL,
  `DIRECCION` VARCHAR(100) NOT NULL,
  `CP` VARCHAR(100) NOT NULL,
  `POBLACION` VARCHAR(100) NOT NULL,
  `PROVINCIA` VARCHAR(100) NOT NULL,
  `TELEFONO` VARCHAR(100) NOT NULL,
  `FAX` VARCHAR(100) NULL DEFAULT NULL,
  `CONVENIO_REPRESENTANTE` VARCHAR(100) NOT NULL,
  `DNI_REPRESENTANTE` VARCHAR(100) NOT NULL,
  `OBSERVACIONES` LONGTEXT NULL DEFAULT NULL,
  `TIPO` VARCHAR(100) NULL DEFAULT NULL,
  `FAVORITA` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`EMAIL`),
  UNIQUE INDEX `ALIAS` (`ALIAS` ASC),
  UNIQUE INDEX `CIF` (`CIF` ASC),
  INDEX `ALIAS_2` (`ALIAS` ASC),
  CONSTRAINT `empresas_ibfk_1`
    FOREIGN KEY (`EMAIL`)
    REFERENCES `fcts2`.`usuarios` (`EMAIL`)
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`profesores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`profesores` (
  `EMAIL` VARCHAR(100) NOT NULL,
  `NOMBRE` VARCHAR(100) NOT NULL,
  `APELLIDOS` VARCHAR(100) NOT NULL,
  `ES_TUTOR` TINYINT(1) NULL DEFAULT NULL,
  `CURSO` INT(100) NULL DEFAULT NULL,
  `DNI` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`EMAIL`),
  UNIQUE INDEX `DNI` (`DNI` ASC),
  INDEX `CURSO` (`CURSO` ASC),
  INDEX `NOMBRE` (`NOMBRE` ASC),
  INDEX `CURSO_2` (`CURSO` ASC),
  CONSTRAINT `profesores_ibfk_1`
    FOREIGN KEY (`EMAIL`)
    REFERENCES `fcts2`.`usuarios` (`EMAIL`),
  CONSTRAINT `profesores_ibfk_2`
    FOREIGN KEY (`CURSO`)
    REFERENCES `fcts2`.`cursos` (`IDCICLO`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`roles` (
  `ID` INT(100) NOT NULL AUTO_INCREMENT,
  `TIPO` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`tiene`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`tiene` (
  `IDMENCUESTA` INT(10) NOT NULL AUTO_INCREMENT,
  `IDMPREGUNTA` INT(10) NOT NULL,
  PRIMARY KEY (`IDMENCUESTA`, `IDMPREGUNTA`),
  INDEX `IDMPREGUNTA` (`IDMPREGUNTA` ASC),
  CONSTRAINT `tiene_ibfk_1`
    FOREIGN KEY (`IDMENCUESTA`)
    REFERENCES `fcts2`.`modelo_encuesta` (`IDMODELO`),
  CONSTRAINT `tiene_ibfk_2`
    FOREIGN KEY (`IDMPREGUNTA`)
    REFERENCES `fcts2`.`modelo_pregunta` (`IDPREGUNTA`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`tiene_2`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`tiene_2` (
  `IDPREGUNTA` INT(10) NOT NULL,
  `IDOPCION` INT(10) NOT NULL,
  PRIMARY KEY (`IDPREGUNTA`, `IDOPCION`),
  INDEX `IDOPCION` (`IDOPCION` ASC),
  CONSTRAINT `tiene_2_ibfk_1`
    FOREIGN KEY (`IDPREGUNTA`)
    REFERENCES `fcts2`.`modelo_pregunta` (`IDPREGUNTA`),
  CONSTRAINT `tiene_2_ibfk_2`
    FOREIGN KEY (`IDOPCION`)
    REFERENCES `fcts2`.`modelo_opcion` (`IDOPCION`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fcts2`.`usuariosrol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fcts2`.`usuariosrol` (
  `EMAIL` VARCHAR(100) NOT NULL,
  `IDROL` INT(100) NOT NULL,
  PRIMARY KEY (`EMAIL`, `IDROL`),
  INDEX `IDROL` (`IDROL` ASC),
  CONSTRAINT `usuariosrol_ibfk_1`
    FOREIGN KEY (`EMAIL`)
    REFERENCES `fcts2`.`usuarios` (`EMAIL`)
    ON UPDATE CASCADE,
  CONSTRAINT `usuariosrol_ibfk_2`
    FOREIGN KEY (`IDROL`)
    REFERENCES `fcts2`.`roles` (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
