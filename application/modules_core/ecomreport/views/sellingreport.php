<div class="container-fluid minheight">
    
  <table id="user-dataTable" class="table table-striped table-bordered  no-wrap" cellspacing="0" width="100%">
    
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        
        <tbody>
            <?php 
                 if(empty($result))
                 {
                    
                 }
                 else
                 {
                        foreach ($result as $result):
		
                             $que=$this->db->query("select * from customer_details where id='".$result->customer_id."' ");
							 $cnt=$que->result();
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($cnt[0]->firstname,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($cnt[0]->lastname,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($cnt[0]->email,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($cnt[0]->phone,ENT_QUOTES,'UTF-8');?> </td>
                                <td><?php echo htmlspecialchars($result->price,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($result->quantity,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($result->amount,ENT_QUOTES,'UTF-8');?></td>
                                <td><?php echo htmlspecialchars($result->date,ENT_QUOTES,'UTF-8');?></td>
                            </tr>
                    <?php 
                        endforeach;
                 }
                    
                ?>
        </tbody>
    
	</table>
    
     <a href="<?php echo site_url('ecomreport/index/'.$uid);?>" class="btn btn-primary">Go Back</a>
    
</div>   

<script>
    $(document).ready( function () {
        $("#user-dataTable").DataTable({
            ordering: true,
            "pageLength": 10,
            responsive: true
        });
    } );
	
	function getdesc(id)
	{
		$.ajax({url:"<?php echo site_url('ecomreport/getdescription');?>",
			 type:"post",
			 data:{id:id},
			 success:function(html)
			 {
				document.getElementById('desc'+id).innerHTML=html;
			 }});	
	}
	
	function hidedesc(id)
	{
		$.ajax({url:"<?php echo site_url('ecomreport/hidedescription');?>",
		 type:"post",
		 data:{id:id},
		 success:function(html)
		 {
			document.getElementById('desc'+id).innerHTML=html;
		 }});
	}
</script>
