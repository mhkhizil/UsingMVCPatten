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
};
function store(){
    $name=$_POST['name'];
    $money=$_POST["money"];
    $sql="INSERT INTO testing(sname,money) VALUES('$name','$money')";
    $query=mysqli_query($GLOBALS['con'],$sql);
  redirect(route("list"));


};
function delete(){
 $id=$_GET['id'];
 $sql="DELETE  FROM testing WHERE id=$id";
 $query=mysqli_query($GLOBALS['con'],$sql);
 redirect(route('list'));
}