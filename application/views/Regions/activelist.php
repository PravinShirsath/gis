<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{ 
include('includes/topbar.php');
include('includes/header.php');
//include('includes/sidebar.php');	 
if(isset($singleRegion))
{
 $singleRegions=$singleRegion['singleRegion']->row();	
 $name=$singleRegions->name;
 $id=$singleRegions->id;
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
<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/RegionsController/create"><button>Add Region</button></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/RegionsController/activelist"><button style="background-color:green;COLOR:white">Active Region list</button></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/RegionsController/deactivatelist"><button>Deactive Region list</button></a></h5>
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
					if(isset($regions)){
					foreach($regions['regions'] as $regions){
				?>
                  <tr>
                    <td><?php echo $regions->name;?></td>
                   <td><a name='edit' href="<?php echo site_url('RegionsController/edit/'.$id=$regions->id); ?>"><button title="Edit"  name="Edit" id="Edit" class="btn btn-primary"> Edit</button></a></td>                                               
                   <td><button title="Deactivate" class="btn btn-danger" name="delete" id="delete" value="<?php echo $regions->id; ?>" onclick="discardCompany(this.value);"> Deactivate</button></td>                   
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
url: '<?php echo base_url();?>index.php/RegionsController/discard',
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