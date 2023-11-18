<?php 
function index(){
    $sql="SELECT * FROM testing";
    $query=mysqli_query($GLOBALS["con"],$sql);//php mhr global scope ka var twy ko locla scope htl mhr pyn khw tone lo m aya 
    return view("list/index");
}