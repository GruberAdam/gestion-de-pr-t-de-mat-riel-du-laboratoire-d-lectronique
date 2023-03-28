CREATE DATABASE pretpi;
use pretpi;

CREATE TABLE `material_category` (
  `materialCategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`materialCategoryId`)
);

CREATE TABLE `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) DEFAULT NULL,
  `inventoryNumber` int(11) NOT NULL,
  `serialNumber` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `materialCategoryId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `materialCategoryId` (`materialCategoryId`),
  CONSTRAINT `material_ibfk_1` FOREIGN KEY (`materialCategoryId`) REFERENCES `material_category` (`materialCategoryId`) ON DELETE CASCADE 
);

CREATE TABLE `account_type` (
  `accountTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`accountTypeId`)
);


CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `accountTypeId` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authKey` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `authKey_UNIQUE` (`authKey`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `accountTypeId` (`accountTypeId`),
  CONSTRAINT `account_ibfk_1` FOREIGN KEY (`accountTypeId`) REFERENCES `account_type` (`accountTypeId`) ON DELETE CASCADE
);

CREATE TABLE `material_loan` (
  `materialLoanId` int(11) NOT NULL AUTO_INCREMENT,
  `materialId` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  `loanDate` datetime NOT NULL,
  `returnDate` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`materialLoanId`),
  KEY `materialId` (`materialId`),
  KEY `accountId` (`accountId`),
  CONSTRAINT `material_loan_ibfk_1` FOREIGN KEY (`materialId`) REFERENCES `material` (`id`) ON DELETE CASCADE,
  CONSTRAINT `material_loan_ibfk_2` FOREIGN KEY (`accountId`) REFERENCES `account` (`id`) ON DELETE CASCADE
);

INSERT INTO account_type (name) VALUES ("user");
INSERT INTO account_type (name) VALUES ("admin");

INSERT INTO account (email, accountTypeId, password, authKey) VALUES ("admin@bluewin.ch", "2", "$2y$13$J.rsavwNc4SliO.HRE627eVW0SHAb22zdNRL7I6LGWOaVy5Yil4Wi", "4$12sfdkljjei"); 

