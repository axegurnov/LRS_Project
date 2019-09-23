DELETE FROM `lrs`.`lrs_state`;

ALTER TABLE lrs.lrs_state
CHANGE COLUMN activity activity_id INT(200) NOT NULL ,
ADD INDEX fk_lrs_state_1_idx (activity_id ASC);
ALTER TABLE lrs.lrs_state
ADD CONSTRAINT lrs_state_ibfk_3
  FOREIGN KEY (activity_id)
  REFERENCES lrs.activity (id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
