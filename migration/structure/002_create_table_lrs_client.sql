create table if not exists lrs_client (
  id int not null AUTO_INCREMENT,
  lrs_id int null,
  login varchar (20) not null,
  password varchar (200) not null,
  description varchar (200) not null,
  primary key (id),
  UNIQUE(login),
  FOREIGN KEY (lrs_id) REFERENCES lrs (id) ON DELETE CASCADE
);