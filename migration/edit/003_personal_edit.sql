ALTER TABLE lrs.lrs_statements 
CHANGE COLUMN verb verb_id INT(200) NOT NULL ,
ADD INDEX index5 (verb_id ASC);
ALTER TABLE lrs.lrs_statements 
ADD CONSTRAINT lrs_statements_ibfk_4
  FOREIGN KEY (verb_id)
  REFERENCES lrs.verb (id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;