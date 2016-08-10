<?php		
include_once("include/require.php");
require_once("layout/header.php"); ?>
    
    <section class="row-fluid"> 
    	<?php require_once("layout/leftPannel.php"); ?>
        
    	<div class="span10 ">
      		<div class="row-fluid" >
            		<div class="span12">
                    	<div class="row-fluid" id="content_header"> 
							<h4 class="contentTitle">Pending Flexi Load </h4>
                            <hr class="match" />
                            
                            <div class="row-fluid">
                            	<div class="span10 offset1" id="select_date"> 
                                	<div class="controls-group">
                                    
                                  	  <span class="help-inline"> Form </span><input id="datepicker" class=" input-medium" type="text" placeholder="click to show date">
                                   	<span class="help-inline"> To </span> <input id="datepicker2" class="span2" type="text" placeholder="click to show date">
                                    <span class="help-inline"> Oparetor  </span> 
                                    <select class="span2"> 
                                    	<?php
											echo oparetor(true);
										?>
                                    </select>
                                    &nbsp;
                                    <input type="button" class="btn btn-info" value="Search" /> 
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row-fluid">
                            	<table class="table table-bordered"> 
                            		<thead> 
                            	    	<tr> 
                            	        	<th>ID </th>
                            	        	<th>Date </th>
                            	        	<th>User Name </th>
                            	        	<th>Created By</th>
                            	        	<th>Number </th>
                            	        	<th>Operator </th>
                            	        	<th>Amount </th>
                                            <th>Transaction Id </th>
                            	        	<th>Status</th>
                            	        	 
                            	        </tr>
                            	    </thead>
                            	    <tbody> 
 										<?php
											echo $flex->get_flex_info("Pending");
										?>
                            	    </tbody>
                            	</table>
                            </div>
                            
                        </div>
                        
                     </div>
            </div>

        </div>
    </section>
 
 <?php		require_once("layout/footer.php"); ?>