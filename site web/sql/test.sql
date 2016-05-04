SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
CREATE SCHEMA IF NOT EXISTS `mydb3` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Instrument`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Instrument` (
  `idInstrumnt` INT NOT NULL AUTO_INCREMENT ,
  `NomInstrument` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idInstrumnt`) )
ENGINE = InnoDB;

USE `mydb3` ;

-- -----------------------------------------------------
-- Table `mydb3`.`Musicien`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb3`.`Musicien` (
  `idMusicien` INT(11) NOT NULL AUTO_INCREMENT ,
  `PrénomMusicien` VARCHAR(45) NOT NULL ,
  `NomMusicien` VARCHAR(45) NOT NULL ,
  `MailMusicien` VARCHAR(45) NOT NULL ,
  `pseudo` VARCHAR(45) NOT NULL ,
  `Mdp` VARCHAR(45) NOT NULL ,
  `isChef` TINYINT(1) NULL DEFAULT NULL ,
  PRIMARY KEY (`idMusicien`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb3`.`Sortie`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb3`.`Sortie` (
  `idSortie` INT(11) NOT NULL AUTO_INCREMENT ,
  `NomSortie` VARCHAR(100) NOT NULL ,
  `DateSortie` DATE NOT NULL ,
  `description Sortie` LONGTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`idSortie`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb3`.`Inscription`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb3`.`Inscription` (
  `Musiciens_idMusiciens` INT(11) NOT NULL ,
  `Sorties_idSorties` INT(11) NOT NULL ,
  `Valeur` ENUM('present','absent','doute') NOT NULL ,
  PRIMARY KEY (`Musiciens_idMusiciens`, `Sorties_idSorties`) ,
  INDEX `fk_Musiciens_has_Sorties_Sorties1_idx` (`Sorties_idSorties` ASC) ,
  INDEX `fk_Musiciens_has_Sorties_Musiciens1_idx` (`Musiciens_idMusiciens` ASC) ,
  CONSTRAINT `fk_Musiciens_has_Sorties_Musiciens1`
    FOREIGN KEY (`Musiciens_idMusiciens` )
    REFERENCES `mydb3`.`Musicien` (`idMusicien` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Musiciens_has_Sorties_Sorties1`
    FOREIGN KEY (`Sorties_idSorties` )
    REFERENCES `mydb3`.`Sortie` (`idSortie` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb3`.`MusicienInstrument`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb3`.`MusicienInstrument` (
  `Musicien_idMusicien` INT(11) NOT NULL ,
  `Instrumnt_idInstrumnt` INT NOT NULL ,
  PRIMARY KEY (`Musicien_idMusicien`, `Instrumnt_idInstrumnt`) ,
  INDEX `fk_Musicien_has_Instrumnt_Instrumnt1_idx` (`Instrumnt_idInstrumnt` ASC) ,
  INDEX `fk_Musicien_has_Instrumnt_Musicien1_idx` (`Musicien_idMusicien` ASC) ,
  CONSTRAINT `fk_Musicien_has_Instrumnt_Musicien1`
    FOREIGN KEY (`Musicien_idMusicien` )
    REFERENCES `mydb3`.`Musicien` (`idMusicien` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Musicien_has_Instrumnt_Instrumnt1`
    FOREIGN KEY (`Instrumnt_idInstrumnt` )
    REFERENCES `mydb`.`Instrument` (`idInstrumnt` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `mydb` ;
USE `mydb3` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
