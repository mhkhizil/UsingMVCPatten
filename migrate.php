<?php
require_once './core/connect.php';
require_once './core/function.php';
deleteExistingTable();
// createTable('testing');
createTable("testing","sname VARCHAR(50) NOT NULL","money INT(20) NOT NULL ");
createTable("inventories","sname VARCHAR(50) NOT NULL","price INT(20) NOT NULL ","stock INT(20) NOT NULL ");

