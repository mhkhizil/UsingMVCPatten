<?php
function url(string $path = null): string
{
    $url = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
    $url .= '://';
    $url .= $_SERVER["HTTP_HOST"];
    if (isset($path)) {
        $url .= '/';
        $url .= $path;
    }

    return $url;
};
function dd($data, bool $showType = false): void
{
    echo "<pre style='line-height:1.2rem;background-color:black;color:white;margin:10px;padding:20px;border-radius:10px'>";
    if ($showType) {
        var_dump($data);
    } else {
        print_r($data);
    }
    echo "</pre>";
    die();
};
function view(string $name, array $data = null): void
{
    //array to variable
    if (!is_null($data)) {
        foreach ($data as $key => $value) {
            //dynamic variable name
            ${$key} = $value;
        }
    };

    require_once ViewDir . "/$name.view.php";
}
//This function will be call within route(index.php) to use function inside a controller file that will in turn call view 
function controller(string $controllerName): void
{
    $controllerNameArray = explode("@", $controllerName);
    require_once ControllerDir . "/$controllerNameArray[0].controller.php";
    //dynamic function call
    call_user_func($controllerNameArray[1]);
};
function route(string $path, array $queries = null): string
{
    $url = url($path);
    if (!is_null($queries)) {
        $url .= '?' . http_build_query($queries);
    }
    return $url;
};
function redirect(string $url): void
{
    header("LOCATION:" . $url);
};
function checkReqMethod(string $methodName): bool
{
    $result = false;
    $methodName = strtoupper($methodName);
    $serverRequestMethod = $_SERVER["REQUEST_METHOD"];
    if ($methodName === "POST" && $serverRequestMethod === "POST") {
        $result = true;
    } elseif ($methodName === "PUT" && $serverRequestMethod === "POST" && !empty($_POST["_method"]) && strtoupper($_POST["_method"]) === "PUT") {
        $result = true;
    } elseif ($methodName === "DELETE" && $serverRequestMethod === "POST" && !empty($_POST["_method"]) && strtoupper($_POST["_method"]) === "DELETE") {
        $result = true;
    };;
    return $result;
}
////database reusable functions 
function run(string $sql, bool $closeConnection = true): object|bool
{
    try {
        $query = mysqli_query($GLOBALS["con"], $sql);
        $closeConnection && mysqli_close($GLOBALS["con"]);
        return $query;
    } catch (Exception $e) {
        dd($e);
    }
};
function all(string $sql): array
{
    $lists = [];
    $query = run($sql);
    while ($rows = mysqli_fetch_assoc($query)) {
        $lists[] = $rows;
    };
    return $lists;
};
function first(string $sql): array
{
    $query = run($sql);
    $list = mysqli_fetch_assoc($query);
    return $list;
}
///alert message
function alert(string $message, string $color = "success"): string
{
    return "<div class=' alert alert-$color  text-dark'>
    $message
    </div>";
};
//session function start 
function setSession(string $message,string $key='message'):void{
$_SESSION[$key]=$message;
};
function showSession(string $key='message'):string{
    $message=$_SESSION[$key];
    unset($message);
    return $_SESSION[$key];
}
