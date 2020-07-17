<?php

if(! empty($_POST["RSMLN"])){
    
    include "../dbConnect.php";
    $dbConn = new getDims();
    
    echo $dbConn->getRSML1byLine($_POST["RSMLN"]);  
}
else {
    alert("empty");
}
?>