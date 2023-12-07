<?php
function index()
{
    $sql = "SELECT * FROM users";
    // dd($_GET['q']);
    //for search bar
    if (!empty($_GET['q'])) {
        $q = $_GET['q'];
        $sql .= " WHERE sname LIKE '%$q%'";
    }




    //php mhr global scope ka var twy ko locla scope htl mhr pyn khw tone lo m aya 

    return view("list/index", ["lists" => pagination($sql, 100)]);
};



// dd($row_total);

function store()
{
    $name = $_POST['name'];
    $email = $_POST["email"];
    $gender = $_POST['gender'];
    $address = $_POST["address"];
    // dd($address);
    run("INSERT INTO users(sname,gender,email,address) VALUES('$name','$gender','$email','$address')");
    // setSession("File stored successfully!");
    // dd(showSession());

    return  responseJson("Item stored successfully",201);
};
function delete()
{
    $id = $_POST['id'];
    $sql = "DELETE  FROM users WHERE id=$id";
    run($sql);
    // setSession("File deleted successfully!");
    return redirect($_SERVER["HTTP_REFERER"], "File deleted successfully!"); //server htl ka htttp referer ka nout sone twr htr dl link ko pyn po py 
}
function edit()
{
    // $name = $_GET['name'];
    // $money = $_GET['money'];
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";

    return view('list/edit', ['list' => first($sql)]);
}
function update()
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST["address"];
    $id = $_POST['id'];
    // dd($_POST["id"]);
    $sql = "UPDATE users SET sname='$name',gender='$gender',email='$email',address='$address' WHERE id=$id";
    run($sql);
    // setSession("File updated successfully!");
    return redirect($_SERVER["HTTP_REFERER"], "File updated successfully!");
}
