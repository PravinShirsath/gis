<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{ 
include('includes/topbar.php');
include('includes/header.php');
//include('includes/sidebar.php');	 

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
<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/CitiesController/create"><button>Add City</button></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/CitiesController/activelist"><button>Active City list</button></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/CitiesController/deactivatelist"><button style="background-color:red;color:white">Deactive City list</button></a></h5>
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
		<th>Region Name</th>
		<th>City Name</th>
		<th>Change Status</th>
		</tr>
		</thead>
		<tbody>  
		<?php 
		if(isset($cities)){
		foreach($cities['cities'] as $city){
		?>
		<tr>		
		<td><?php echo $city->regionname;?></td>	
		<td><?php echo $city->name;?></td>		
		                                            
		<td><button title="Activate" class="btn btn-primary"  value="<?php echo $city->id; ?>" onclick="activecity(this.value);"> Activate</button></td>                   
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
function activecity(value)
{
if(confirm("Sure to activate record !!!") == true)
{
$.ajax({
type: 'post',
url: '<?php echo base_url();?>index.php/CitiesController/activcity',
data: 'post_id=' + value,
success: function(data)
{
location.reload();
}
});
}
}
</script>
<?php } else{ ?><script>
window.location.href = "<?php echo base_url();?>";
</script><?php } ?>