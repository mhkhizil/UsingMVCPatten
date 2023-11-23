<?php
function home()
{
    return view("home", ["myName" => "trz"]);
};
function about()
{
    return  view("about");
}
