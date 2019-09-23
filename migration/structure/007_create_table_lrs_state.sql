create table if not exists lrs_state (
    id int not null AUTO_INCREMENT,
    lrs_id int (100) not null,
    lrs_client_id int (100) not null,
    state_key varchar (100) not null,
    value varchar (100) not null,
    activity_id int (100) not null,
    registration varchar (100) not null,
    primary key (id),
    FOREIGN KEY (lrs_id) REFERENCES lrs (id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (lrs_client_id) REFERENCES lrs_client (id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (activity_id) REFERENCES activity (id) ON UPDATE CASCADE ON DELETE CASCADE,
);