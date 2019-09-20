create table if not exists lrs_statements (
    id int not null AUTO_INCREMENT,
    verb varchar (200) not null,
    activity varchar (200) not null,
    content varchar (200) not null,
    lrs_id int (200) not null,
    lrs_client_id int (200) not null,
    create_data date not null,
    primary key (id),
    FOREIGN KEY (lrs_id) REFERENCES lrs (id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (lrs_client_id) REFERENCES lrs_client (id) ON UPDATE CASCADE ON DELETE CASCADE
);