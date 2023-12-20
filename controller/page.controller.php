<?php
function home()
{
    return view("home", ["myName" => "trz"]);
};
function about()
{
    return  view("about");
}
function ss()
{
    // session_unset();
    dd($_SESSION);
}
