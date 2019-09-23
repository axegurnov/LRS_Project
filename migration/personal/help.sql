--переименование столбца
ALTER TABLE `lrs`.`lrs_statements` 
CHANGE COLUMN `create_data` `create_date` DATE NOT NULL ;

--добавление колонки new_column
--ALTER TABLE `lrs`.`lrs_statements` 
--ADD COLUMN `new_column` VARCHAR(120) NOT NULL AFTER `create_date`;

--удаление колонки second_name
--ALTER TABLE `lrs`.`users` 
--DROP COLUMN `second_name`;

--удаление колонки, содержащей foreign key
--ALTER TABLE `lrs`.`lrs_statements` 
--DROP FOREIGN KEY `lrs_statements_ibfk_2`;
--ALTER TABLE `lrs`.`lrs_statements` 
--DROP COLUMN `lrs_client_id`,
--DROP INDEX `lrs_client_id` ;