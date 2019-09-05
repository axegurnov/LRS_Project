insert into users (login, password, name, email) value ('admin','123','alex','google@gmail.com');
insert into users (login, password, name, email) value ('adm2in2','1234','neron','gasd@gmail.com');

insert into lrs (name, description) value ('Course 1','about course 1');
insert into lrs (name, description) value ('Course 2','about course 2');
insert into lrs (name, description) value ('Course 3','about course 3');
insert into lrs (name, description) value ('Course 4','about course 4');

insert into lrs_client (lrs_id, login, password, description) value ('4','vasya','123','Vasya');
insert into lrs_client (lrs_id, login, password, description) value ('3','petya','123','Petya');
insert into lrs_client (lrs_id, login, password, description) value ('2','vova','123','Vova');
insert into lrs_client (lrs_id, login, password, description) value ('1','nastya','123','Nastya');


insert into lrs_statements (actor, verb, activity, content, lrs_id,lrs_client_id) value ('vasya','watching','video','video 1','2','4');
insert into lrs_statements (actor, verb, activity, content, lrs_id,lrs_client_id) value ('petya','read','course','course 1','3','1');
insert into lrs_statements (actor, verb, activity, content, lrs_id,lrs_client_id) value ('vova','complete','course','course 3','2','2');
insert into lrs_statements (actor, verb, activity, content, lrs_id,lrs_client_id) value ('nasya','open','course','course 2','3','4');


insert into lrs_state (lrs_id, lrs_client_id, state_key, value, activity, registration) value ('2','4','432dfqw','var1','video','200');
insert into lrs_state (lrs_id, lrs_client_id, state_key, value, activity, registration) value ('1','1','43h465','var3','text','200');
insert into lrs_state (lrs_id, lrs_client_id, state_key, value, activity, registration) value ('3','3','432dfqw','var1','site','200');