# we will create a DB the name is optional but it has to be changed on db_config.php
# with the following command the DB will be created 
# CREATE DATABASE sit;
# we will create a user for our data base with the command 
# CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';
# we will change newuser and localhost and passowrd with the values desired 
# the MySQL query will look like this 
# CREATE USER 'test'@'localhost' IDENTIFIED BY 'test';
# we will follow to grant all privileges to the new user if and only if its an admin user
# GRANT ALL PRIVILEGES ON * . * TO 'newuser'@'localhost';
# for any other user we will gran the following privileges
# GRANT SELECT, INSERT, UPDATE ON sit.* TO 'username'@'localhost';


create table users (
id int not null auto_increment,
name varchar(50) not null,
role varchar(20) not null,
user_login varchar(50) not null unique,
password char (64) not null,
primary key (id)
) ;

create table customers (
customer_id int not null auto_increment,
name varchar (50) default null,
email varchar (60) not null,
primary key (customer_id)
);

create table tickets (
ticket_id int not null auto_increment,
ticket_number varchar(20),
customer int not null,
assigened_to int,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,
scheduled date default null,
status varchar(17) default null,
cost DECIMAL(7 , 2 ) default null,
description text default null,
subject varchar (150) default null,
primary key (ticket_id),
FOREIGN KEY (customer) REFERENCES users(id),
FOREIGN KEY (customer) REFERENCES customers(customer_id)
ON DELETE CASCADE
ON UPDATE CASCADE
);



create view Vtickets as
 select t.*, c.email, c.name from tickets t, customers c 
 where t.customer=c.customer_id;
 
# the gollowing line is to create a test user in order to test the program 

# insert into users (name, password , role, user_login) values ('andres', SHA2('test',256), 'admin', 'test' )
