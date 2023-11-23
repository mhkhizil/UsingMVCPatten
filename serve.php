<?php
$dynamicPort = rand(7000, 9999);
// system("php -S localhost:8080 -t public/");
if (strtoupper(substr(PHP_OS, 0, 3)) === "WIN") {
    system("cd public && php -S localhost:$dynamicPort");
} else {
    system("cd public; php -S localhost:$dynamicPort");
}
echo strtoupper(substr(PHP_OS, 0, 3));
