<?php

if(! empty($_POST["RSMLN"])){
    
    include "../dbConnect.php";
    $dbConn = new getDims();
    
    echo $dbConn->getULA($_POST["RSMLN"]);  
}
else {
    alert("empty");
}
?>