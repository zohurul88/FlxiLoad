<?php		
include_once("include/require.php");
require_once("layout/header.php"); ?>
    
    <section class="row-fluid"> 
    	<?php require_once("layout/leftPannel.php"); ?>
        
    	<div class="span10 ">
      		<div class="row-fluid" >
            		<div class="span12">
                    	<div class="row-fluid" id="content_header"> 
							<h4 class="contentTitle">My Complete Flexi</h4>
                            <hr class="match" />
                            
                            <div class="row-fluid">
                            	<div class="span10 offset1" id="select_date"> 
                                	<div class="controls-group">
                                    
                                  	  <span class="help-inline"> Form </span><input id="datepicker" class=" input-medium" type="text" placeholder="click to show date">
                                   	<span class="help-inline"> To </span> <input id="datepicker2" class="span2" type="text" placeholder="click to show date">
                                    <span class="help-inline"> Oparetor  </span> 
                                    <select class="span2"> 
                                    	<option> None </option> 
                                        <option> Grameen </option>  
                                        <option> Banglalink </option>  
                                        <option> Robi  </option> 
                                        <option> Teletalk </option>  
                                        <option> Citycell </option> 
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
                            	        	<th>Status</th>
                            	        	 
                            	        </tr>
                            	    </thead>
                            	    <tbody> 
                            	    	<tr> 
                            	        	<td>Username</td>
                            	        	<td>Identification</td>
                            	        	<td>Balance</td>
                            	        	<td>Add Balance</td>
                            	        	<td>Return Balance</td>
                            	        	<td>Status</td>
                            	        	<td>Vew Payments</td>
                            	        	<td>Vew Flexis</td>
                            	    
                            	        </tr>
                            	    </tbody>
                            	</table>
                            </div>
                            <div class="row-fluid"> 
                                	    <div class="pagination pagination-centered pagination-small">
                                                <ul>
                                                <li><a href="#">Prev</a></li>
                                                <li><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#">5</a></li>
                                                <li><a href="#">Next</a></li>
                                                </ul>
                                                </div>
                              
                            </div>
                        </div>
                        
                     </div>
            </div>

        </div>
    </section>
 
 <?php		require_once("layout/footer.php"); ?>