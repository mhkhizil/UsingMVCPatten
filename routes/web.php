<?php

$uri = $_SERVER["REQUEST_URI"]; //uri that include both path and queries
$uriArr = parse_url($uri);
$path = $uriArr["path"]; // only path included
const Routes = [
  "/" => "page@home",
  "/about-us" => "page@about",
  "/show-session" => "page@ss",
  //route for list
  "/list" => "list@index",
  "/list-create" => "list@create",
  "/list-store" => ["post", "list@store"],
  "/list-edit" => "list@edit",
  "/list-update" => ["put", "list@update"],
  "/list-delete" => ["delete", "list@delete"],
  //route for inventory
  "/inventory" => "inventory@index",
  "/inventory-create" => "inventory@create",
  "/inventory-store" => ["post", "inventory@store"],
  "/inventory-edit" => "inventory@edit",
  "/inventory-update" => ["put", "inventory@update"],
  "/inventory-delete" => ["delete", "inventory@delete"],
  //route for user api 
  "/api/users" => "user@index",
  "/api/user" => "user@show",
  "/api/user-store" => ["post", "user@store"],
  "/api/user-update" => ["put", "user@update"],
  "/api/user-delete" => ["delete", "user@delete"],
    //route for car api 
    "/api/cars" => "car@index",
    "/api/car" => "car@show",
    "/api/car-store" => ["post", "car@store"],
    "/api/car-update" => ["put", "car@update"],
    "/api/car-delete" => ["delete", "car@delete"],

];
if (array_key_exists($path, Routes) && is_array(Routes[$path]) && checkReqMethod(Routes[$path][0])) {
  controller(Routes[$path][1]);
} elseif (array_key_exists($path, Routes) && !is_array(Routes[$path])) {
  controller(Routes[$path]);
} else {
  // dd($_SERVER);

  view("notFound");
}
