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
  `registration_type` VARCHAR(45) NULL,
  `birth` DATE DEFAULT NULL,
  `rg` VARCHAR(45) NULL,
  `cpf` VARCHAR(45) NULL,
  `civil_status` VARCHAR(45) NULL,
  `gender` VARCHAR(45) NULL,
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
  `special care` TEXT NULL,
  `objective` VARCHAR(45) NULL,
  `how_met` VARCHAR(45) NULL,
  `responsible_name` VARCHAR(45) NULL,
  `responsible_rg` VARCHAR(45) NULL,
  `responsible_cpf` VARCHAR(45) NULL,
  `responsible_civil_status` VARCHAR(45) NULL,
  `responsible_profession` VARCHAR(45) NULL,
  `responsible_address` VARCHAR(45) NULL,
  `responsible_address_number` VARCHAR(45) NULL,
  `responsible_complement` VARCHAR(45) NULL,
  `responsible_city` VARCHAR(45) NULL,
  `responsible_neighborhood` VARCHAR(45) NULL,
  `responsible_uf` VARCHAR(45) NULL,
  `responsible_zip_code` VARCHAR(45) NULL,
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
  `discount` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `parcel` INT DEFAULT NULL,
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
  `price_march` DECIMAL(10,2) NOT NULL,
  `price_april` DECIMAL(10,2) NOT NULL,
  `price_may` DECIMAL(10,2) NOT NULL,
  `price_june` DECIMAL(10,2) NOT NULL,
  `price_july` DECIMAL(10,2) NOT NULL,
  `price_august` DECIMAL(10,2) NOT NULL,
  `price_september` DECIMAL(10,2) NOT NULL,
  `price_october` DECIMAL(10,2) NOT NULL,
  `price_november` DECIMAL(10,2) NOT NULL,
  `price_december` DECIMAL(10,2) NOT NULL,
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
  `fiscal_note` VARCHAR(50) DEFAULT NULL,
  `due_date` DATE NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `discount` DECIMAL(10,2) DEFAULT NULL,
  `paid_price` DECIMAL(10,2) DEFAULT NULL,
  `paid_date` DATETIME DEFAULT NULL,
  `id_user_received` INT DEFAULT NULL,
  `cancel_date` DATETIME DEFAULT NULL,
  `id_user_canceled` INT DEFAULT NULL,
  `id_type` INT NOT NULL,
  `id_payment_method` INT DEFAULT NULL,
  `id_payment_method_subtype` INT DEFAULT NULL,
  `id_payment_method_subtype_condition` INT DEFAULT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

alter table invoices add column `id_payment_method_subtype_condition` INT NULL after id_payment_method_subtype;

CREATE TABLE IF NOT EXISTS `invoice_receipts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_invoice` INT DEFAULT NULL,
  `billing_date` DATETIME NOT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'R',
  `price` DECIMAL(10,2) NOT NULL,
  `tax` DECIMAL(10,2) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

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
  `id_teacher` INT NOT NULL,
  `status` VARCHAR(5) NOT NULL,
  `result` VARCHAR(5) NOT NULL,
  `date` DATE NOT NULL,
  `date_remarked` DATE DEFAULT NULL,
  `id_scheduled_classes_result_remarked` INT DEFAULT NULL,
  `observation` TEXT DEFAULT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `payment_method_subtypes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_payment_method` INT NOT NULL,
  `name` VARCHAR(30) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `payment_method_subtype_conditions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_payment_method_subtype` INT NOT NULL,
  `parcel` INT NOT NULL,
  `is_flat` INT NOT NULL DEFAULT 0,
  `percentage_tax` FLOAT NOT NULL,
  `flat_tax` FLOAT NOT NULL,
  `days_for_payment` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `invoice_types` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `status` VARCHAR(5) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cost_centers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_company` INT NOT NULL,
  `name` VARCHAR(30) NOT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cost_center_subtypes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_cost_center` INT NOT NULL,
  `name` VARCHAR(30) NOT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_company` INT NOT NULL,
  `generate_date` DATETIME NOT NULL,
  `id_user_generated` INT NOT NULL,
  `due_date` DATE NOT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `price` DECIMAL(10,2) NOT NULL,
  `paid_date` DATETIME DEFAULT NULL,
  `id_user_paid` INT DEFAULT NULL,
  `id_cost_center` INT NOT NULL,
  `id_cost_center_subtype` INT NOT NULL,
  `observation` TEXT DEFAULT NULL,
  `nfe` VARCHAR(50) DEFAULT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `phones` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` INT NOT NULL,
  `number` VARCHAR(20) NOT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `is_emergency` INT NOT NULL,
  `is_responsible_number` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_company` INT NOT NULL,
  `name` VARCHAR(30) NOT NULL,
  `day` INT NULL,
  `month` INT NULL,
  `year` INT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `interests` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_company` INT NULL,
  `name` VARCHAR(45) NULL,
  `phone1` VARCHAR(45) NULL,
  `phone2` VARCHAR(45) NULL,
  `objective` VARCHAR(45) NULL,
  `age` VARCHAR(5) NULL,
  `sun` VARCHAR(5) NULL DEFAULT '0',
  `sun_period` VARCHAR(5) NULL DEFAULT '0',
  `mon` VARCHAR(5) NULL DEFAULT '0',
  `mon_period` VARCHAR(5) NULL DEFAULT '0',
  `tue` VARCHAR(5) NULL DEFAULT '0',
  `tue_period` VARCHAR(5) NULL DEFAULT '0',
  `wed` VARCHAR(5) NULL DEFAULT '0',
  `wed_period` VARCHAR(5) NULL DEFAULT '0',
  `thu` VARCHAR(5) NULL DEFAULT '0',
  `thu_period` VARCHAR(5) NULL DEFAULT '0',
  `fri` VARCHAR(5) NULL DEFAULT '0',
  `fri_period` VARCHAR(5) NULL DEFAULT '0',
  `sat` VARCHAR(5) NULL DEFAULT '0',
  `sat_period` VARCHAR(5) NULL DEFAULT '0',
  `all_days` VARCHAR(5) NULL DEFAULT '0',
  `all_days_period` VARCHAR(5) NULL DEFAULT '0',
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
  `avaliation_date` DATE NULL,
  `observation` TEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `debts` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_company` INT NULL,
  `id_user` INT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `observation` TEXT NULL,
  `status` VARCHAR(5) NOT NULL DEFAULT 'A',
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