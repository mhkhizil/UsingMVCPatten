<?php
function index()
{
    $sql = "SELECT * FROM testing";
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
    redirect(route("list"));
};
function delete()
{
    $id = $_POST['id'];
    $sql = "DELETE  FROM testing WHERE id=$id";
    run($sql);
    redirect(route('list'));
}
function edit()
{
    // $name = $_GET['name'];
    // $money = $_GET['money'];
    $id = $_GET['id'];
    $sql = "SELECT * FROM testing WHERE id=$id";
    $query = run($sql);
    $list = mysqli_fetch_assoc($query);
    return view('list/edit', ['list' => $list]);
}
function update()
{
    $name = $_POST['name'];
    $money = $_POST['money'];
    $id = $_POST['id'];
    // dd($_POST["id"]);
    $sql = "UPDATE testing SET sname='$name',money='$money' WHERE id=$id";
    run($sql);
    redirect(route('list'));
}
