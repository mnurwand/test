<?php
class getDims
{
    public function getConn() {
        $myServer = "DESKTOP-04LDKP6\SQLEXPRESS";
        $myUser = "TEST";
        $myPass = "1234";
        $myDB = "TEST";

        try  
        {
        $conn = new PDO( "sqlsrv:server=$myServer ; Database=$myDB", $myUser, $myPass);  
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
        return $conn;
        }  
        catch(Exception $e)  
        {   
        die( print_r( $e->getMessage() ) );   
        }  

    }
    public function saveMAFinal() {
        $stmt = $this->getConn()->prepare("insert into [dbo].[mgmt_action] select * from [dbo].[mgmt_action_temp]");
        $stmt->execute();
        echo "insert successful";

        $stmt = $this->getConn()->prepare("delete from [dbo].[mgmt_action_temp]");
        $stmt->execute();
        echo "delete successful";
    }

    public function saveMATemp($cycle, $MLE, $CCY, $IG, $action, $RSM_LN, $cpty, $Amount, $cpty_ccy, $ula, $comment){
        $stmt = $this->getConn()->prepare("insert into [dbo].[mgmt_action_temp]
                                            ([cycle_number]
                                            ,[short_name]
                                            ,[currency]
                                            ,[internal_flag]
                                            ,[action]
                                            ,[product_name]
                                            ,[counterparty]
                                            ,[amount]
                                            ,[counterparty_currency]
                                            ,[ULA_Group]
                                            ,[comment])
                                            values
                                            (:cycle
                                            , :mle
                                            , :ccy
                                            , :IG
                                            , :action
                                            , :RSM_LN
                                            , :cpty
                                            , :amount
                                            , :cpty_ccy
                                            , :ULA
                                            , :comment)");

        $stmt->execute([":cycle" => $cycle
                        ,":mle" => str_replace("_"," ",$MLE)
                        ,":ccy" => $CCY
                        ,":IG" => $IG
                        ,":action" => $action
                        ,":RSM_LN" => $RSM_LN
                        ,":cpty" => $cpty
                        ,":amount" => floatval($Amount)
                        ,":cpty_ccy" => $cpty_ccy
                        ,":ULA" => $ula
                        ,":comment" => $comment]);
        
        echo "insert successful";
    }
    
    public function retrieveFullList($sqlQuery, $selectTitle, $colName){

        $stmt = $this->getConn()->query( $sqlQuery );
        
        $HTMLList =  $HTMLList .  "<option selected value='' disabled=''>Select ".str_replace("_"," ",$selectTitle)."</option>"; 
        while ($row = $stmt->fetch()){

            $HTMLList = $HTMLList . "<option value=" . str_replace(" ","_",$row[$colName]) . ">" . $row[$colName] . "</option>";
       
        }

        return $HTMLList;
    }

    public function getStartDate($CycleId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT StartDate FROM cycle WHERE CycleNum = :cycle");
        $stmt->execute([":cycle" => $CycleId]);

        $row = $stmt->fetch();
        $result = $row['StartDate'];
        return $result;
        
    }
    
    public function getEndDate($CycleId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT EndDate FROM cycle WHERE CycleNum = :cycle");
        $stmt->execute([":cycle" => $CycleId]);

        $row = $stmt->fetch();
        $result = $row['EndDate'];
        return $result;
        
    }
    public function getRegion($MLEId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT Region FROM MLE WHERE MLE = :MLE");
        $stmt->execute([":MLE" => str_replace("_"," ",$MLEId)]);

        $row = $stmt->fetch();
        $result = $row['Region'];
        return $result;
        
    }

    public function getCurrencybyMLE($MLEId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT ccy FROM MLE WHERE MLE = :MLE");
        $stmt->execute([":MLE" => str_replace("_"," ",$MLEId)]);
        
        $HTMLList =  $HTMLList .  "<option selected value='' disabled=''>Select Currency</option>"; 
        while ($row = $stmt->fetch()){

            $HTMLList = $HTMLList . "<option value=" . str_replace(" ","_",$row['ccy']) . ">" . $row['ccy'] . "</option>";
            
        }
        return $HTMLList;
        
    }

    public function getCptybyMLE($MLEId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT cpty FROM MLE WHERE MLE = :MLE");
        $stmt->execute([":MLE" => str_replace("_"," ",$MLEId)]);
        
        $HTMLList =  $HTMLList .  "<option selected value='' disabled=''>Select Counterparty</option>"; 
        while ($row = $stmt->fetch()){

            $HTMLList = $HTMLList . "<option value=" . str_replace(" ","_",$row['cpty']) . ">" . $row['cpty'] . "</option>";
            
        }
        return $HTMLList;
        
    }
    public function getMAction($IGId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT action FROM mgmt_action_list WHERE Internal_Flag = :IG");
        $stmt->execute([":IG" => str_replace("_"," ",$IGId)]);
        
        $HTMLList =  $HTMLList .  "<option selected value='' disabled=''>Select Management Action</option>"; 
        while ($row = $stmt->fetch()){

            $HTMLList = $HTMLList . "<option value=" . str_replace(" ","_",$row['action']) . ">" . $row['action'] . "</option>";
            
        }
        return $HTMLList;
        
    }
    public function getRSMLineByAction($MAId, $IGid)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT RSM_LN FROM mgmt_action_list WHERE action = :MA and Internal_Flag = :Internal_Flag");
        $stmt->execute([":MA" => str_replace("_"," ",$MAId)
                        ,":Internal_Flag" => $IGid]);
        
        $HTMLList =  $HTMLList .  "<option selected value='' disabled=''>Select Management Action</option>"; 
        while ($row = $stmt->fetch()){

            $HTMLList = $HTMLList . "<option value=" . str_replace(" ","_",$row['RSM_LN']) . ">" . $row['RSM_LN'] . "</option>";
            
        }
        return $HTMLList;
        
    }
    public function getRSML1byLine($LNId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT RSM_L1 FROM mgmt_action_list WHERE RSM_LN = :RSM_LN");
        $stmt->execute([":RSM_LN" => str_replace("_"," ",$LNId)]);
        
        $row = $stmt->fetch();
        $result = $row['RSM_L1'];
        return $result;
        
    }
    public function getRSML2byLine($LNId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT RSM_L2 FROM mgmt_action_list WHERE RSM_LN = :RSM_LN");
        $stmt->execute([":RSM_LN" => str_replace("_"," ",$LNId)]);
        
        $row = $stmt->fetch();
        $result = $row['RSM_L2'];
        return $result;
        
    }
    public function getRSML3byLine($LNId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT RSM_L3 FROM mgmt_action_list WHERE RSM_LN = :RSM_LN");
        $stmt->execute([":RSM_LN" => str_replace("_"," ",$LNId)]);
        
        $row = $stmt->fetch();
        $result = $row['RSM_L3'];
        return $result;
        
    }
    public function getRSML4byLine($LNId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT RSM_L4 FROM mgmt_action_list WHERE RSM_LN = :RSM_LN");
        $stmt->execute([":RSM_LN" => str_replace("_"," ",$LNId)]);
        
        $row = $stmt->fetch();
        $result = $row['RSM_L4'];
        return $result;
        
    }
    public function getULA($LNId)
    {
        $stmt = $this->getConn()->prepare("SELECT DISTINCT ULA_Group FROM mgmt_action_list WHERE RSM_LN = :LN");
        $stmt->execute([":LN" => str_replace("_"," ",$LNId)]);
         
            $HTMLList = $HTMLList . "<option selected value='' disabled=''>Select ULA Group</option>"; 

            while ($row = $stmt->fetch()){

                if(is_null($row['ULA_Group'])) {
                    $HTMLList = $HTMLList . "<option value='NA'>NA</option>";
                }
                else{
                    $HTMLList = $HTMLList . "<option value=" . str_replace(" ","_",$row['ULA_Group']) . ">" . $row['ULA_Group'] . "</option>";
                }
            }

        $HTMLList = $HTMLList . "</select>";
        return $HTMLList;
        
    }
}
    
?>
