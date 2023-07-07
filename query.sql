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



-- adding music table
CREATE TABLE artist (
    id int not null auto_increment,
    artist_name varchar(255)  not null,
     created_at timestamp,
    updated_at timestamp,
    PRIMARY KEY (id)

);
create table album(
    id int not null auto_increment,
    album_name varchar(255)  not null,
    album_artist int ,
    primary key(id),
    FOREIGN KEY (album_artist) REFERENCES artist(id),
      created_at timestamp,
    updated_at timestamp
);


CREATE TABLE images (
id int not null AUTO_INCREMENT,
image_path varchar(255),
    artist_id int null,
    album_id int null,
    PRIMARY key (id),
    FOREIGN key (artist_id) REFERENCES artist(id),
        FOREIGN key (album_id) REFERENCES album(id),
          created_at timestamp,
    updated_at timestamp

);
CREATE TABLE playlist(
    id int not null AUTO_INCREMENT,
    artist_id int,
    album_id int,
    created_at timestamp,
    updated_at timestamp,
    PRIMARY KEY (id),
    FOREIGN key(artist_id) REFERENCES artist(id),
        FOREIGN key(album_id) REFERENCES album(id)

);
CREATE TABLE request(
id INT NOT null AUTO_INCREMENT,
user_id int,
    is_approved int,
PRIMARY key (id),
FOREIGN KEY(user_id) REFERENCES registration(id));