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
			<div class="col-md-12">
			<div class="form-group row">
				<h5 style="margin-left:20px;"><a href="<?php echo base_url();?>index.php/PumpsController/create"><button>Add Distributor</button></a>
				<a href="<?php echo base_url();?>index.php/PumpsController"><button style="background-color:GREEN; COLOR:WHITE">Active Distributors list</button></a>
				<a href="<?php echo base_url();?>index.php/PumpsController/deactivatelist"><button>Deactive Distributors list</button></a>
			<a href="<?php echo base_url();?>index.php/PumpsController/activationpendinglist"><button>Activation Pending list</button></a></h5>
			</div>
			<div class="tile">
			<div class="tile-body">			
			<table class="table table-hover table-bordered" id="sampleTable" style="display:block;overflow:auto;">
                <thead>
					
                  <tr>
                   
                    <th>CC Code</th>
					 <th>Owner Name </th>
                    <th>Distributor Name -
					<font color="red" style="text-align:right;"><?php 
									if(isset($pumps)){
										$total1=0;
									foreach($pumps as $de){
										$ownerName=$de->ownerName;
										$total1=$total1+1;
										}
									}
										echo ' Active '.number_format($total1);
								?></font>
					</th>                   
                    <th>Oil Company</th>
                    <th>City</th>
                    <th>MobileNo</th>
                    <!--<th>Edit</th>-->
                    <th>Change Status</th>
                  </tr>
                </thead>
                <tbody>  
				<?php 
					if(isset($pumps)){
					foreach($pumps as $pump){
						
				?>
                  <tr>
                    <td><?php echo $pump->ccode;?></td>
                    <td><?php echo $pump->ownerName;?></td>
                    <td><?php echo $pump->name;?></td>
                    <td><?php echo $pump->companyName;?></td>
                    <td><?php echo $pump->cityname;?></td>
                    <td><?php echo $pump->mobileNo;?></td>
					<!--<td><a name='edit' href="<?php //echo site_url('RegionsController/editregions/'.$id=$pump->id); ?>"><button title="Edit"  name="Edit" id="Edit" class="btn btn-primary"> Edit</button></a></td> -->                                              
                   <td><button title="Delete" class="btn btn-danger" name="delete" id="delete" value="<?php echo $pump->id; ?>" onclick="discardassociation(this.value);"> Deactivate</button></td>  
                  </tr>
				 <?php } } ?>
                </tbody>
              </table>
			
			</div>
			</div>
			<div class="clearix"></div>
			</div>
</main>
<?php include('includes/footer.php');?>

<script type="text/javascript">
$('#sampleTable').DataTable();
$('#regions').bind("change",function () {
			$.ajax({
		type: "GET", 
		url: "<?php echo base_url();?>index.php/PumpsController/getcities",
		data: {regionid : $('#regions').val()},
		success: function(html) {
		$("#cityId").html(html);
		}
		});
});
</script>
 <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
	
	<script>
function discardassociation(value)
{
if(confirm("Sure to deactivate record !!!") == true)
{
$.ajax({
type: 'post',
url: '<?php echo base_url();?>index.php/PumpsController/discard',
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