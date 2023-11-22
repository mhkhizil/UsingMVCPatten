<?php
function url(string $path=null):string 
{
    $url=isset($_SERVER["HTTPS"])?'https':'http';
    $url.='://';
    $url.=$_SERVER["HTTP_HOST"];
    if(isset($path)){
        $url.='/';
        $url.=$path;
    }

return$url;
};
function dd ($data,bool $showType=false):void{
    echo "<pre style='line-height:1.2rem;background-color:black;color:white;margin:10px;padding:20px;border-radius:10px'>";
    if($showType){
        var_dump($data);
    }else{
        print_r($data);
    }
    echo "</pre>";
    die();
    };
    function view(string $name ,array $data=null):void{
        //array to variable
        if (!is_null($data)) {
             foreach ($data as $key => $value) {
                //dynamic variable name
                ${$key}=$value;
              
             }
           
        };
       
        require_once ViewDir."/$name.view.php";
    }
    //This function will be call within route(index.php) to use function inside a controller file that will in turn call view 
    function controller(string $controllerName):void{
        $controllerNameArray=explode("@",$controllerName);
        require_once ControllerDir."/$controllerNameArray[0].controller.php";
        //dynamic function call
        call_user_func($controllerNameArray[1]);
    };
    function route(string $path,array $queries=null):string{
        $url=url($path);
        if (!is_null($queries)) {
            $url.='?'.http_build_query($queries);
        }
    return $url;
    };
    function redirect(string $url ):void{
        header("LOCATION:".$url);
    };
    function checkReqMethod(string $methodName){
        $result=false;
        $methodName=strtoupper($methodName);
        $serverRequestMethod=$_SERVER["REQUEST_METHOD"];
        if ($methodName==="POST" && $serverRequestMethod === "POST") {
           $result=true;
        }elseif ($methodName==="PUT" && $serverRequestMethod === "POST" && !empty($_POST["_method"]) && strtoupper($_POST["_method"])==="PUT") {
            $result=true;
        }elseif ($methodName==="DELETE" && $serverRequestMethod === "POST" && !empty($_POST["_method"]) && strtoupper($_POST["_method"])==="DELETE") {
            $result=true;
        };;
        return $result;
    }