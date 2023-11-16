<?php

require_once "../index.php";
// if ($_SERVER["REQUEST_URI"]==="/") {
//  require_once ViewDir."/home.view.php";
// }elseif($_SERVER["REQUEST_URI"]==="/about-us"){
// require_once ViewDir."/about.view.php";
// };
 switch ($_SERVER["REQUEST_URI"]) {
    case "/":
      require_once ViewDir."/home.view.php";
        break;
        case "/about-us":
            require_once ViewDir."/about.view.php";
              break;
    
   
 }

// dd($con);