create table if not exists users (
  id int not null AUTO_INCREMENT,
  login varchar (20) not null,
  password varchar (100) not null,
  name varchar (20) not null,
  second_name varchar (20) not null,
  email varchar (50) not null,
  api_token varchar (200) null,
  primary key (id),
  UNIQUE(login)
);