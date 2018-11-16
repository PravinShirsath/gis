<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{
include('includes/topbar.php');
include('includes/header.php');
 //include('includes/sidebar.php');
	if(isset($SalseZone))
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
                <a href="<?php echo base_url();?>index.php/Welcome"><button class="btn btn-danger">Dashboard </button></a>
            </h1>
		</div>
	</div>
	<div class="row">
	<div class="form-group row">
<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/StateOfficeController/create"><button>Add State Office</button></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/StateOfficeController/activelist"><button style="background-color:green;COLOR:white">Active State Office list</button></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/StateOfficeController/deactivatelist"><button>Deactive State Office list</button></a></h5>
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
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Change Status</th>
                  </tr>
                </thead>
                <tbody>  
				<?php 
					if(isset($stateoffice)){
					foreach($stateoffice['stateoffice'] as $state){
				?>
                  <tr>
                    <td><?php echo $state->name;?></td>
                   <td><a name='edit' href="<?php echo site_url('StateOfficeController/edit/'.$id=$state->id); ?>"><button title="Edit"  name="Edit" id="Edit" class="btn btn-primary"> Edit</button></a></td>                                               
                   <td><button title="Deactive" class="btn btn-danger" name="delete" id="delete" value="<?php echo $state->id; ?>" onclick="discardCompany(this.value);"> Deactivate</button></td>                   
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
url: '<?php echo base_url();?>index.php/StateOfficeController/discard',
data: 'post_id=' + value,
success: function(data)
{	alert("This State Office deactivated Successfully !!!");
	location.reload();
}
});
}
}
</script>
<?php } else{ ?><script>
window.location.href = "<?php echo base_url();?>";
</script><?php } ?>