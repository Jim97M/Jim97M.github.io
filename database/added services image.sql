-- MySQL Workbench Synchronization
-- Generated: 2020-03-20 12:55
-- Model: New Model
-- Version: 1.0
-- Project: MadukaOnline
-- Author: dijiflex@gmail.com +254701702734

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `madukaonline`.`products` 
CHANGE COLUMN `prd_delivery` `prd_delivery` TINYINT(4) NULL DEFAULT 0 COMMENT '0 - no delivery \n1 - delivery is offered' ,
CHANGE COLUMN `prd_update_date` `prd_update_date` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `madukaonline`.`unverified_seller` 
CHANGE COLUMN `status` `status` VARCHAR(45) NULL DEFAULT NULL COMMENT '0 - unverified\\n1- rejected\\n' ;

ALTER TABLE `madukaonline`.`services` 
CHANGE COLUMN `srv_desc` `srv_desc` MEDIUMTEXT NULL DEFAULT NULL ,
CHANGE COLUMN `srv_startPrice` `srv_startPrice` INT(11) NULL DEFAULT NULL ,
CHANGE COLUMN `srv_endPrice` `srv_endPrice` INT(11) NULL DEFAULT NULL ,
CHANGE COLUMN `srv_post_date` `srv_post_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `madukaonline`.`shop` 
ADD CONSTRAINT `fk_shop_county1`
  FOREIGN KEY (`shop_county_id`)
  REFERENCES `madukaonline`.`county` (`county_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `madukaonline`.`services` 
ADD CONSTRAINT `fk_services_shop1`
  FOREIGN KEY (`shop_shop_id` , `shop_shop_fk_user_id`)
  REFERENCES `madukaonline`.`shop` (`shop_id` , `shop_fk_user_id`)
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
