-- MySQL Script generated by MySQL Workbench
-- Wed Jun 12 23:08:55 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema citaDOP
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema citaDOP
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `citaDOP` DEFAULT CHARACTER SET utf8 ;
USE `citaDOP` ;

-- -----------------------------------------------------
-- Table `citaDOP`.`Urgencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Urgencia` (
  `idUrgencia` INT NOT NULL AUTO_INCREMENT,
  `urgencia` INT NOT NULL,
  PRIMARY KEY (`idUrgencia`),
  UNIQUE INDEX `Urgenciacol_UNIQUE` (`urgencia` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Horario` (
  `idHorario` INT NOT NULL AUTO_INCREMENT,
  `horario` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idHorario`),
  UNIQUE INDEX `HoraEntrada_idHoraEntrada_UNIQUE` (`horario` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Persona` (
  `idPersona` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `primerApellido` VARCHAR(45) NOT NULL,
  `segundoApellido` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  `usuario` VARCHAR(45) NOT NULL,
  `contrasenia` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPersona`),
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC),
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC),
  UNIQUE INDEX `contrasenia_UNIQUE` (`contrasenia` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Sexo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Sexo` (
  `idSexo` INT NOT NULL AUTO_INCREMENT,
  `sexo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idSexo`),
  UNIQUE INDEX `Sexocol_UNIQUE` (`sexo` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Carrera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Carrera` (
  `idCarrera` INT NOT NULL AUTO_INCREMENT,
  `carrera` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCarrera`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Estudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Estudiante` (
  `idEstudiante` INT NOT NULL AUTO_INCREMENT,
  `carnet` VARCHAR(45) NOT NULL,
  `fechaNacimiento` DATETIME NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `Persona_idPersona` INT NOT NULL,
  `Sexo_idSexo` INT NOT NULL,
  `Carrera_idCarrera` INT NOT NULL,
  PRIMARY KEY (`idEstudiante`),
  UNIQUE INDEX `Carnet_UNIQUE` (`carnet` ASC),
  INDEX `fk_Estudiante_Usuario1_idx` (`Persona_idPersona` ASC),
  INDEX `fk_Estudiante_Sexo1_idx` (`Sexo_idSexo` ASC),
  INDEX `fk_Estudiante_Carrera1_idx` (`Carrera_idCarrera` ASC),
  CONSTRAINT `fk_Estudiante_Usuario1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `citaDOP`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estudiante_Sexo1`
    FOREIGN KEY (`Sexo_idSexo`)
    REFERENCES `citaDOP`.`Sexo` (`idSexo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estudiante_Carrera1`
    FOREIGN KEY (`Carrera_idCarrera`)
    REFERENCES `citaDOP`.`Carrera` (`idCarrera`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Psicologa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Psicologa` (
  `idPsicologa` INT NOT NULL AUTO_INCREMENT,
  `Persona_idPersona` INT NOT NULL,
  PRIMARY KEY (`idPsicologa`),
  INDEX `fk_Psicologa_Usuario1_idx` (`Persona_idPersona` ASC),
  CONSTRAINT `fk_Psicologa_Usuario1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `citaDOP`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Referencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Referencia` (
  `idReferencia` INT NOT NULL AUTO_INCREMENT,
  `referencia` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idReferencia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Nivel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Nivel` (
  `idNivel` INT NOT NULL AUTO_INCREMENT,
  `nivel` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idNivel`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Cita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Cita` (
  `idCita` INT NOT NULL AUTO_INCREMENT,
  `cantidadCursos` INT NOT NULL,
  `cantidadCreditos` INT NOT NULL,
  `fecha` DATETIME NOT NULL,
  `ausencia` INT NOT NULL DEFAULT 1,
  `observacion` VARCHAR(500) NULL,
  `Urgencia_idUrgencia` INT NOT NULL,
  `Horario_idHorario` INT NOT NULL,
  `Estudiante_idEstudiante` INT NOT NULL,
  `Psicologa_idPsicologa` INT NOT NULL,
  `Nivel_idNivel` INT NOT NULL,
  `Referencia_idReferencia` INT NULL,
  PRIMARY KEY (`idCita`),
  INDEX `fk_Cita_Urgencia1_idx` (`Urgencia_idUrgencia` ASC),
  INDEX `fk_Cita_Horario1_idx` (`Horario_idHorario` ASC),
  INDEX `fk_Cita_Estudiante1_idx` (`Estudiante_idEstudiante` ASC),
  INDEX `fk_Cita_Psicologa1_idx` (`Psicologa_idPsicologa` ASC),
  INDEX `fk_Cita_Referencia1_idx` (`Referencia_idReferencia` ASC),
  INDEX `fk_Cita_Nivel1_idx` (`Nivel_idNivel` ASC),
  CONSTRAINT `fk_Cita_Urgencia1`
    FOREIGN KEY (`Urgencia_idUrgencia`)
    REFERENCES `citaDOP`.`Urgencia` (`idUrgencia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cita_Horario1`
    FOREIGN KEY (`Horario_idHorario`)
    REFERENCES `citaDOP`.`Horario` (`idHorario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cita_Estudiante1`
    FOREIGN KEY (`Estudiante_idEstudiante`)
    REFERENCES `citaDOP`.`Estudiante` (`idEstudiante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cita_Psicologa1`
    FOREIGN KEY (`Psicologa_idPsicologa`)
    REFERENCES `citaDOP`.`Psicologa` (`idPsicologa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cita_Referencia1`
    FOREIGN KEY (`Referencia_idReferencia`)
    REFERENCES `citaDOP`.`Referencia` (`idReferencia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cita_Nivel1`
    FOREIGN KEY (`Nivel_idNivel`)
    REFERENCES `citaDOP`.`Nivel` (`idNivel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Motivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Motivo` (
  `idMotivo` INT NOT NULL AUTO_INCREMENT,
  `motivo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idMotivo`),
  UNIQUE INDEX `Motivocol_UNIQUE` (`motivo` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Cita_has_Motivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Cita_has_Motivo` (
  `idCita_has_Motivo` INT NOT NULL AUTO_INCREMENT,
  `Cita_idCita` INT NOT NULL,
  `Motivo_idMotivo` INT NOT NULL,
  INDEX `fk_Cita_has_Motivo_Motivo1_idx` (`Motivo_idMotivo` ASC),
  INDEX `fk_Cita_has_Motivo_Cita1_idx` (`Cita_idCita` ASC),
  PRIMARY KEY (`idCita_has_Motivo`),
  CONSTRAINT `fk_Cita_has_Motivo_Cita1`
    FOREIGN KEY (`Cita_idCita`)
    REFERENCES `citaDOP`.`Cita` (`idCita`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cita_has_Motivo_Motivo1`
    FOREIGN KEY (`Motivo_idMotivo`)
    REFERENCES `citaDOP`.`Motivo` (`idMotivo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`DiasSemana`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`DiasSemana` (
  `idDiasSemana` INT NOT NULL AUTO_INCREMENT,
  `diaSemana` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idDiasSemana`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `citaDOP`.`Plantilla`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `citaDOP`.`Plantilla` (
  `idPlantilla` INT NOT NULL AUTO_INCREMENT,
  `DiasSemana_idDiasSemana` INT NOT NULL,
  `Horario_idHorario` INT NOT NULL,
  `Psicologa_idPsicologa` INT NOT NULL,
  PRIMARY KEY (`idPlantilla`),
  INDEX `fk_Plantilla_DiasSemana1_idx` (`DiasSemana_idDiasSemana` ASC),
  INDEX `fk_Plantilla_Horario1_idx` (`Horario_idHorario` ASC),
  INDEX `fk_Plantilla_Psicologa1_idx` (`Psicologa_idPsicologa` ASC),
  CONSTRAINT `fk_Plantilla_DiasSemana1`
    FOREIGN KEY (`DiasSemana_idDiasSemana`)
    REFERENCES `citaDOP`.`DiasSemana` (`idDiasSemana`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Plantilla_Horario1`
    FOREIGN KEY (`Horario_idHorario`)
    REFERENCES `citaDOP`.`Horario` (`idHorario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Plantilla_Psicologa1`
    FOREIGN KEY (`Psicologa_idPsicologa`)
    REFERENCES `citaDOP`.`Psicologa` (`idPsicologa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
