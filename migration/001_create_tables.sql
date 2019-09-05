create table if not exists users (
  id int not null AUTO_INCREMENT,
  login varchar (20) not null,
  password varchar (100) not null,
  name varchar (20) not null,
  email varchar (50) not null,
  primary key (id)
);
create table if not exists lrs (
  id int not null AUTO_INCREMENT,
  name varchar (100) not null,
  description varchar (200) not null,
  primary key (id)
);
create table if not exists lrs_client (
  id int not null AUTO_INCREMENT,
  lrs_id int null,
  login varchar (20) not null,
  password varchar (200) not null,
  description varchar (200) not null,
  primary key (id)
);
create table if not exists lrs_statements (
  id int not null AUTO_INCREMENT,
  actor varchar (20) not null,
  verb varchar (200) not null,
  activity varchar (200) not null,
  content varchar (200) not null,
  lrs_id int (200) not null,
  lrs_client_id int (200) not null,
  primary key (id)
);
create table if not exists lrs_state (
  id int not null AUTO_INCREMENT,
  lrs_id int (100) not null,
  lrs_client_id int (100) not null,
  state_key varchar (100) not null,
  value varchar (100) not null,
  activity varchar (100) not null,
  registration varchar (100) not null,
  primary key (id)
);