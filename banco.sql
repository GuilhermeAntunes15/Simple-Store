create database login;

use login;

create table users(
id INT NOT NULL AUTO_INCREMENT,
name varchar(100) NOT NULL,
email varchar(100) NOT NULL,
cpf varchar(11) NOT NULL,
birthdate date NOT NULL,
passwd varchar(300) NOT NULL,
PRIMARY KEY (id)
);

create table products(
    prod_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    prod_name varchar(255) NOT NULL,
    prod_inve int(128) NOT NULL,
    prod_pric int(128) NOT NULL,
    prod_desc text,
    prod_rati int(2),
    
    prod_img1_name varchar(255),
    prod_img1_type varchar(255),
    prod_img1_data MEDIUMBLOB ,
    
	prod_img2_name varchar(255),
    prod_img2_type varchar(255),
    prod_img2_data MEDIUMBLOB 
);