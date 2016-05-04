SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

USE `mydb`;

CREATE  TABLE IF NOT EXISTS `mydb`.`Instrument` (
  `idInstrumnt` INT(11) NOT NULL AUTO_INCREMENT ,
  `NomInstrument` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idInstrumnt`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `mydb3`.`MusicienInstrument` (
  `Musicien_idMusicien` INT(11) NOT NULL ,
  `Instrumnt_idInstrumnt` INT(11) NOT NULL ,
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
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
