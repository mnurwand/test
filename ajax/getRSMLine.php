<?php

if(!empty($_POST["MgmtAction"]) && !empty($_POST["Internal_Flag"])){
    
    include "../dbConnect.php";
    $dbConn = new getDims();
    
    echo $dbConn->getRSMLineByAction($_POST["MgmtAction"],$_POST["Internal_Flag"]);  
}
else {
    alert("empty");
}
?>