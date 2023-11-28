<?php
function index()
{
    $sql = "SELECT * FROM testing";
    // dd($_GET['q']);
    if (!empty($_GET['q'])) {
        $q = $_GET['q'];
        $sql .= " WHERE sname LIKE '%$q%'";
    }
    $row_total = first("SELECT COUNT('id') AS total FROM testing")["total"];
    $limit = 10;
    $total_pages = $row_total / $limit;
    $current_pages = isset($_GET["page"]) ? $_GET['page'] : 1;
    $offset = ($current_pages - 1) * $limit;
    $sql.="LIMIT $offset,$limit";
    dd(all($sql));
    //php mhr global scope ka var twy ko locla scope htl mhr pyn khw tone lo m aya 

    return view("list/index", ["lists" => all($sql)]);
};



// dd($row_total);
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
    redirect(route("list"), "File stored successfully!");
};
function delete()
{
    $id = $_POST['id'];
    $sql = "DELETE  FROM testing WHERE id=$id";
    run($sql);
    // setSession("File deleted successfully!");
    redirect(route('list'), "File deleted successfully!");
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
    redirect(route('list'), "File updated successfully!");
}
