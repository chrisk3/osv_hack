SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`presentations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`presentations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_presentations_users_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_presentations_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`slides`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`slides` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `presentation_id` INT NOT NULL ,
  `title` VARCHAR(255) NULL ,
  `first` TEXT NULL ,
  `second` TEXT NULL ,
  `third` TEXT NULL ,
  `fourth` TEXT NULL ,
  `fifth` TEXT NULL ,
  `sixth` TEXT NULL ,
  `pic` VARCHAR(255) NULL ,
  `created_at` DATETIME NULL COMMENT '	' ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_slides_presentations1_idx` (`presentation_id` ASC) ,
  CONSTRAINT `fk_slides_presentations1`
    FOREIGN KEY (`presentation_id` )
    REFERENCES `mydb`.`presentations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `mydb` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
