<?php

if(! empty($_POST["Cycle"])){
    
    include "../dbConnect.php";
    $dbConn = new getDims();
    
    echo $dbConn->getEndDate($_POST["Cycle"]);  
}
else {
    alert("empty");
}
?>