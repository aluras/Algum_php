-- MySQL Script generated by MySQL Workbench
-- 07/15/16 08:10:13
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema algum_v0
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema algum_v0
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `algum_v0` DEFAULT CHARACTER SET utf8 ;
USE `algum_v0` ;

-- -----------------------------------------------------
-- Table `algum_v0`.`tipo_contas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `algum_v0`.`tipo_contas` ;

CREATE TABLE IF NOT EXISTS `algum_v0`.`tipo_contas` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  `created` DATETIME NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `algum_v0`.`contas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `algum_v0`.`contas` ;

CREATE TABLE IF NOT EXISTS `algum_v0`.`contas` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  `saldo_inicial` DECIMAL(10,2) NOT NULL,
  `saldo` DECIMAL(10,2) NOT NULL,
  `tipo_conta_id` INT(10) UNSIGNED NOT NULL,
  `created` DATETIME NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_contas_tipo_conta1_idx` (`tipo_conta_id` ASC),
  CONSTRAINT `fk_contas_tipo_conta`
    FOREIGN KEY (`tipo_conta_id`)
    REFERENCES `algum_v0`.`tipo_contas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `algum_v0`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `algum_v0`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `algum_v0`.`usuarios` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  `created` DATETIME NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `algum_v0`.`conta_usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `algum_v0`.`conta_usuarios` ;

CREATE TABLE IF NOT EXISTS `algum_v0`.`conta_usuarios` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `conta_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `usuario_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `created` DATETIME NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_contas_usuarios_contas_idx` (`conta_id` ASC),
  INDEX `fk_contas_usuarios_usuarios_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_contas_usuarios_contas`
    FOREIGN KEY (`conta_id`)
    REFERENCES `algum_v0`.`contas` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contas_usuarios_usuarios`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `algum_v0`.`usuarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `algum_v0`.`contas_padrao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `algum_v0`.`contas_padrao` ;

CREATE TABLE IF NOT EXISTS `algum_v0`.`contas_padrao` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) CHARACTER SET 'latin1' NOT NULL,
  `tipo_conta_id` INT(10) UNSIGNED NOT NULL,
  `created` DATETIME NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_contas_padrao_tipo_conta1_idx` (`tipo_conta_id` ASC),
  CONSTRAINT `fk_contas_padrao_tipo_conta`
    FOREIGN KEY (`tipo_conta_id`)
    REFERENCES `algum_v0`.`tipo_contas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `algum_v0`.`tipo_grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `algum_v0`.`tipo_grupo` ;

CREATE TABLE IF NOT EXISTS `algum_v0`.`tipo_grupo` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `created` DATETIME NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `algum_v0`.`grupo_usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `algum_v0`.`grupo_usuarios` ;

CREATE TABLE IF NOT EXISTS `algum_v0`.`grupo_usuarios` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `id_tipo_grupo` INT(10) UNSIGNED NULL DEFAULT NULL,
  `id_usuario` INT(10) UNSIGNED NULL DEFAULT NULL,
  `created` DATETIME NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_grupo_usuario_tipo_grupo_idx` (`id_tipo_grupo` ASC),
  INDEX `fk_grupo_usuario_usuario_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_grupo_usuario_tipo_grupo`
    FOREIGN KEY (`id_tipo_grupo`)
    REFERENCES `algum_v0`.`tipo_grupo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupo_usuario_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `algum_v0`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `algum_v0`.`grupos_padrao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `algum_v0`.`grupos_padrao` ;

CREATE TABLE IF NOT EXISTS `algum_v0`.`grupos_padrao` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) CHARACTER SET 'latin1' NOT NULL,
  `id_tipo_grupo` INT(10) UNSIGNED NULL DEFAULT NULL,
  `created` DATETIME NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_grupo_tipo_grupo_idx` (`id_tipo_grupo` ASC),
  CONSTRAINT `fk_grupo_tipo_grupo`
    FOREIGN KEY (`id_tipo_grupo`)
    REFERENCES `algum_v0`.`tipo_grupo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;