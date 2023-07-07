drop DATABASE music;

CREATE DATABASE music;
use music;


-- creating table  for registration
CREATE TABLE registration(
id int not null AUTO_INCREMENT,
username varchar(255) not null,
    email_id varchar(255)  not null,
    password varchar (255)  not null,
    is_premium int  not null,
    is_admin int  not null,
    created_at timestamp,
    updated_at timestamp,
    PRIMARY KEY(id)
);

INSERT INTO registration (username,email_id,password,is_premium,is_admin,created_at,updated_at)
VALUES("admin","admin@gmail.com","admin",1,1,now(),now());

INSERT INTO registration (username,email_id,password,is_premium,is_admin,created_at,updated_at)
VALUES("rehan","rehan@gmail.com","rehan",0,0,now(),now());

INSERT INTO registration (username,email_id,password,is_premium,is_admin,created_at,updated_at)
VALUES("kishore","kishore@gmail.com","admin",0,0,now(),now());