<?php		
include_once("include/require.php");
require_once("layout/header.php"); ?>
    
    <section class="row-fluid"> 
    	<?php require_once("layout/leftPannel.php"); ?>
        
    	<div class="span10 ">
      		<div class="row-fluid" >
            		<div class="span12">
                    	<div class="row-fluid" id="content_header"> 
							<h4 class="contentTitle">Reseller II Account List</h4>
                            <hr class="match" />
                            <table class="table table-bordered"> 
                            	<thead> 
                                	<tr> 
                                    	<th>Username</th>
                                    	<th>Identification</th>
                                    	<th>Balance</th>
                                    	<th>Add Balance</th>
                                    	<th>Return Balance</th>
                                    	<th>Status</th>
                                    	<th>Vew Payments</th>
                                    	<th>Vew Flexis</th>
                                    	<th>Reseller Reports</th>
                                    	<th>Edit Reseller</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php
											//print_r($_SESSION);
											$sql=$db->query("SELECT * FROM ".user);
											while($arr=$db->fetch_row($sql)): ?>
                                            <tr> 
                                                <td><?php echo $arr[1]; ?></td>
                                                <td><?php echo $arr[3]; ?></td>
                                                <td>Balance</td>
                                                <td>Add Balance</td>
                                                <td>Return Balance</td>
                                                <td>
                                                <?php
													if($arr[4]=="YES")
													{
														echo "Ok";
													}
													else
													{
														echo "Block";
													}
												?>
                                                </td>
                                                <td>Vew Payments</td>
                                                <td>Vew Flexis</td>
                                                <td>Reseller Reports</td>
                                                <td>Edit Reseller</td>
                                            </tr>
                                        <?php
                                            endwhile;
                                        ?>
                                </tbody>
                            </table>
                            
                        </div>
                        
                     </div>
            </div>

        </div>
    </section>
 
 <?php		require_once("layout/footer.php"); ?>