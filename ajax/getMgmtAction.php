<?php

if(! empty($_POST["Internal_Flag"])){
    
    include "../dbConnect.php";
    $dbConn = new getDims();
    
    echo $dbConn->getMAction($_POST["Internal_Flag"]);  
}
else {
    alert("empty");
}
?>