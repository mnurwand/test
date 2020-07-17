<?php

if(! empty($_POST["RSMLN"])){
    
    include "../dbConnect.php";
    $dbConn = new getDims();
    
    echo $dbConn->getRSML2byLine($_POST["RSMLN"]);  
}
else {
    alert("empty");
}
?>