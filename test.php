<?php 
require_once './core/connect.php';
require_once './core/function.php';
// logger('hi',93);
// $array=['a','b','c'];
// var_dump($string=join(",",$array));
echo codeSanitizer("<script>alert('hiiiii')</script>;");

// `sname` varchar(50) DEFAULT NULL,
// `money` int(11) DEFAULT NULL,