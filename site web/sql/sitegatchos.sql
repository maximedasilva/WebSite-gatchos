SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `gatchos` DEFAULT CHARACTER SET utf8 ;
USE `gatchos` ;

-- -----------------------------------------------------
-- Table `gatchos`.`Instrument`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `gatchos`.`Instrument` (
  `idInstrument` INT(11) NOT NULL AUTO_INCREMENT ,
  `NomInstrument` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idInstrument`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gatchos`.`Sortie`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `gatchos`.`Sortie` (
  `idSortie` INT(11) NOT NULL AUTO_INCREMENT ,
  `NomSortie` VARCHAR(100) NOT NULL ,
  `DateSortie` DATE NOT NULL ,
  `description Sortie` LONGTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`idSortie`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gatchos`.`Musicien`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `gatchos`.`Musicien` (
  `idMusicien` INT(11) NOT NULL AUTO_INCREMENT ,
  `NomMusicien` VARCHAR(45) NOT NULL ,
  `PrénomMusicien` VARCHAR(45) NOT NULL ,
  `MailMusicien` VARCHAR(45) NULL ,
  `pseudo` VARCHAR(45) NOT NULL ,
  `Mdp` VARCHAR(45) NOT NULL ,
  `isChef` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`idMusicien`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gatchos`.`Inscription`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `gatchos`.`Inscription` (
  `Musicien_idMusicien` INT(11) NOT NULL ,
  `Sortie_idSortie` INT(11) NOT NULL ,
  `Valeur` ENUM('present','absent','doute') NOT NULL ,
  PRIMARY KEY (`Musicien_idMusicien`, `Sortie_idSortie`) ,
  INDEX `fk_Musicien_has_Sortie_Sortie1_idx` (`Sortie_idSortie` ASC) ,
  INDEX `fk_Musicien_has_Sortie_Musicien1_idx` (`Musicien_idMusicien` ASC) ,
  CONSTRAINT `fk_Musicien_has_Sortie_Musicien1`
    FOREIGN KEY (`Musicien_idMusicien` )
    REFERENCES `gatchos`.`Musicien` (`idMusicien` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Musicien_has_Sortie_Sortie1`
    FOREIGN KEY (`Sortie_idSortie` )
    REFERENCES `gatchos`.`Sortie` (`idSortie` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gatchos`.`MusicienInstrument`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `gatchos`.`MusicienInstrument` (
  `Instrument_idInstrument` INT(11) NOT NULL ,
  `Musicien_idMusicien` INT(11) NOT NULL ,
  PRIMARY KEY (`Instrument_idInstrument`, `Musicien_idMusicien`) ,
  INDEX `fk_Instrument_has_Musicien_Musicien1_idx` (`Musicien_idMusicien` ASC) ,
  INDEX `fk_Instrument_has_Musicien_Instrument1_idx` (`Instrument_idInstrument` ASC) ,
  CONSTRAINT `fk_Instrument_has_Musicien_Instrument1`
    FOREIGN KEY (`Instrument_idInstrument` )
    REFERENCES `gatchos`.`Instrument` (`idInstrument` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Instrument_has_Musicien_Musicien1`
    FOREIGN KEY (`Musicien_idMusicien` )
    REFERENCES `gatchos`.`Musicien` (`idMusicien` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `gatchos` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
