<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{
include('includes/topbar.php');
include('includes/header.php');
 //include('includes/sidebar.php');
	if(isset($company))
{
 //$singlecompany=$SalseZone['SalseZone']->row();	
 //$zonename=$SalseZone->zonename;
 //$id=$SalseZone->id;
}
?>
<main class="app-content">
	<div class="app-title">
		<div>		
		<h1 style="margin-top:5px">
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url();?>index.php/CompRegistrationController/active"><button class="btn btn-danger">Dashboard </button></a>
            </h1>
		</div>
	</div>
<div class="row">
<div class="form-group row">
	<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/CompRegistrationController/create"><button>Comp Registration</button></a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/CompRegistrationController/activelist"><button style="background-color:green;COLOR:white">Active Comp Registration list</button></a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/CompRegistrationController/deactivatelist"><button>Deactive Comp Registration list</button></a></h5>
</div>
	
	
<div class="clearix"></div>
</div>
	 
	<div class="row">
	<div class="col-md-12">
	<div class="tile">
	<div class="tile-body">
	<table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Company Name</th>
                    <th>Office Name</th>
					<th>Name</th>
                    <th>Designation</th>
					<th>Mobile Number</th>
                    <th>Email Id</th>
                    <th>Change Status</th>
                  </tr>
                </thead>
                <tbody>  
				<?php 
					if(isset($company)){
					foreach($company['company'] as $comp){
				?>
                  <tr>
					<td><?php $dbid=$comp->companyId; 
						$this->db->select('name');				
						$qu=$this->db->get_where('companies',array('id'=>$dbid));
						$qurow=$qu->row();
						$qurow->name;					
						echo strtoupper($qurow->name);
						?>													
					</td>
					<td><?php $dbid=$comp->officeId; 
						$this->db->select('name');				
						$qu=$this->db->get_where('stateoffice',array('id'=>$dbid));
						$qurow=$qu->row();
						$qurow->name;					
						echo strtoupper($qurow->name);
						?>													
					</td>
					<td><?php echo $comp->name;?></td>
					<td><?php echo $comp->designation;?></td>
					<td><?php echo $comp->mobNumber;?></td>
					<td><?php echo $comp->eMailId;?></td>				
                    <td><a name='edit' href="<?php echo site_url('CompRegistrationController/edit/'.$id=$comp->id); ?>"><button title="Edit"  name="Edit" id="Edit" class="btn btn-primary"> Edit</button></a></td>                                               
                    <td><button title="Deactive" class="btn btn-danger" name="delete" id="delete" value="<?php echo $comp->id; ?>" onclick="discardCompany(this.value);"> Deactivate</button></td>                   
                  </tr>
				 <?php } } ?>
                </tbody>
              </table>
	</div>
	</div>
	</div>
	</div>
	
</main>

<?php include('includes/footer.php');?>
<script>
$('#sampleTable').DataTable();
</script>
<script>
$('#sampleTable').DataTable();
function discardCompany(value)
{
if(confirm("Sure to deactivate record !!!") == true)
{
$.ajax({
type: 'post',
url: '<?php echo base_url();?>index.php/CompRegistrationController/discard',
data: 'post_id=' + value,
success: function(data)
{	alert("This Record deactivated Successfully !!!");
location.reload();
}
});
}
}
</script>
<?php } else{ ?><script>
window.location.href = "<?php echo base_url();?>";
</script><?php } ?>