DELETE FROM `lrs`.`lrs_statements`;

ALTER TABLE lrs.lrs_statements 
CHANGE COLUMN activity activity_id INT(200) NOT NULL ,
ADD INDEX fk_lrs_statements_1_idx (activity_id ASC);
ALTER TABLE lrs.lrs_statements 
ADD CONSTRAINT lrs_statements_ibfk_3
  FOREIGN KEY (activity_id)
  REFERENCES lrs.activity (id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;