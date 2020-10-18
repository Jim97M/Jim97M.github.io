-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema madukaonline
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema madukaonline
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `madukaonline` DEFAULT CHARACTER SET utf8 ;
USE `madukaonline` ;

-- -----------------------------------------------------
-- Table `madukaonline`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `madukaonline`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `user_fname` VARCHAR(1000) NULL,
  `user_lname` VARCHAR(1000) NULL,
  `user_email` VARCHAR(1000) NULL,
  `user_phoneno` INT NULL,
  `user_pwd` LONGTEXT NULL,
  `user_county` VARCHAR(45) NULL,
  `user_address` VARCHAR(1000) NULL,
  `user_regdate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `madukaonline`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `madukaonline`.`admin` (
  `admin_id` INT NOT NULL AUTO_INCREMENT,
  `user_user_id` INT NOT NULL,
  PRIMARY KEY (`admin_id`, `user_user_id`),
  INDEX `fk_admin_user_idx` (`user_user_id` ASC),
  CONSTRAINT `fk_admin_user`
    FOREIGN KEY (`user_user_id`)
    REFERENCES `madukaonline`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `madukaonline`.`seller`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `madukaonline`.`seller` (
  `seller_id` INT NOT NULL AUTO_INCREMENT,
  `seller_name` VARCHAR(1000) NULL,
  `seller_location` VARCHAR(45) NULL,
  `seller_phone` INT NULL,
  `seller_email` VARCHAR(1000) NULL,
  `seller_address` VARCHAR(1000) NULL,
  `seller_image` VARCHAR(1000) NULL,
  `seller_fk_user_id` INT NOT NULL,
  `seller_regdate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`seller_id`, `seller_fk_user_id`),
  INDEX `fk_seller_user1_idx` (`seller_fk_user_id` ASC),
  CONSTRAINT `fk_seller_user1`
    FOREIGN KEY (`seller_fk_user_id`)
    REFERENCES `madukaonline`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `madukaonline`.`unverified_seller`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `madukaonline`.`unverified_seller` (
  `unverified_seller_id` VARCHAR(45) NOT NULL,
  `user_user_id` INT NOT NULL,
  `request_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `status` VARCHAR(45) NULL COMMENT '0 - unverified\n1- rejected\n',
  PRIMARY KEY (`unverified_seller_id`, `user_user_id`),
  CONSTRAINT `fk_unverified_seller_user1`
    FOREIGN KEY (`user_user_id`)
    REFERENCES `madukaonline`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `madukaonline`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `madukaonline`.`category` (
  `category_id` INT NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(45) NULL,
  `category_desc` MEDIUMTEXT NULL,
  `category_regdate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `madukaonline`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `madukaonline`.`products` (
  `prd_id` INT NOT NULL AUTO_INCREMENT,
  `prd_name` VARCHAR(1000) NULL,
  `prd_desc` MEDIUMTEXT NULL,
  `prd_qty` INT NULL COMMENT 'Product Quantity',
  `prd_price` DECIMAL NULL,
  `prd_seller_id` INT NOT NULL,
  `verified` TINYINT NULL DEFAULT 0 COMMENT '0 - unverifeid\n1- verifed\n2- rejected',
  `prd_post_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `prd_update_date` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `prd_category_id` INT NOT NULL,
  PRIMARY KEY (`prd_id`, `prd_seller_id`),
  INDEX `fk_products_seller1_idx` (`prd_seller_id` ASC),
  INDEX `fk_products_category1_idx` (`prd_category_id` ASC),
  CONSTRAINT `fk_products_seller1`
    FOREIGN KEY (`prd_seller_id`)
    REFERENCES `madukaonline`.`seller` (`seller_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_category1`
    FOREIGN KEY (`prd_category_id`)
    REFERENCES `madukaonline`.`category` (`category_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `madukaonline`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `madukaonline`.`images` (
  `image_id` INT NOT NULL AUTO_INCREMENT,
  `image_name` VARCHAR(45) NULL,
  `image_fk_product_id` INT NOT NULL,
  PRIMARY KEY (`image_id`, `image_fk_product_id`),
  INDEX `fk_images_products1_idx` (`image_fk_product_id` ASC),
  CONSTRAINT `fk_images_products1`
    FOREIGN KEY (`image_fk_product_id`)
    REFERENCES `madukaonline`.`products` (`prd_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `madukaonline`.`transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `madukaonline`.`transactions` (
  `trans_id` INT NOT NULL AUTO_INCREMENT,
  `trans_prd_price` DECIMAL NULL COMMENT 'Transaction Product Price',
  `prd_qty` VARCHAR(45) NULL,
  `trans_total` DOUBLE NULL,
  `trans_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_fk_prd_id` INT NOT NULL,
  `trans_fk_prd_seller_id` INT NOT NULL,
  `buyer_fk_user_id` INT NOT NULL,
  PRIMARY KEY (`trans_id`),
  INDEX `fk_transactions_products1_idx` (`trans_fk_prd_id` ASC, `trans_fk_prd_seller_id` ASC),
  INDEX `fk_transactions_user1_idx` (`buyer_fk_user_id` ASC),
  CONSTRAINT `fk_transactions_products1`
    FOREIGN KEY (`trans_fk_prd_id` , `trans_fk_prd_seller_id`)
    REFERENCES `madukaonline`.`products` (`prd_id` , `prd_seller_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transactions_user1`
    FOREIGN KEY (`buyer_fk_user_id`)
    REFERENCES `madukaonline`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `madukaonline`.`cart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `madukaonline`.`cart` (
  `cart_id` INT NOT NULL AUTO_INCREMENT,
  `cart_prd_id` INT NOT NULL,
  `cart_prd_seller_id` INT NOT NULL,
  PRIMARY KEY (`cart_id`),
  INDEX `fk_cart_products1_idx` (`cart_prd_id` ASC, `cart_prd_seller_id` ASC),
  CONSTRAINT `fk_cart_products1`
    FOREIGN KEY (`cart_prd_id` , `cart_prd_seller_id`)
    REFERENCES `madukaonline`.`products` (`prd_id` , `prd_seller_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
