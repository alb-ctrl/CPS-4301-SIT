create table users (
id int not null auto_increment,
name varchar(40) not null,
role varchar(20) not null,
user_login varchar(40) not null unique,
password char (64) not null,
primary key (id)
) ;

create table customers (
customer_id int not null auto_increment,
name varchar (40) default null,
email varchar (50) not null,
primary key (customer_id)
);

create table tickets (
ticket_id int not null auto_increment,
customer int not null,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,
scheduled date default null,
status varchar(10) default null,
cost DECIMAL(7 , 2 ) default null,
description text default null,
subject varchar (150) default null,
primary key (ticket_id),
FOREIGN KEY (customer) REFERENCES customers(customer_id)
ON DELETE CASCADE
ON UPDATE CASCADE
);


# insert into users (name, password , role, user_login) values ('andres', SHA2('test',256), 'admin', 'test' )
