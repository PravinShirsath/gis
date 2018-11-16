<?php 
 $uid=$this->session->userdata('userid');
 $role=$this->session->userdata('role');
if(isset($uid))
{
include('includes/topbar.php');
include('includes/header.php'); 
//include('includes/sidebar.php');

?>
<main class="app-content">
	<div class="app-title">
	<div>		
		<h1 style="margin-top:5px"><i class="fa fa-home"></i><a href="<?php echo base_url();?>index.php/Welcome"> <button class="btn btn-danger"> Dashboard </button></a><span style="margin-left:15px;">Distributors Summary</span></h1>
		 
		</div>
	</div>
	<div class="row">	
	<div class="col-md-12">

	<div class="tile" >
        
        <div class="row">
		<div class="col-md-12">
       
			
				<div class="tile-body">
					<table class="table table-hover table-bordered" id="sampleTable" >
						<thead>
							<tr>
								<th>Oil Company</th>                    
								<th>No. of Agency</th>                   
							</tr>
						</thead>
                        <tbody>  
							<?php 
                                if(isset($companies))
                                {
                                    foreach($companies as $company){ ?>
                                    <tr>
                                        <td><?php echo $company->name;?></td>
                                        <td><?php 

                                            $this->db->select('parentId');
                                            $this->db->where(array('id'=>$uid));
                                            $qu=$this->db->get('users');
                                            $qurow=$qu->row();  
                                            $parentId=$qurow->parentId;    
                                        
                                            $companyId=$company->id;                                        
                                            $this->db->select('count(*) as cnt');	
                                            $this->db->where(array('companyId'=>$companyId));
                                            $this->db->where(array('associationid'=>$parentId));	
                                            $qu=$this->db->get('pumps');
                                            $qurow=$qu->row();  
                                            echo $qurow->cnt;                                        
                                        ?>
                                        </td>                                     
                                    </tr>
                                    <?php } 
                                } ?>
						</tbody>					
					</table>
				</div>
		
		</div>
	</div>
       
	</div>
	</div>
	<div class="clearix"></div>
	</div>
</main>
<?php include('includes/footer.php');?>
<script>
$('#sampleTable').DataTable();
</script>
<?php } else{ ?><script>
window.location.href = "<?php echo base_url();?>";
</script><?php } ?>