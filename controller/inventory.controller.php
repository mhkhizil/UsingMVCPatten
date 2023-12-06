<?php
function index()
{
    $sql = "SELECT * FROM inventories";
    // dd($_GET['q']);
    //for search bar
    if (!empty($_GET['q'])) {
        $q = $_GET['q'];
        $sql .= " WHERE sname LIKE '%$q%'";
    }




    //php mhr global scope ka var twy ko locla scope htl mhr pyn khw tone lo m aya 

    return view("inventory/index", ["lists" => pagination($sql, 100)]);
};



// dd($row_total);
function create()
{
    return view('inventory/create');
};
function store()
{
    $name = $_POST['name'];
    $stock = $_POST["stock"];
    $price = $_POST["price"];
    run("INSERT INTO inventories(sname,price,stock) VALUES('$name','$price','$stock')");
    // setSession("File stored successfully!");
    // dd(showSession());
    return  redirect(route("inventory"), "Item stored successfully!");
};
function delete()
{
    $id = $_POST['id'];
    $sql = "DELETE  FROM inventories WHERE id=$id";
    run($sql);
    // setSession("File deleted successfully!");
    return redirect($_SERVER["HTTP_REFERER"], "Item deleted successfully!"); //server htl ka htttp referer ka nout sone twr htr dl link ko pyn po py 
}
function edit()
{
    // $name = $_GET['name'];
    // $money = $_GET['money'];
    $id = $_GET['id'];
    $sql = "SELECT * FROM inventories WHERE id=$id";

    return view('inventory/edit', ['list' => first($sql)]);
}
function update()
{
    $name = $_POST['name'];
    $stock = $_POST["stock"];
    $price = $_POST["price"];
    $id = $_POST['id'];
    // dd($_POST["id"]);
    $sql = "UPDATE inventories SET sname='$name',price='$price',stock='$stock' WHERE id=$id";
    run($sql);
    // setSession("File updated successfully!");
    return redirect(route("inventory"), "Item updated successfully!");
}
