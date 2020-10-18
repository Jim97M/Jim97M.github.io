-- MySQL Workbench Synchronization
-- Generated: 2020-03-20 14:56
-- Model: New Model
-- Version: 1.0
-- Project: MadukaOnline
-- Author: dijiflex@gmail.com +254701702734

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `madukaonline`.`shop` 
DROP FOREIGN KEY `fk_shop_county1`;

ALTER TABLE `madukaonline`.`services` 
DROP FOREIGN KEY `fk_services_category1`;

ALTER TABLE `madukaonline`.`products` 
CHANGE COLUMN `prd_delivery` `prd_delivery` TINYINT(4) NULL DEFAULT 0 COMMENT '0 - no delivery \n1 - delivery is offered' ,
CHANGE COLUMN `prd_update_date` `prd_update_date` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `madukaonline`.`unverified_seller` 
CHANGE COLUMN `status` `status` VARCHAR(45) NULL DEFAULT NULL COMMENT '0 - unverified\\n1- rejected\\n' ;

CREATE TABLE IF NOT EXISTS `madukaonline`.`srv_images` (
  `srv_img_id` INT(11) NOT NULL AUTO_INCREMENT,
  `srv_img_name` MEDIUMTEXT NULL DEFAULT NULL,
  `services_srv_id` INT(11) NOT NULL,
  PRIMARY KEY (`srv_img_id`),
  INDEX `fk_shop_images_services1_idx` (`services_srv_id` ASC) VISIBLE,
  CONSTRAINT `fk_shop_images_services1`
    FOREIGN KEY (`services_srv_id`)
    REFERENCES `madukaonline`.`services` (`srv_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

ALTER TABLE `madukaonline`.`shop` 
ADD CONSTRAINT `fk_shop_county1`
  FOREIGN KEY (`shop_county_id`)
  REFERENCES `madukaonline`.`county` (`county_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `madukaonline`.`services` 
DROP FOREIGN KEY `fk_services_shop1`;

ALTER TABLE `madukaonline`.`services` ADD CONSTRAINT `fk_services_shop1`
  FOREIGN KEY (`shop_shop_id`)
  REFERENCES `madukaonline`.`shop` (`shop_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_services_category1`
  FOREIGN KEY (`category_category_id`)
  REFERENCES `madukaonline`.`category` (`category_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
