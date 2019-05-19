CREATE DATABASE if not exists `demo` CHARACTER SET utf8;

GRANT ALL PRIVILEGES ON `demo`.* TO 'al'@'localhost' IDENTIFIED BY 'al';
GRANT ALL PRIVILEGES ON `demo`.* TO 'al'@'127.0.0.1' IDENTIFIED BY 'al';

USE demo;

drop table if exists customer;
drop table if exists purchasedItems;
drop table if exists satisfaction;

CREATE TABLE if not exists customer (
  cusId int(11) NOT NULL AUTO_INCREMENT,
  full_name varchar(100) DEFAULT NULL,
  age int(3) DEFAULT NULL,
  student char(10) NOT NULL, 
  cus_created datetime default current_timestamp,
  cus_modified datetime default current_timestamp on update current_timestamp,
  cus_deleted char(1),
  PRIMARY KEY (`cusId`),
  KEY `age` (`age`),
  KEY `student` (`student`)
);

create table if not exists purchasedItems(
	purchId int(11) not null auto_increment,
	purch_cusId int(11) not null,
	howPurchased char(10) not null,
	purchases varchar(50),
	purch_created datetime default current_timestamp,
	purch_modified datetime default current_timestamp on update current_timestamp,
	primary key (purchId),
	key `customer_id` (purch_cusId),
	foreign key (purch_cusId) references customer (cusId)
);

create table if not exists satisfaction (
	satId int(11) not null auto_increment,
	sat_cusId int(11) not null,
	satisfaction char(10) not null,
	recommend char(1),
	sat_created datetime default current_timestamp,
	sat_modified datetime default current_timestamp on update current_timestamp,
	primary key (satId),
	key `customer_id` (sat_cusId),
	foreign key (sat_cusId) references customer(cusId)
);