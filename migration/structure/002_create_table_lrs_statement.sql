create table if not exists lrs_statements (
  id int not null AUTO_INCREMENT,
  verb_id int (200) not null,
  act_id int (200) not null,
  content varchar (200) not null,
  lrs_id int (200) not null,
  lrs_client_id int (200) not null,
  primary key (id),
  FOREIGN KEY (verb_id) REFERENCES verb (id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (act_id) REFERENCES activity (id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (lrs_id) REFERENCES lrs (id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (lrs_client_id) REFERENCES lrs_client (id) ON UPDATE CASCADE ON DELETE CASCADE
);
