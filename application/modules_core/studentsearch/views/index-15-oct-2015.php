<div class="col-lg-offset-2 margintop50px"> 
    <form class="form-inline" action="<?php echo site_url('studentsearch/index')?>" method="post">
    
          <div class="form-group">
          	     <label for="exampleInputName2"></label>
                <input type="text" class="form-control" id="gen_specialization" name="gen_specialization" placeholder="Specialization">
          </div>
          
          <div class="form-group">
          	    <label for="exampleInputName2"></label>
                <input type="text" class="form-control" id="gen_institute" name="gen_institute" placeholder="Institute Name">
          </div>
          
          <div class="form-group">
          		 <label for="exampleInputName2"></label>
                <input type="text" class="form-control" placeholder="Current Location" id="gen_location" name="gen_location">
          </div>
        
          <label for="exampleInputName2"></label>
          <button type="submit" class="btn btn-info" name="gensearch" id="gensearch" value="Search" onclick="return checkvalidations('basic')">Search</button>  <span>&nbsp;</span> <span>&nbsp;</span>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Advanced Search</button>
          
    </form>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header searchmodalheading">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Advanced Search</h4>
                    </div>
                    
                    <form class="form-horizontal" action="<?php echo site_url('studentsearch/index')?>" method="post">
                    
                    <div class="modal-body">
                  			                              
                              <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Specialization</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="adv_spe" name="adv_spe" placeholder="Specialization">
                                    </div>
                              </div>
                                                      
                             <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Institute</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="adv_school" name="adv_school" placeholder="Institute Name">
                                    </div>
                             </div>
                        	 
                             <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Summary</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="adv_summary" name="adv_summary" placeholder="Resume headline,Summary">
                                    </div>
                              </div>	
                            
                              <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Keykills</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="adv_keyskills" name="adv_keyskills" placeholder="Skills,Role">
                                    </div>
                              </div>
                              
                              <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Current Location</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="adv_location" name="adv_location" placeholder="Current Location">
                                    </div>
                              </div>
                              
                               <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Preferred Location</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="adv_preffered" name="adv_preffered" placeholder="Preferred Location">
                                    </div>
                              </div>
                              
                              <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Designation</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="adv_designation" name="adv_designation" placeholder="Designation">
                                    </div>
                              </div>
                              
                              <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Work Profile</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="adv_profile" name="adv_profile" placeholder="Work Profile">
                                    </div>
                              </div>
                              
                              <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Language</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="adv_lanugage" name="adv_lanugage" placeholder="Language">
                                    </div>
                              </div>
                              
                              <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Work Experience</label>
                                    <div class="col-sm-3">
                                       <select type="text" class="form-control qsbfield" id="adv_exp_min" name="adv_exp_min" placeholder="Salary">
                                            <option value="">Min</option>
											<?php $i=30; $a=0; while($a<$i) { $a++; if($a==30) { $a="30+"; }?>
                                                  <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                            <?php } ?>
                                        </select>
                                      	<span>&nbsp;</span>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                       <select type="text" class="form-control qsbfield"  id="adv_exp_max" name="adv_exp_max">
                                            <option value="">Max</option>
											<?php $i=30; $a=0; while($a<$i) { $a++; if($a==30) { $a="30+"; }?>
                                                  <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                      <div class="col-sm-4">
                                     	In Years
                                     </div>
                                     
                              </div>
                              
                              <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Salary</label>
                                    <div class="col-sm-3">
                                       <select type="text" class="form-control qsbfield"  id="adv_sal_min" name="adv_sal_min">
                                            <option value="">Min</option>
                                            <option value="1"><1 Lac</option>
										    <?php $i=30; $a=1; while($a<$i) { $a++; if($a==30) { $a="30+"; }?>
                                                  <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span>&nbsp;</span>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                       <select type="text" class="form-control qsbfield"  id="adv_sal_max" name="adv_sal_max">
                                             <option value="">Max</option>
                                             <option value="1"><1 Lac</option>
											  <?php $i=30; $a=1; while($a<$i) { $a++; if($a==30) { $a="30+"; }?>
                                                      <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                              <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                     	In Lakhs
                                    </div>
                             </div>
                              
                              <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Last Updated</label>
                                    <div class="col-sm-3">
                                    	 <input type="text" class="form-control" id="adv_datefrom" name="adv_datefrom" placeholder="From Date">
                                          <span>&nbsp;</span>
                                    </div>
                                    
                                    <div class="col-md-3">
                                   		 <input type="text" class="form-control" id="adv_dateto" name="adv_dateto" placeholder="To Date">
                                    </div>
                              </div>
                         
                    </div>
                  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="advsearch" id="advsearch" value="Search" onclick="return checkvalidations('advance')">Search</button>
                    </div>
                    
                    </form>     
            </div>
      </div>
</div>

<?php 
	  if(!empty($result)) 
	  {
?>
		<div class="div col-md-8 col-md-offset-2 margintop20px" align="right">
        		  Select All Students <input name="selectall" id="selectall" type="checkbox" value="select all" onclick="return makelallselect()" /> &nbsp; &nbsp;
                  
        		  <button type="button" class="btn btn-primary" onclick="return opensendemail()">Send Email</button> 
        </div>
        
		<div class="div col-md-8 col-md-offset-2 margintop20px">
    
                  <table id="user-dataTable" class="table table-striped table-bordered  no-wrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Student Details</th>
                            </tr>
                        </thead>
                                
                        <tbody>
                              <?php 
							  		foreach($result as $res) 
									{ 
							  ?>
                                            <tr>
                                                <td> 
                                                   
                                                     <?php 
													 	    $user_id=$res->user_id;
													
                                                     		$query=$this->db->query("select * from users where id ='".$user_id."' ");
															$row=$query->result();
															if(!empty($row))
															{
                                                     ?> 
                                                     		<div class="row">
                                                                    <div class="col-md-12">
                                                                     		<?php echo ucfirst($row[0]->first_name)." ".ucfirst($row[0]->last_name);?>
                                                                            <input name="checkuser" type="checkbox" value="<?php echo $res->page_id;?>" class="sendemailchk"/>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                     		<?php echo "Email : ".$row[0]->email; ?>
                                                                    </div>
                                                                      <div class="col-md-12">
                                                                     		<?php echo "Cell : ".$row[0]->phone; ?>
                                                                    </div> 
                                                   			 </div> 
													 <?php 
															}
													 ?>
                                                  
                                                	 <div class="row margintop15px">
                                                     	  <div class="col-md-12">
                                                          		<a href="#">
                                                                        <span class="studentrole">
                                                                            <?php echo $res->role;?> 
                                                                            <?php if($res->resume_headline!="") { echo "/ ".$res->resume_headline; }?>
                                                                            <?php if($res->total_exp!="") { echo "(".$res->total_exp." yrs Exp.)"; }?>
                                                                        </span>
                                                                 </a>       
                                                           </div>     
                                                     </div>
                                                     
                                                     <?php 
													 	    $page_id=$res->page_id;
													
                                                     		$query=$this->db->query("select * from jobseeker_work_exp where page_id ='".$page_id."' ");
															$row=$query->result();
															if(!empty($row))
															{
                                                     ?> 
                                                     		<div class="row margintop15px">
                                                                    <div class="col-md-12">
                                                                     		<?php echo $row[0]->Company_name;?>
                                                                    </div> 
                                                   			 </div> 
													 <?php 
															}
													 ?>
                                                     
                                                     <div class="row margintop15px">
                                                     		<div class="col-md-2 col-lg-1">
                                                     		  	<span><img src="<?php echo base_url()."assets/img/student_exp.png";?>"/>  <?php if($res->total_exp!="") { echo $res->total_exp." yrs"; }?></span>
                                                            </div> 
                                                            
                                                            <div class="col-md-10 col-lg-11"> 
                                                             	 <span><img src="<?php echo base_url()."assets/img/student_location.png";?>"/>  <?php if($res->location!="") { echo $res->location; }?></span>
                                                            </div>  
                                                     </div> 
                                                     
                                                     <div class="row">&nbsp;</div> 
                                                     
                                                      <div class="row">
                                                     		<div class="col-md-2 col-lg-1">
                                                     		  	Keyskills:
                                                                	<?php 
																		$page_id=$res->page_id;
																
																		$query=$this->db->query("select * from jobseeker_prof_skills where page_id ='".$page_id."' ");
																		$row=$query->result();
																		if(!empty($row))
																		{
																			$skills="";
																			foreach($row as $row)
																			{
																				if($skills!="")
																				{
																					$skills.=", ".$row->name;
																				}
																				else
																				{
																					$skills=$row->name;
																				}
																			}
																		}
																 ?> 
                                                            </div> 
                                                            
                                                            <div class="col-md-10 col-lg-11"> 
                                                             	<?php echo $skills;?>
                                                            </div>  
                                                      </div>
                                                      
                                                      <div class="row">&nbsp;</div>
                                                      
                                                      <div class="row">
                                                     		<div class="col-md-3 col-lg-2">
                                                     		  	Job Description:
                                                            </div> 
                                                            
                                                            <div class="col-md-9 col-lg-10"> 
                                                             	<?php if($res->summery!="") { echo $res->summery; }?>
                                                            </div>  
                                                      </div>   
                                                      
                                                      <div class="row">&nbsp;</div>
                                                      
                                                       <div class="row">
                                                     		<div class="col-md-2 col-lg-1">
                                                     		  	Salary:
                                                            </div> 
                                                            
                                                            <div class="col-md-10 col-lg-11"> 
                                                             	<?php if($res->salary!="") { echo "<i class='fa fa-inr'></i> ".$res->salary." LPA"; } else { echo "Not disclosed"; }?>
                                                            </div>  
                                                      </div>   
                                                      
                                                      <div class="row margintop15px">
                                                     		<div class="col-md-12 col-lg-12 studentlastupdate">
                                                     		  	Last Updated: <?php if($res->last_updated!="") { echo date('d/m/Y',$res->last_updated); }?>
                                                            </div> 
                                                      </div>   
                                                </td>
                                            </tr>
                                    <?php 
							  		}
                                ?>
                              
                        </tbody>
                    
                    </table>
    
           </div>  
   
		   <script>
                    $(document).ready( function () {
                        $("#user-dataTable").DataTable({
                            ordering: true,
                            "pageLength": 10,
                            responsive: true
                        });
                    } );
            </script> 
<?php } ?>

<?php 
	if(empty($result) && !empty($is_search)) 
    {  
?>
		<div class="row margintop50px">
        	 <div class="col-md-6 col-md-offset-3">	
        		No Result Found!!!
             </div>   
        </div>	
<?php
    }
 ?>
 
 <div class="modal fade" id="myModalEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header searchmodalheading">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send Email To Selected Students</h4>
      </div>
      
      <div class="modal-body">
            <form>
                      <div class="form-group">
                       			<input type="text" class="form-control" id="email_subject" name="email_subject" placeholder="Email Subject">
                      </div>
                      
                      <div class="form-group">
                            <textarea name="emailcontents" id="emailcontents" placeholder="Write Your Email Contents Here....." class="form-control"></textarea>
                      </div>
            </form>          
       </div>
      
      <div class="modal-footer">
      	<input type="hidden" name="allids" id="allids" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="return sendemail()">Send Email</button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 
 <script language="javascript">
 		
		function checkvalidations(type)
		{
			if(type=='basic')
			{
				var gen_specialization=$('#gen_specialization').val();
				var gen_institute=$('#gen_institute').val();
				var gen_location=$('#gen_location').val();
				
				if(gen_specialization=="" && gen_institute=="" && gen_location=="")
				{
					alert("Please enter at least one field for search");
					$('#gen_specialization').focus();
					return false;	
				}
			}
			else
			{
				var adv_spe=$('#adv_spe').val();
				var adv_school=$('#adv_school').val();
				var adv_summary=$('#adv_summary').val();
				var adv_keyskills=$('#adv_keyskills').val();
				var adv_location=$('#adv_location').val();
				var adv_preffered=$('#adv_preffered').val();
				var adv_designation=$('#adv_designation').val();
				var adv_profile=$('#adv_profile').val();
				var adv_lanugage=$('#adv_lanugage').val();
				var adv_exp_min=$('#adv_exp_min').val();
				var adv_exp_max=$('#adv_exp_max').val();
				var adv_sal_min=$('#adv_sal_min').val();
				var adv_sal_max=$('#adv_sal_max').val();
				var adv_datefrom=$('#adv_datefrom').val();
				var adv_dateto=$('#adv_dateto').val();
				
				if(adv_spe=="" && adv_school=="" && adv_summary=="" && adv_keyskills=="" && adv_location=="" && adv_preffered=="" && adv_designation=="" && adv_profile=="" && adv_lanugage=="" && adv_exp_min=="" && adv_exp_max=="" && adv_sal_min=="" && adv_sal_max=="" && adv_datefrom=="" && adv_dateto=="")
				{
					alert("Please enter at least one field for search");
					$('#adv_spe').focus();
					return false;	
				}
			}
		}
		
		function makelallselect()
		{
			var cboxes=document.getElementsByName('checkuser');
			var len = cboxes.length;
				
			if(document.getElementById('selectall').checked==true)
			{
				for (var i=0; i<len; i++) 
				{
					cboxes[i].checked=true;
				}
			}
			else
			{
				for (var i=0; i<len; i++) 
				{
					cboxes[i].checked=false;
				}	
			}
		}
		
		function sendemail()
		{
			var allids=$('#allids').val();
			var emailcnt=$('#emailcontents').val();
			var emailsub=$('#email_subject').val();
			
			if(emailsub=="")
			{
				alert("Please enter text for subject.");
				$('#email_subject').focus();
				return false;	
			}
			else if(emailcnt=="")
			{
				alert("Please enter text for email.");
				$('#emailcontents').focus();
				return false;	
			}
			else
			{
				var post_url = "<?php echo site_url('studentsearch/sendemail');?>";
					$.ajax({
					type: "post",
					url: post_url,
					data: { allids:allids, emailcnt:emailcnt, emailsub:emailsub},
					success: function(result)
					{
						var res=result.trim();
						
						if(res=="success")
						{
							alert("Email Send Successfully!");
							$("#myModalEmail").modal('hide');
							
						}
						else
						{
							alert("Sorry! Something went wrong.");	
						}
					}
				});
			}
		}
		
		function opensendemail()
		{
			var cboxes=document.getElementsByName('checkuser');
			
			var len = cboxes.length;
			
			var allusers="";;
			
			for (var i=0; i<len; i++) 
			{
				if(cboxes[i].checked ==true)
				{
					if(allusers=="")
					{
						allusers=cboxes[i].value;
					}
					else
					{
						allusers+=","+cboxes[i].value;
					}
				}
			}
			
			if(allusers=="")
			{
				alert("Please select student to send email");
				return false;
			}
			else
			{
				$("#myModalEmail").modal('show');
				$("#allids").val(allusers);
			}
		}
		 
		$(function() {
    		$( "#adv_datefrom" ).datepicker();
			$( "#adv_dateto" ).datepicker();
 		}); 
 </script>

