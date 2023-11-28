<?php
function index()
{
    $sql = "SELECT * FROM testing";
    // dd($_GET['q']);
    if (!empty($_GET['q'])) {
        $q=$_GET['q'];
      $sql.=" WHERE sname LIKE '%$q%'";
    }
    //php mhr global scope ka var twy ko locla scope htl mhr pyn khw tone lo m aya 

    return view("list/index", ["lists" => all($sql)]);
};
function create()
{
    view('list/create');
};
function store()
{
    $name = $_POST['name'];
    $money = $_POST["money"];
    $sql = "INSERT INTO testing(sname,money) VALUES('$name','$money')";
    run($sql);  
    // setSession("File stored successfully!");
    // dd(showSession());
    redirect(route("list"),"File stored successfully!");
};
function delete()
{
    $id = $_POST['id'];
    $sql = "DELETE  FROM testing WHERE id=$id";
    run($sql);
    // setSession("File deleted successfully!");
    redirect(route('list'),"File deleted successfully!");
}
function edit()
{
    // $name = $_GET['name'];
    // $money = $_GET['money'];
    $id = $_GET['id'];
    $sql = "SELECT * FROM testing WHERE id=$id";
   
    return view('list/edit', ['list' => first($sql)]);
}
function update()
{
    $name = $_POST['name'];
    $money = $_POST['money'];
    $id = $_POST['id'];
    // dd($_POST["id"]);
    $sql = "UPDATE testing SET sname='$name',money='$money' WHERE id=$id";
    run($sql);
    // setSession("File updated successfully!");
    redirect(route('list'),"File updated successfully!");
}
