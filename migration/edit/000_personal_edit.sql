CREATE TABLE if not exists activity (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX name_UNIQUE (name ASC));

CREATE TABLE if not exists verb (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX name_UNIQUE (name ASC));

INSERT INTO activity (name) VALUE ('video');
INSERT INTO activity (name) VALUE ('course');

INSERT INTO verb (name) VALUE ('watching');
INSERT INTO verb (name) VALUE ('read');
INSERT INTO verb (name) VALUE ('complete');
INSERT INTO verb (name) VALUE ('open');