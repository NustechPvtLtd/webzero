<?php
   
   if(!defined('BASEPATH')) exit('No direct script access allowed');

   class Studentsearchmodel extends CI_Model
   {
	    function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		public function searchstudents()
		{
			  $specialization=$_POST['gen_specialization'];
			  $location=$_POST['gen_location'];
			  $institute=$_POST['gen_institute'];
			 
			  $found="";
			  $pageid1=array();
			  if($specialization!="")
			  {
					  $searchTerms = explode(",",$specialization); // Split the words
						
					  $query1=$this->db->query("select * from jobseeker_education where degree LIKE '%" . implode("%' || degree LIKE '%", $searchTerms)."%' ");//......1
				      $query1= $query1->result();
					  
					  foreach($query1 as $row)
				      {
							$page=$row->page_id;
							array_push($pageid1,$page);
				      }
					  if(empty($query1)) {  $found="no";}
			  }
			  
			  $pageid4=array();
			  if($location!="")
			  {
					$query4=$this->db->query("select * from jobseeker_profile where location like '%".$location."%' ");//......4
					$query4= $query4->result();
					
					foreach($query4 as $row)
					{
							$page=$row->page_id;
							array_push($pageid4,$page);
					}
					if(empty($query4)) {  $found="no";}
			  }
			  
			  $pageid7=array();
			  if($institute!="")
			  {
				    
					$searchTerms = explode(",",$institute); // Split the words
				  	
					$query7=$this->db->query("select * from jobseeker_education where school LIKE '%" . implode("%' || school LIKE '%", $searchTerms)."%' ");//......7
					$query7= $query7->result();
					
					foreach($query7 as $row)
					{
						    $page=$row->page_id;
							array_push($pageid7,$page);
					}
					if(empty($query7)) {  $found="no";}
			  }
			
			   if($found=='')	
			   {
					   $tempArray = array();
					   
					   if(!empty($pageid1)) { $tempArray[]= $pageid1; }
					   if(!empty($pageid4)) { $tempArray[]=$pageid4; }
					   if(!empty($pageid7)) { $tempArray[]= $pageid7; }
					   $arr_cnt = count($tempArray);
						
					   if($arr_cnt > 1)
					   {	
							$intersect = call_user_func_array('array_intersect', $tempArray);
					   }
					   else if($arr_cnt==1)
					   {
						  foreach ($tempArray as $key=>$val) 
						  {
							 $intersect =$val;
						  }
					   }
					   else
					   {
							$intersect ="";
					   }
					   
					   if(!empty($intersect))
					   {
							 $pid = implode(',',$intersect);
							
							 $query=$this->db->query("select * from jobseeker_profile where page_id IN (".$pid.") order by last_updated desc");
							 return $query->result();
					   }
					   else
					   {
							return "";   
					   }
			   }
			   else
			   {
					return "";   
			   } 
		}
		
		public function searchstudentsadv()
		{
			  $adv_summary=$_POST['adv_summary'];
			  $adv_keyskills=$_POST['adv_keyskills'];
			  $adv_location=$_POST['adv_location'];
			  $adv_designation=$_POST['adv_designation'];
			  $adv_profile=$_POST['adv_profile'];
			  $adv_exp_min=$_POST['adv_exp_min'];
			  $adv_exp_max=$_POST['adv_exp_max'];
			  $adv_sal_min=$_POST['adv_sal_min'];
			  $adv_sal_max=$_POST['adv_sal_max'];
			  $adv_school=$_POST['adv_school'];
			  $adv_lanugage=$_POST['adv_lanugage'];
			  $adv_specialization=$_POST['adv_spe'];
			  $adv_preffered=$_POST['adv_preffered'];
			  
			  $adv_datefrom=$_POST['adv_datefrom'];
			  $adv_dateto=$_POST['adv_dateto'];
			  
			  $found="";
              $pageid0=array();
			  if($adv_summary!="")
			  {
				    $searchTerms = explode(",", $adv_summary); // Split the words
					
					$query0=$this->db->query("select * from jobseeker_profile where resume_headline LIKE '%" . implode("%' || resume_headline LIKE '%", $searchTerms)."%' || summery LIKE '%" . implode("%' || summery LIKE '%", $searchTerms)."%' "); //......0
					$query0= $query0->result();
					
					foreach($query0 as $row)
					{
						$page=$row->page_id;
						array_push($pageid0,$page);
					}
					
					if(empty($query0)) {  $found="no";}
			  }
			 
			  $pageid1=array();
			  if($adv_keyskills!="")
			  {
					  $searchTerms = explode(",",$adv_keyskills); // Split the words
				 	  
					  $searchCondition = "jobseeker_profile.role LIKE '%" . implode("%' || jobseeker_profile.role LIKE '%", $searchTerms) . "%' || jobseeker_prof_skills.name LIKE '%" . implode("%' || jobseeker_prof_skills.name  LIKE '%", $searchTerms) . "%' || pages.pages_meta_keywords LIKE '%" . implode("%' || pages.pages_meta_keywords LIKE '%", $searchTerms) . "%'";
					  	
					  $query1=$this->db->query("select * from jobseeker_profile inner join jobseeker_prof_skills on jobseeker_profile.page_id=jobseeker_prof_skills.page_id inner join pages on jobseeker_profile.page_id=pages.pages_id where($searchCondition) ");//......1
					  
					  $query1= $query1->result();
					  
					  $pageid1=array();
					  foreach($query1 as $row)
					  {
							$page=$row->page_id;
							array_push($pageid1,$page);
					  }
					  
					  if(empty($query1)) {  $found="no";}
			  }
			  
			  $pageid4=array();
			  if($adv_location!="")
			  {
				    $searchTerms = explode(",", $adv_location);
					
					$query4=$this->db->query("select * from jobseeker_profile where location LIKE '%" . implode("%' || location LIKE '%", $searchTerms)."%' ");//......4
					$query4= $query4->result();
					
					foreach($query4 as $row)
					{
							$page=$row->page_id;
							array_push($pageid4,$page);
					}
					
					if(empty($query4)) {  $found="no";}
			  }
		  
		  	  $pageid5=array();
			  if($adv_designation!="")
			  {
				    $searchTerms = explode(",", $adv_designation);
					
					$query5=$this->db->query("select * from jobseeker_work_exp where designation LIKE '%" . implode("%' || designation LIKE '%", $searchTerms)."%'");//......5
					$query5= $query5->result();
					
					foreach($query5 as $row)
					{
							$page=$row->page_id;
							array_push($pageid5,$page);
					}
					
					if(empty($query5)) {  $found="no";}
			  }
			  
			  $pageid6=array();
			  if($adv_profile!="")
			  {
				    $searchTerms = explode(",", $adv_profile);
				   
					$query6=$this->db->query("select * from jobseeker_work_exp where profile LIKE '%" . implode("%' || profile LIKE '%", $searchTerms)."%' ");//......6
					$query6= $query6->result();
					
					foreach($query6 as $row)
					{
							$page=$row->page_id;
							array_push($pageid6,$page);
					}
					
					if(empty($query6)) {  $found="no";}
			  }
			  
			  $pageid7=array();
			  if($adv_exp_min!="" || $adv_exp_max!="")
			  {
				  	if(($adv_exp_min!="" && $adv_exp_max!=""))
					{
						$query7=$this->db->query("select * from jobseeker_profile where total_exp >=".$adv_exp_min." && total_exp <=".$adv_exp_max." ");//......7
					}
					else if(($adv_exp_min!="" && $adv_exp_max==""))
					{
						$query7=$this->db->query("select * from jobseeker_profile where total_exp >=".$adv_exp_min." ");//......7
					}
					else if(($adv_exp_min=="" && $adv_exp_max!=""))
					{
						$query7=$this->db->query("select * from jobseeker_profile where total_exp <=".$adv_exp_max." ");//......7
					}
					
					$query7= $query7->result();
					
					foreach($query7 as $row)
					{
						    $page=$row->page_id;
							array_push($pageid7,$page);
					}
					
					if(empty($query7)) {  $found="no";}
			  }
			  
			  $pageid9=array();
			  if($adv_sal_min!="" || $adv_sal_max!="")
			  {
				  	if($adv_sal_min!="" && $adv_sal_max!="")
					{
							$query9=$this->db->query("select * from jobseeker_profile where salary >=".$adv_sal_min." and salary <=".$adv_sal_max." ");//......9
					}
					else if($adv_sal_min!="" && $adv_sal_max=="")
					{
							$query9=$this->db->query("select * from jobseeker_profile where salary >=".$adv_sal_min." ");//......9
					}
					else if($adv_sal_min=="" && $adv_sal_max!="")
					{
							$query9=$this->db->query("select * from jobseeker_profile where salary <=".$adv_sal_max." ");//......9
					}
					
					$query9= $query9->result();
					
					foreach($query9 as $row)
					{
							$page=$row->page_id;
							array_push($pageid9,$page);
					}
					
					if(empty($query9)) {  $found="no";}
			  }
				
			  $pageid11=array();
			  if($adv_school!="")
			  {
				  $searchTerms = explode(",", $adv_school); // Split the words
			 
				  $query11=$this->db->query("select * from jobseeker_education where school LIKE '%" . implode("%' || school LIKE '%", $searchTerms)."%' ");//......1
				  $query11= $query11->result();
				  
				  foreach($query11 as $row)
				  {
							$page=$row->page_id;
							array_push($pageid11,$page);
				  }
				  
				  if(empty($query11)) {  $found="no";}
			  }
			  
			  $pageid12=array();
			  if($adv_lanugage!="")
			  {
				   $searchTerms = explode(",", $adv_lanugage);
				   
				  $query12=$this->db->query("select * from jobseeker_lang_skills where language LIKE '%" . implode("%' || language LIKE '%", $searchTerms)."%'");//......14
				  $query12= $query12->result();
				  
				  foreach($query12 as $row)
				  {
							$page=$row->page_id;
							array_push($pageid12,$page);
				  }
				  
				  if(empty($query12)) {  $found="no";}
			  }
			  
			  $pageid13=array();
			  if($adv_specialization!="")
			  {
				  $searchTerms = explode(",", $adv_specialization); // Split the words
			    
				  $query13=$this->db->query("select * from jobseeker_education where degree LIKE '%" . implode("%' || degree LIKE '%", $searchTerms)."%' ");//......1
				  $query13= $query13->result();
				  
				  foreach($query13 as $row)
				  {
							$page=$row->page_id;
							array_push($pageid13,$page);
				  }
				  
				  if(empty($query13)) {  $found="no";}
			  }
			  
			  $pageid14=array();
			  if($adv_preffered!="")
			  {
				  $searchTerms = explode(",", $adv_preffered); // Split the words
			 
				  $query14=$this->db->query("select * from jobseeker_profile where preff_location LIKE '%" . implode("%' || preff_location LIKE '%", $searchTerms)."%' ");//......1
				  $query14= $query14->result();
				  
				  foreach($query14 as $row)
				  {
							$page=$row->page_id;
							array_push($pageid14,$page);
				  }
				  
				  if(empty($query14)) {  $found="no";}
			  }
			  
			  $pageid15=array();
			  if($adv_datefrom!="" || $adv_dateto!="")
			  {
				    $adv_datefrom1=strtotime($adv_datefrom); 
					$adv_dateto1=strtotime($adv_dateto); 

				  	if(($adv_datefrom!="" && $adv_dateto!=""))
					{
						$query15=$this->db->query("select * from jobseeker_profile where last_updated >='".$adv_datefrom1."' && last_updated <='".$adv_dateto1."' ");//......7
					}
					else if(($adv_datefrom!="" && $adv_dateto==""))
					{
						$query15=$this->db->query("select * from jobseeker_profile where last_updated >='".$adv_datefrom1."' ");//......7
					}
					else if(($adv_datefrom=="" && $adv_dateto!=""))
					{
						$query15=$this->db->query("select * from jobseeker_profile where last_updated <='".$adv_dateto1."' ");//......7
					}
					
					$query15= $query15->result();
					
					foreach($query15 as $row)
					{
						    $page=$row->page_id;
							array_push($pageid15,$page);
					}
					
					if(empty($query15)) {  $found="no";}
			  }
			
			   if($found=='')	
			   {
					   $tempArray = array();
					   
					   if(!empty($pageid0)) { $tempArray[]= $pageid0; }
					   if(!empty($pageid1)) { $tempArray[]= $pageid1; }
					   if(!empty($pageid4)) { $tempArray[]=$pageid4; }
					   if(!empty($pageid5)) { $tempArray[]= $pageid5; }
					   if(!empty($pageid6)) { $tempArray[]= $pageid6; }
					   if(!empty($pageid7)) { $tempArray[]= $pageid7; }
					   if(!empty($pageid9)) { $tempArray[]= $pageid9; }
					   if(!empty($pageid11)) { $tempArray[]= $pageid11; }
					   if(!empty($pageid12)) { $tempArray[]= $pageid12; }
					   if(!empty($pageid13)) { $tempArray[]= $pageid13; }
					   if(!empty($pageid14)) { $tempArray[]= $pageid14; }
					   if(!empty($pageid15)) { $tempArray[]= $pageid15; }
					
					   $arr_cnt = count($tempArray);
						
					   if($arr_cnt > 1)
					   {	
							$intersect = call_user_func_array('array_intersect', $tempArray);
					   }
					   else if($arr_cnt==1)
					   {
						  foreach ($tempArray as $key=>$val) 
						  {
							 $intersect =$val;
						  }
					   }
					   else
					   {
							$intersect ="";
					   }
					   
					   if(!empty($intersect))
					   {
							 $pid = implode(',',$intersect);
							 $query=$this->db->query("select * from jobseeker_profile where page_id IN (".$pid.") order by last_updated desc");
							 return $query->result();
					   }
					   else
					   {
							return "";   
					   }
			   }
			   else
			   {
					return "";   
			   } 
		}
		
		function sendemail($ids="",$cnt="",$sub="")
		{
			 $allids	= isset($ids)?$ids:$_POST['allids'];
			 $emailcnt	= isset($cnt)?$cnt:$_POST['emailcnt'];
			 $emailsub	= isset($sub)?$sub:$_POST['emailsub'];
			 
			 $pids=explode(',',$allids);
			 
			 $allemail=array();
			 foreach($pids as $pid)
			 {
				  $email=$this->getsiteid($pid);
				  array_push($allemail, $email);
			 }
			 
			 if(!empty($allemail))
			 {
				$newarr=array_unique($allemail);
				   
				$subject = $emailsub;
				  
				$mail_body =$emailcnt;

				$headers  = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
				$headers .= "From: info@jadooweb.com\r\n";
				$headers .= "Reply-To: info@jadooweb.com\r\n";
				$headers .= "X-Mailer: PHP/" . phpversion();
				$headers .= "X-Priority: 1" . "\r\n"; 		
				
				$sender_id=$this->ion_auth->get_user_id();
				
				$sendResult = array();
				foreach($newarr as $res)
				{
					$temp = array();
					$to	  = $res;
					$send = mail($to, $subject, $mail_body, $headers);

					$receiver_id=$this->getidusingemail($to);
					if($send)   {
						$this->db->query("insert into jobseeker_email(sender_id,receiver_id,email_contents,email_subject)values('".$sender_id."','".$receiver_id."',".$this->db->escape($mail_body).",".$this->db->escape($emailsub).")");

						$temp['status']  = "True";
						$temp['address'] = $to;
						
					} else {
						$temp['status']  = "True";
						$temp['address'] = $to;						
					}
					$sendResult[] = $temp;
				}
				echo json_encode($sendResult);
			 }
		}
		
		function getsiteid($pid)
		{
			 $query=$this->db->query("select * from pages where pages_id ='".$pid."' ");
			 $ids=$query->result();
			 $sid=$ids[0]->sites_id;
			 
			return $this->getuserid($sid);
		}
		
		function getuserid($sid)
		{
			 $query=$this->db->query("select * from sites where sites_id ='".$sid."' ");
			 $ids=$query->result();
			 $uid=$ids[0]->users_id;
			 
			return $this->getuseremail($uid);
		}
		
		function getuseremail($uid)
		{
			 $query=$this->db->query("select * from users where id ='".$uid."' ");
			 $ids=$query->result();
			 return $email=$ids[0]->email;
		}	
		
		function getidusingemail($email)
		{
			 $query=$this->db->query("select * from users where email='".$email."' ");
			 $ids=$query->result();
			 return $id=$ids[0]->id;
		}
   }

?>