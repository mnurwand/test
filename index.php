<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Management Action</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/testStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <h1 class='display-3'> RRP Management Action </h1>
    <script type='text/javascript'>
    //MLE DEPENDENT SELECTION 
      $(document).ready(function(){
        $("#MLE").change(function(){
            var $LE50kID = this.value;
            
                if($LE50kID != undefined){;
                  //CURRENCY DROPDOWN CHANGE
                    $.ajax({
                        type:'POST',
                        url:'./ajax/getDepCurr.php',
                        data:'MLE='+$LE50kID,
                        success:function(html){
                            $('#Currency').html(html);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    });
                  //REGION CHANGE  
                    $.ajax({
                        type:'POST',
                        url:'./ajax/getRegionbyMLE.php',
                        data:'MLE='+$LE50kID,
                        success:function(text){
                            $('#Region').text(text);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    }); 
                }else{
                    alert("var is undefined");
                    $('#Currency').html('<option value="">Select currency</option>');
                }
            });
          });
    //IG FLAG DEPENDENT SELECTION 
      $(document).ready(function(){
        $("#Internal_Flag").change(function(){
            var $igID = this.value;
            
                if($igID != undefined){;
                  //Mgmt Action DROPDOWN CHANGE
                    $.ajax({
                        type:'POST',
                        url:'./ajax/getMgmtAction.php',
                        data:'Internal_Flag='+$igID,
                        success:function(html){
                            $('#MgmtAction').html(html);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    });
                }else{
                    alert("var is undefined");
                    $('#MgmtAction').html('<option value="">Select Management Action</option>');
                }
            });
          });
    //MANAGEMENT ACTION DEPENDENT SELECTION 
      $(document).ready(function(){
        $("#MgmtAction").change(function(){
            var $MAid = this.value;
            var $igID = $("#Internal_Flag").val();

                if($MAid != undefined){;
                  //RSM LN DROPDOWN CHANGE
                    $.ajax({
                        type:'POST',
                        url:'./ajax/getRSMLine.php',
                        data: {MgmtAction: $MAid, Internal_Flag: $igID},
                        success:function(html){
                            $('#RSMLN').html(html);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    }); 
                }else{
                    alert("var is undefined");
                    $('#RSMLN').html('<option value="">Select RSM Line</option>');
                }
            });
          });
    //RSM LINE DEPENDENT SELECTION 
      $(document).ready(function(){
        $("#RSMLN").change(function(){
            var $LNid = this.value;
            
                if($LNid != undefined){;
                  //RSM L1 CHANGE  
                    $.ajax({
                        type:'POST',
                        url:'./ajax/getRSML1.php',
                        data:'RSMLN='+$LNid,
                        success:function(text){
                            $('#RSML1').text(text);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    });   
                  //ULA GROUP DROPDOWN
                   $.ajax({
                        type:'POST',
                        url:'./ajax/getULAGrp.php',
                        data:'RSMLN='+$LNid,
                        success:function(html){
                            $('#ULA_Grp_list').html(html);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    }); 
                  //RSM L2 CHANGE  
                  $.ajax({
                        type:'POST',
                        url:'./ajax/getRSML2.php',
                        data:'RSMLN='+$LNid,
                        success:function(text){
                            $('#RSML2').text(text);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    });
                  //RSM L3 CHANGE  
                  $.ajax({
                        type:'POST',
                        url:'./ajax/getRSML3.php',
                        data:'RSMLN='+$LNid,
                        success:function(text){
                            $('#RSML3').text(text);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    });
                  //RSM L4 CHANGE  
                  $.ajax({
                        type:'POST',
                        url:'./ajax/getRSML4.php',
                        data:'RSMLN='+$LNid,
                        success:function(text){
                            $('#RSML4').text(text);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    });
                }else{
                    alert("var is undefined");

                }
              });
          });
    //cycle dependent SELECTION
      $(document).ready(function(){
        $("#Cycle").change(function(){
            var $CycleId = this.value;
              
                if($CycleId != undefined){;
                  //get start date
                    $.ajax({
                        type:'POST',
                        url:'./ajax/getStartDatebyCycle.php',
                        data:'Cycle='+$CycleId,
                        success:function(text){
                            $('#StartDate').text(text);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    }); 
                  //get end date
                    $.ajax({
                        type:'POST',
                        url:'./ajax/getEndDatebyCycle.php',
                        data:'Cycle='+$CycleId,
                        success:function(text){
                            $('#EndDate').text(text);
                        },
                        error: function() {
                          alert("error with Ajax");
                        }
                    });
                }
          });
        });
    </script>
  </head>
 

<body>
<form action="action.php" method="post">
  <div class="container-fluid">
    <div class="row">
    </div>
    <div class="row">
      <!-- insert cycle   -->
        <?php
        include "dbConnect.php";
        $dbConnect = new getDims();
        
        
        $dimList = "Cycle";
        $dimCol = "CycleNum";
        echo "<div class='col'>". $dimList .":</div>";
        echo "<div class='col'><select class='form-control' id='" . $dimList . "' name='" . $dimList ."' required>";
        echo $dbConnect->retrieveFullList("select distinct " . $dimCol . " from cycle where cyclenum>0", $dimList, $dimCol);
        echo "</select></div>";
        ?>

      <!-- insert start date   -->  
        <div class='col'>
          Start Date:
        </div>
        <div class='col' id='StartDate'>
        </div>
        
      <!-- insert end date   -->    
        <div class='col'>
          End Date:
        </div>
        <div class='col' id='EndDate'>
        </div>
        <div class='w-100'></div>
    </div>
    <div class="row">
      <!-- insert Region   -->    
        <div class='col'>
          Region:
        </div>
        <div class='col' id='Region'>
        </div>

      <!-- insert MLE   -->  
        <?php
        
        $dimList = "MLE";
        $dimCol = "mle";
        echo "<div class='col'>". $dimList .":</div>";
        echo "<div class='col'><select class='form-control' id='" . $dimList . "' name='" . $dimList ."' required>";
        echo $dbConnect->retrieveFullList("select distinct " . $dimCol . " from mle", $dimList, $dimCol);
        echo "</select></div>";
         ?>

      <!-- insert currency   -->  
        <div class='col'>
          Currency:
        </div>
        <div class='col'>
          <select class='form-control'  name='Currency' id='Currency' required>
            <option selected value=''>Select MLE First<option>
          </select>
        </div>
        <div class='w-100'></div>
    </div>
    <div class="row">
      <!-- insert Internal Flag   -->  
        <?php
        
        $dimList = "Internal_Flag";
        $dimCol = "Internal_Flag";
        echo "<div class='col'>Internal Flag:</div>";
        echo "<div class='col'><select class='form-control' id='" . $dimList . "' name='" . $dimList ."' required>";
        echo $dbConnect->retrieveFullList("select distinct " . $dimCol . " from mgmt_action_list", $dimList, $dimCol);
        echo "</select></div>";
        ?>

      <!-- insert action  -->  
        <div class='col'>
          Management Action:
        </div>
        <div class='col'>
          <select class='form-control'  name='MgmtAction' id='MgmtAction' required>
            <option selected value=''>Select Internal Flag First<option>
          </select>
        </div>
        <div class='w-100'></div>
    </div>
    <div class="row">
      <!-- insert RSM L1   -->    
        <div class='col'>
          RSM Level 1:
        </div>
        <div class='col' id='RSML1'>
        </div>

      <!-- insert RSM L1 OPP  -->    
        <div class='col' class='RSML1-OPP' id='RSML1-O-Label'>
        </div>
        <div class='col' class='RSML1-OPP' id='RSML1-O'>
        </div>        
        <div class='w-100'></div>

      <!-- insert RSM L2   -->    
        <div class='col'>
          RSM Level 2:
        </div>
        <div class='col' id='RSML2'>
        </div>  

      <!-- insert RSM L2 OPP  -->    
        <div class='col' class='RSML2-OPP' id='RSML2-O-Label'>
        </div>
        <div class='col' class='RSML2-OPP' id='RSML2-O'>
        </div>
        <div class='w-100'></div>

      <!-- insert RSM L3   -->    
        <div class='col'>
          RSM Level 3:
        </div>
        <div class='col' id='RSML3'>
        </div>
      <!-- insert RSM L3 OPP  -->    
        <div class='col' class='RSML3-OPP' id='RSML3-O-Label'>
        </div>
        <div class='col' class='RSML3-OPP' id='RSML3-O'>
        </div>
        <div class='w-100'></div>

      <!-- insert RSM L4   -->    
        <div class='col'>
          RSM Level 4:
        </div>
        <div class='col' id='RSML4'>
        </div>
      <!-- insert RSM L4 OPP  -->    
        <div class='col' class='RSML4-OPP' id='RSML4-O-Label'>
        </div>
        <div class='col' class='RSML4-OPP' id='RSML4-O'>
        </div>
        <div class='w-100'></div>
      
      <!-- insert RSM LN  -->  
        <div class='col'>
          RSM Line:
        </div>
        <div class='col'>
          <select class='form-control'  name='RSMLN' id='RSMLN' required>
            <option selected value=''>Select Management Action First<option>
          </select>
        </div>
      <!-- insert RSM LN OPP  -->    
        <div class='col' class='RSMLN-OPP' id='RSML4-O-Label'>
        </div>
        <div class='col' class='RSMLN-OPP' id='RSMLN-O'>
        </div>
        <div class='w-100'></div>
      <!-- insert ULA -->  
        <div class='col' id='ULA_grp'>
          ULA Group:
        </div>
        <div class='col' id='ULA_grp_select'>
          <select class='form-control'  name='ULA_Grp_list' id='ULA_Grp_list' required>
            <option selected value=''>Select RSM Line First<option>
          </select>
        </div>
      <!-- insert Counterparty -->  
        <div class='col' id='Cpty'>
        </div>
        <div class='col' id='Cpty_select'>
          <!-- <select class='form-control'  name='Cpty_list' id='Cpty_list' required>
            <option selected value=''>Select Counterparty<option>
          </select> -->
        </div>
        <div class='w-100'></div>
    </div>
    <div class="row" id='free-form-area'>
      <!-- ENTER amount -->
        <div class='col'>
          <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Amount</span>
          </div>
            <input type="text" class="form-control" name="amount" id="basic-url" aria-describedby="basic-addon3" required>
          </div>
        </div><div class='col'>
        </div>
      <!-- ENTER comment -->
        <div class='col'>
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Comment</span>
          </div>
            <textarea class="form-control" name="comment" aria-label="With textarea"></textarea>
          </div>
        </div>
        <div class='w-100'></div>
    <div>

    <div class="row" >
      <div class='col'>
        <button type="submit" name="action-button" class="btn btn-secondary" id="next" value="next">Next</button>
        <button type="submit" name="action-button" class="btn btn-secondary" id="save" value="save" formnovalidate>Save</button>
        <button type="button" class="btn btn-secondary" id="preview">Preview</button>
        <button type="button" class="btn btn-secondary" id="export">Export</button>
        <button type="reset" class="btn btn-secondary" id="reset">Reset</button>
        <button type="button" class="btn btn-secondary" id="delete_all">Delete All</button>
        <button type="button" class="btn btn-secondary" id="delete_last">Delete Last</button>
      </div>
    </div> 
  </div>
</form> 
 <!-- jQuery (Bootstrap JS plugins depend on it) -->
 

</body>

</html>