CREATE DATABASE music;
use music;


-- creating table  for registration
CREATE TABLE registration(
id int,
username varchar(255),
    email_id varchar(255),
    password varchar (255),
    created_at timestamp,
    updated_at timestamp
);