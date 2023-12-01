<?php
require_once './core/connect.php';
require_once './core/function.php';
deleteExistingTable();
// createTable('testing');
createTable("testing","name VARCHAR(50) NOT NULL","money INT(20) NOT NULL ");

