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
    function controller(string $controllerName):void{
        $controllerNameArray=explode("@",$controllerName);
        require_once ControllerDir."./$controllerNameArray[0].controller.php";
        //dynamic function call
        call_user_func($controllerNameArray[1]);
    }