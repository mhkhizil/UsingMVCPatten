<?php
//function for creating full url
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
//function for dd
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
//function that work view UI
function view(string $name, array $data = null): void
{
    //array to variable
    if (!is_null($data)) {
        // dd($data);
        foreach ($data as $key => $value) {
            //dynamic variable name where key of an array will become variable name and value will becomes it value
            ${$key} = $value;
            // dd(${$key});
        }
    };

    require_once ViewDir . "/$name.view.php";
}
//This function will be call within route(web.php) to use function inside a controller file that will in turn call view 
function controller(string $controllerName): void
{
    $controllerNameArray = explode("@", $controllerName);
    require_once ControllerDir . "/$controllerNameArray[0].controller.php";
    //dynamic function call
    call_user_func($controllerNameArray[1]);
};
//adding queries in url
function route(string $path, array $queries = null): string
{
    $url = url($path);
    if (!is_null($queries)) {
        $url .= '?' . http_build_query($queries);
    }
    return $url;
};
//redirrecting
function redirect(string $url, string $message = null): void
{
    if (!is_null($message)) setSession($message);
    header("LOCATION:" . $url);
};
//checking which method
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
function run(string $sql, bool $closeConnection = false): object|bool
{
    try {
        $query = mysqli_query($GLOBALS["con"], $sql);
        $closeConnection && mysqli_close($GLOBALS["con"]);
        return $query;
    } catch (Exception $e) {
        dd($e);
    }
};
//fetching all rows within db as array
function all(string $sql): array
{
    $lists = [];
    $query = run($sql);
    while ($rows = mysqli_fetch_assoc($query)) {
        $lists[] = $rows;
    };
    return $lists;
};
//fetching only one row from db 
function first(string $sql): array
{
    $query = run($sql);
    $list = mysqli_fetch_assoc($query);
    return $list;
};
//creating table inside db
function createTable(string  $tblName, ...$column): void
{

    $sql = "DROP TABLE IF EXISTS $tblName";
    logger("Existing " . $tblName . " table is dropped successfully!", 31);
    run($sql);
    $sql = "CREATE TABLE $tblName (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    ".join(',',$column).",
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1047 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;";
    run($sql);
    logger("New " . $tblName . " table is created successfully!");
}
//delete all unrelated tables in the db 
function deleteExistingTable(){
$tableName=all("show tables");

foreach ($tableName as  $table) {
   
   run("DROP TABLE IF EXISTS ".$table["Tables_in_sankyitar"]);
   logger($table["Tables_in_sankyitar"]." table deleted!",31);
};
logger("All existing table dropped!",31);
};
//logic for pagination
function pagination(string $sql, int $limit = 10): array
{
    $row_total = first(str_replace('*', 'COUNT(id) AS total', $sql))["total"]; //replace * with COUNT(id) AS total in   above $sql 
    // $limit = 10;
    $total_pages = ceil($row_total / $limit);
    $current_pages = isset($_GET["page"]) ? $_GET['page'] : 1;
    $offset = ($current_pages - 1) * $limit;
    $sql .= " LIMIT $offset,$limit";

    $links = [];
    //link for pagination
    for ($i = 1; $i <= $total_pages; $i++) {
        $queries = $_GET;
        $queries['page'] = $i;

        $links[] = [
            'url' => url() . $GLOBALS['path'] . '?' . http_build_query($queries),
            'isActive' => $i == $current_pages ? 'active' : '',
            'pageNumber' => $i,

        ];
    };
    //data for pagination
    $lists = [
        'row_total' => $row_total,
        'limit' => $limit,
        'total_pages' => $total_pages,
        'current_pages' => $current_pages,
        'data' => all($sql),
        'links' => $links
    ];
    return $lists;
}
///alert message
function alert(string $message, string $color = "success"): string
{
    return "<div class=' alert alert-$color  text-dark'>
    $message
    </div>";
};
//Pagination Ui function component
function paginationUI($lists)
{
    $links = "";
    foreach ($lists['links'] as $key => $value) {
        $links .= " <li class='page-item'><a class='page-link " . $value["isActive"] . "' href='" . $value['url'] . "'>" . $value['pageNumber'] . "</a></li>";
    }
    return "<div class=' d-flex align-items-center justify-content-between'>
    <p class=' mb-0'>Total rows: " . $lists['row_total'] . "</p>
    <nav aria-label='Page navigation example'>
        <ul class='pagination'>
           
          " . $links . "
       
        </ul>
    </nav>
</div>";
}
//session function start 
function setSession(string $message, string $key = 'message'): void
{
    $_SESSION[$key] = $message;
};
function hasSession(string $key = "message"): bool
{
    if (!empty($_SESSION[$key]))  return true;

    return false;
}
function showSession(string $key = 'message'): string
{
    $message = $_SESSION[$key];
    unset($_SESSION[$key]);
    return $message;
};
//color logger where color code are called ANSI code //32 for green ,31 for red 93 for yellow ,34 for blue
function logger(string $message, int $colorCode = 32): void
{
    echo "\e[39m[LOG]-" . "\e[{$colorCode}m" . $message . "\n";
};
