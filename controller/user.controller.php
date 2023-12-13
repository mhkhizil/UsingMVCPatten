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

    return responseJson(pagination($sql, 10));
};



// dd($row_total);

function store()
{
    $name = $_POST['name'];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    run("INSERT INTO users(sname,gender,email,address) VALUES('$name','$gender','$email','$address')");
    // setSession("File stored successfully!");
    // dd(showSession());
    $currentUser = first("SELECT * FROM users WHERE id={$GLOBALS['con']->insert_id}"); // connetion objects has id that i have inserted latest using sql cmd therefore i retrieve it and run sql cmd to get latest inserted user
    return  responseJson($currentUser, 201);
};
function delete()
{
    $id = $_GET['id'];

    $sql = "DELETE  FROM users WHERE id=$id";
    run($sql);
    // setSession("File deleted successfully!");
    return responseJson("deleted successfully"); //server htl ka htttp referer ka nout sone twr htr dl link ko pyn po py 
}

function update()
{
    $name = $_POST['name'];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $id = $_GET['id'];
    // dd($_POST["id"]);
    $sql = "UPDATE inventories SET sname='$name',gender='$gender',email='$email', address='$address' WHERE id=$id";
    run($sql);
    // setSession("File updated successfully!");
    return responseJson(first("SELECT * FROM cars WHERE id=$id"));
}
function show()
{
    // $name = $_GET['name'];
    // $money = $_GET['money'];
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";

    return responseJson(first($sql));
}
