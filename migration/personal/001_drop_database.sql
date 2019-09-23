--DROP DATABASE `lrs`;
ALTER TABLE `lrs`.`lrs_statements` 
ADD COLUMN `new_column5` VARCHAR(120) NOT NULL AFTER `create_date`;

ALTER TABLE `lrs`.`users` 
DROP COLUMN `second_name`;

ALTER TABLE `lrs`.`lrs_statements` 
DROP FOREIGN KEY `lrs_statements_ibfk_2`;
ALTER TABLE `lrs`.`lrs_statements` 
DROP COLUMN `lrs_client_id`,
DROP INDEX `lrs_client_id` ;