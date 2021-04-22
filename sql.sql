-- drop table available_dates;
-- drop table companies;
-- drop table contracts;
-- drop table courts;
-- drop table invoices;
-- drop table plans;
-- drop table reservations;
-- drop table users;

create database reservaquadra;

use reservaquadra;

CREATE TABLE IF NOT EXISTS `companies` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `responsible` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '	',
  `id_company` INT NULL,
  `name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(100) NULL,
  `group` INT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `birth` DATE DEFAULT NULL,
  `rg` VARCHAR(45) NULL,
  `cpf` VARCHAR(45) NULL,
  `civil_status` VARCHAR(45) NULL,
  `profession` VARCHAR(45) NULL,
  `address` VARCHAR(45) NULL,
  `address_number` VARCHAR(45) NULL,
  `complement` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `neighborhood` VARCHAR(45) NULL,
  `uf` VARCHAR(45) NULL,
  `zip_code` VARCHAR(45) NULL,
  `start_date` DATE NULL,
  `health_plan` VARCHAR(45) NULL,
  `how_met` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `courts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_company` INT NULL,
  `name` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `neighborhood` VARCHAR(45) NULL,
  `reference` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `available_dates` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_court` INT NULL,
  `week_day` VARCHAR(45) NULL,
  `start_time` VARCHAR(45) NULL,
  `end_time` VARCHAR(45) NULL,
  `price` DECIMAL(10,2) NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_available_date` INT NULL,
  `reservation_date` DATE NULL,
  `name_reserved` VARCHAR(45) NULL,
  `phone_reserved` VARCHAR(45) NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `contracts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_plan` INT NOT NULL,
  `id_user` INT NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE DEFAULT NULL,
  `expiration_day` VARCHAR(5) NOT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `price_per_month` DECIMAL(10,2) NOT NULL,
  `cancel_date` DATETIME DEFAULT NULL,
  `id_user_canceled` INT DEFAULT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `plans` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_company` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `months` INT NOT NULL,
  `age_range` INT NOT NULL,
  `day_period` INT NOT NULL,
  `lessons_per_week` INT NOT NULL,
  `annual_contract` INT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` INT DEFAULT NULL,
  `id_contract` INT DEFAULT NULL,
  `generate_date` DATETIME NOT NULL,
  `id_user_generated` INT NOT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `due_date` DATE NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `discount` DECIMAL(10,2) DEFAULT NULL,
  `paid_price` DECIMAL(10,2) DEFAULT NULL,
  `paid_date` DATETIME DEFAULT NULL,
  `id_user_received` INT DEFAULT NULL,
  `cancel_date` DATETIME DEFAULT NULL,
  `id_user_canceled` INT DEFAULT NULL,
  `id_type` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `scheduled_classes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_court` INT NOT NULL,
  `id_user` INT NOT NULL,
  `week_day` VARCHAR(45) NOT NULL,
  `start_time` VARCHAR(45) NOT NULL,
  `end_time` VARCHAR(45) NOT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `scheduled_classes_results` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_scheduled_classes` INT NOT NULL,
  `status` VARCHAR(5) NOT NULL,
  `date` DATE NOT NULL,
  `date_remarked` DATE DEFAULT NULL,
  `id_scheduled_classes_result_remarked` INT DEFAULT NULL,
  `observation` TEXT DEFAULT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;



-- seeder

INSERT INTO companies (name, responsible, phone) value ('ViniTennis', 'Vinicius', '(27) 98813-3808');

insert into available_dates (id_court, week_day, start_time, end_time, price, status, created_at, updated_at) values 
('1', 1, '08:00', '09:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '09:00', '10:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '10:00', '11:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '11:00', '12:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '13:00', '14:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '14:00', '15:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '15:00', '16:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '16:00', '17:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '17:00', '18:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '18:00', '19:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '19:00', '20:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 1, '20:00', '21:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),

('1', 2, '08:00', '09:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '09:00', '10:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '10:00', '11:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '11:00', '12:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '13:00', '14:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '14:00', '15:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '15:00', '16:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '16:00', '17:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '17:00', '18:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '18:00', '19:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '19:00', '20:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 2, '20:00', '21:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),

('1', 3, '08:00', '09:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '09:00', '10:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '10:00', '11:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '11:00', '12:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '13:00', '14:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '14:00', '15:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '15:00', '16:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '16:00', '17:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '17:00', '18:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '18:00', '19:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '19:00', '20:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 3, '20:00', '21:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),

('1', 4, '08:00', '09:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '09:00', '10:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '10:00', '11:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '11:00', '12:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '13:00', '14:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '14:00', '15:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '15:00', '16:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '16:00', '17:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '17:00', '18:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '18:00', '19:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '19:00', '20:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 4, '20:00', '21:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),

('1', 5, '08:00', '09:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '09:00', '10:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '10:00', '11:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '11:00', '12:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '13:00', '14:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '14:00', '15:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '15:00', '16:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '16:00', '17:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '17:00', '18:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '18:00', '19:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '19:00', '20:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 5, '20:00', '21:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),

('1', 6, '08:00', '09:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '09:00', '10:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '10:00', '11:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '11:00', '12:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '13:00', '14:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '14:00', '15:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '15:00', '16:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '16:00', '17:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '17:00', '18:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '18:00', '19:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '19:00', '20:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 6, '20:00', '21:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),

('1', 7, '08:00', '09:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '09:00', '10:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '10:00', '11:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '11:00', '12:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '13:00', '14:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '14:00', '15:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '15:00', '16:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '16:00', '17:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '17:00', '18:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '18:00', '19:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '19:00', '20:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
('1', 7, '20:00', '21:00', 50.00, 'A', '2021-03-17 00:00:00', '2021-03-17 00:00:00')