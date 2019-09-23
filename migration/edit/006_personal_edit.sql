ALTER TABLE `lrs`.`lrs_statements` 
CHANGE COLUMN `content` `content` VARCHAR(200) NULL ,
CHANGE COLUMN `create_date` `create_date` DATE NULL ;

ALTER TABLE `lrs`.`lrs_state` 
CHANGE COLUMN `registration` `registration` VARCHAR(100) NULL ;