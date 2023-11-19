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
function edit () {
    $name=$_GET['name'];
    $money=$_GET['money'];
    $id=$_GET['id'];
    $sql="SELECT * FROM testing WHERE id=$id";
    $query=mysqli_query($GLOBALS["con"],$sql);
    $list=mysqli_fetch_assoc($query);
    return view('list/edit',['list'=>$list]);
  
}
function update (){
    $name=$_POST['name'];
    $money=$_POST['money'];
    $id=$_POST['id'];
      $sql="UPDATE testing SET sname='$name',money='$money' WHERE id=$id";
    $query=mysqli_query($GLOBALS['con'],$sql);
    redirect(route('list'));

}