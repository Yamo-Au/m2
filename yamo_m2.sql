DROP DATABASE IF EXISTS yamo_m2;

GRANT USAGE ON *.* TO 'yamo'@'localhost';
DROP USER 'yamo'@'localhost';

CREATE DATABASE yamo_m2;

CREATE USER 'm2-user'@'localhost'
   IDENTIFIED BY '66<hb2{157C/Ghw';
   
GRANT ALL ON yamo_m2.* TO 'm2-user'@'localhost';
   
USE yamo_m2;

CREATE TABLE Plans
(
   planId int NOT NULL AUTO_INCREMENT,
   planSupplier varchar(20) NOT NULL,
   planType varchar(20) NOT NULL,
   planProvider varchar(20) NOT NULL,
   planBandwidth varchar(20) NOT NULL,
   planData varchar(20) NOT NULL,
   planInstallationFee float NOT NULL,
   planMonthlyFee float NOT NULL,
   PRIMARY KEY (planId)
);

CREATE TABLE Customers
(
   customerId int NOT NULL AUTO_INCREMENT,
   customerName varchar(50) NOT NULL,
   customerStreet1 varchar(50) NOT NULL,
   customerStreet2 varchar(50) NULL,
   customerCity varchar(50) NOT NULL,
   customerState varchar(6) NOT NULL,
   customerPostcode varchar(6) NOT NULL,
   customerEmail varchar(50) NOT NULL,
   customerPhone varchar(50) NOT NULL,
   PRIMARY KEY (customerId)
);

CREATE TABLE Orders
(
   orderId int NOT NULL AUTO_INCREMENT,
   orderDate date NOT NULL,
   planId int NOT NULL,
   customerId int NOT NULL,
   telstraNumber varchar(50) NULL,
   PRIMARY KEY (orderId),
   FOREIGN KEY (planId)
      REFERENCES Plans(planId)
      ON DELETE CASCADE,
   FOREIGN KEY (customerId)
      REFERENCES Customers(customerId)
      ON DELETE CASCADE
);


