<?php 

$uri=$_SERVER["REQUEST_URI"];//uri that include both path and queries
$uriArr=parse_url($uri);
$path=$uriArr["path"];// only path included
const Routes=[
    "/"=>"page@home",
    "/about-us"=>"page@about",
    "/list"=> "list@index",
    "/list-create"=>"list@create",
    "/list-store"=>["post","list@store"],
    "/list-edit"=>["put","list@edit"],
    "/list-update"=>["put","list@update"],
    "/list-delete"=>["delete","list@delete"]

  ];
  if (array_key_exists($path,Routes) && is_array(Routes[$path]) && checkReqMethod(Routes[$path][0])) {
  dd($_SERVER);
  }elseif(array_key_exists($path,Routes) && !is_array(Routes[$path])){
    controller(Routes[$path]);
  }
  else{
    view("notFound");
  }