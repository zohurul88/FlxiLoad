<?php		
include_once("include/require.php");
require_once("layout/header.php"); 
	$error="";
	if(isset($_POST["mobile"]))
	{
		$error=$flex->send_flex($_POST["num_type"],$_POST["mobile"],$_POST["amount"]);
	}
?>
    
    <section class="row-fluid"> 
    	<?php require_once("layout/leftPannel.php"); ?>
        
    	<div class="span10 ">
      		<div class="row-fluid" >
            		<div class="span12">
                    	<div class="row-fluid" id="content_header"> 
							<h4 class="contentTitle">Request Flexi </h4>
                            <hr class="match" />
                            
                            <div class="span5 offset3">
                            <?php echo $error; ?>
                        <form class="form-horizontal" method="post">
                            <div class="control-group">
                            <label class="control-label" for="inputEmail">Number Type </label>
                            <div class="controls">
                           <select name="num_type">
                           <?php
                                echo number_type(false);
     						?>
                            </select>
                            </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label" for="inputPassword">Mobile Number</label>
                            <div class="controls">
                            <input type="text" name="mobile"   placeholder="Mobile Number ">
                            </div>
                            </div>
                            
                            <div class="control-group">
                            <label class="control-label" for="">Fix Amount </label>
                            <div class="controls">
                            <input type="text" name="amount" class="input-mini"   placeholder="amount ">
                            </div>
                            </div>
                            <div class="control-group">
                            <div class="controls">
                           
                            <button type="submit" class="btn">Sign in</button>
                            </div>
                            </div>
                            </form>
                            
                            </div>
                            
                        </div>
                        
                     </div>
            </div>

        </div>
    </section>
 
 <?php		require_once("layout/footer.php"); ?>