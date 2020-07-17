<?php

if(! empty($_POST["MLE"])){
    
    include "../dbConnect.php";
    $dbConn = new getDims();
    
    echo $dbConn->getRegion($_POST["MLE"]);  
}
else {
    alert("empty");
}
?>