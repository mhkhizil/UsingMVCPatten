<?php 
function index(){
    $sql="SELECT * FROM testing";
    $query=mysqli_query($GLOBALS["con"],$sql);//php mhr global scope ka var twy ko locla scope htl mhr pyn khw tone lo m aya 
    $lists=[];
    while ($row=mysqli_fetch_assoc($query)) {
        $lists[]=$row;
        # code...
    }
    return view("list/index",["lists"=>$lists]);
};
function create(){
    view('list/create');
}