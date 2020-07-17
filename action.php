
    <?php 
        if ($_POST['action-button'] == 'next'){
            if(isset($_POST['Cpty_list'])) {
                $Cpty = $_POST['Cpty_list'];
                //echo $Cpty;
            }
            else {
                $Cpty = 'NA';
            } ;
            
            if(isset($_POST['comment'])) {
                $comment = $_POST['comment'];
                //echo $Cpty;
            }
            else {
                $comment = '';
            } ;

            include "dbConnect.php";
            $dbConn = new getDims();
            //$dbConn->saveMATemp('4', 'NY_BRANCH', 'USD', 'External', 'Buy_Securities', 'L1_Agency_MBS', 'NA', '1231231', 'USD', 'SIRR', '')
            $dbConn->saveMATemp($_POST['Cycle']
                                ,$_POST["MLE"]
                                , $_POST['Currency']
                                , $_POST['Internal_Flag']
                                , $_POST['MgmtAction']
                                , $_POST['RSMLN']
                                , $Cpty
                                , $_POST['amount']
                                , $_POST['Currency']
                                , $_POST['ULA_Grp_list']
                                , $comment);  
        }
        elseif ($_POST['action-button'] == 'save'){
            include "dbConnect.php";
            $dbConn = new getDims();
            $dbConn->saveMAFinal();
        }
        else {
            echo "no action";
        }
        
    ?> 
    <form action="index.php">
        <button type="submit" class="btn btn-secondary" id="Return">Return to main page</button>
    </form>
