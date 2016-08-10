<?php		
include_once("include/require.php");
require_once("layout/header.php"); 
$error="";
?>

    <?php
		if(isset($_POST["user"]))
		{
			$active=NULL;
			$_POST["pass"]=md5($_POST["pass"]);
			if(isset($_POST["active"]))
			{
				$active=$_POST["active"];
				$_POST["active"]="";
			}
			$error=$log->create_new($_POST,$active);
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
                            <span class="label label-important"><?php echo $error;?></span>
                        <form class="form-horizontal" method="post">
                            <div class="control-group">
                            <label class="control-label" for="inputEmail">User Name  </label>
                            <div class="controls">
                           		 <input type="text" name="user" class=" input-large"   placeholder="User Name">
                            </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label" for="inputPassword">Password </label>
                            <div class="controls">
                            <input type="password" name="pass" class="input-large"   placeholder="Password ">
                            </div>
                            </div>
                            
                            <div class="control-group">
                            <label class="control-label" for="inputPassword">Identification  </label>
                            <div class="controls">
                            <input type="text" name="Inden" class="input-large"   placeholder="Indentification ">
                            </div>
                            </div>
                            <div class="control-group">
                            
                            <div class="controls">
                           	<label class="checkbox"> 
                            	Active <input type="checkbox" name="active" /> 
                            </label>
                            <input type="submit" class=" btn btn-success btn-large" value="Add "> 
                            <input type="button" class="btn btn-danger" value="Reset " /> 
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