<?php
require_once './core/connect.php';
require_once './core/function.php';
deleteExistingTable();
// createTable('testing');
createTable("testing","sname VARCHAR(50) NOT NULL","money INT(20) NOT NULL ");
createTable("inventories","sname VARCHAR(50) NOT NULL","price INT(20) NOT NULL ","stock INT(20) NOT NULL ");
createTable("users","sname VARCHAR(50) NOT NULL","gender enum('male','female') NOT NULL","email VARCHAR(50) NOT NULL","address TEXT NOT NULL");
createTable("cars","sname VARCHAR(50) NOT NULL","brand VARCHAR(40) NOT NULL","fuel enum('gasoline','diesel','petrol','EV'),detailSpec TEXT NOT NULL " );
createTable("staffs","name VARCHAR(50) NOT NULL","age INT(3) NOT NULL","department VARCHAR(60) NOT NULL","gender enum('male','female') NOT NULL","salary INT(10) NOT NULL");
//user atwt api pyn yay ya omm ml 
//staff ko ha ko yay
