<?php
function index()
{
    $sql = "SELECT * FROM testing";
    // dd($_GET['q']);
    //for search bar
    if (!empty($_GET['q'])) {
        $q = $_GET['q'];
        $sql .= " WHERE sname LIKE '%$q%'";
    }
 



    //php mhr global scope ka var twy ko locla scope htl mhr pyn khw tone lo m aya 

    return view("list/index", ["lists" => pagination($sql,100)]);
};



// dd($row_total);
function create()
{
   return view('list/create');
};
function store()
{
    $name = codeSanitizer($_POST['name']);
    $money = $_POST["money"];
    $sql = "INSERT INTO testing(sname,money) VALUES('$name','$money')";
    run($sql);
    // setSession("File stored successfully!");
    // dd(showSession());
   return  redirect(route("list"), "File stored successfully!");
};
function delete()
{
    $id = $_POST['id'];
    $sql = "DELETE  FROM testing WHERE id=$id";
    run($sql);
    // setSession("File deleted successfully!");
    return redirect($_SERVER["HTTP_REFERER"], "File deleted successfully!"); //server htl ka htttp referer ka nout sone twr htr dl link ko pyn po py 
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
    return redirect($_SERVER["HTTP_REFERER"], "File updated successfully!");
}
