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
    $email = $_POST["email"];
    $gender = $_POST['gender'];
    $address = $_POST["address"];
    // dd($address);
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
function show()
{
    // $name = $_GET['name'];
    // $money = $_GET['money'];
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";

    return responseJson(first($sql));
}
function update()
{
  parse_str(file_get_contents("php://input"),$_PUT);
    // put ka json any nk form data ka ny po lo m a ya woo formurlencoded nk mha ya ml thu ka string line g any nk yay dr 
    //ae dot ae request ka po lite dl ae formurlencoded lk htr dl data ko d phat ka pyn access lk poho ka $_POST ko tone lo ma ya woo bl lo tone ma ll so dot php://input nk phan ml br nk phan ma ll so dot file_get_content() nk phan ml br lo so dot file_get_contents ka php://input htl ka data twy ko string any nk htote py ml example name=trz&age=20 ae lo pone string ya mhr 
    //ae mhr string any nk request ka po ite dl data twy akone ya twr p ae dr ko mha parse_str() nk akone ko variable nk value talhu si htl ko htl py ml dl 
 
    $name = $_PUT['name'];
    $email = $_PUT['email'];
    $gender = $_PUT['gender'];
    $address = $_PUT["address"];
    $id = $_GET['id'];
    // dd($_POST["id"]);
    $sql = "UPDATE users SET sname='$name',gender='$gender',email='$email',address='$address' WHERE id=$id";
    run($sql);
    // setSession("File updated successfully!");
    return responseJson(first("SELECT * FROM users WHERE id=$id"));
}
