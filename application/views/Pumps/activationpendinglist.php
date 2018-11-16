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
				<a href="<?php echo base_url();?>index.php/PumpsController"><button >Active Distributors list</button></a>
				<a href="<?php echo base_url();?>index.php/PumpsController/deactivatelist"><button>Deactive Distributors list</button></a>
				<a href="<?php echo base_url();?>index.php/PumpsController/activationpendinglist"><button style="color:RED;">Activation Pending list</button></a></h5>
			</div>
			<div class="tile">
			<div class="tile-body">			
			<table class="table table-hover table-bordered" id="sampleTable" style="display:block;overflow:auto;">
                <thead>
                  <tr>
                   
                  
					 <th>Distributor Name -
						<font color="red" style="text-align:right;"><?php 
									if(isset($pumps)){
										$total1=0;
									foreach($pumps['pumps'] as $de){
										$username=$de->username;
										$total1++;
										}
									}
										echo '  Count '.number_format($total1);
								?></font>
					  </th>
					 <th>Email</th>
                    <th>MobileNo</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Send SMS & EMAIL Reminder</th>
                  </tr>
                </thead>
                <tbody>  
				<?php 
					if(isset($pumps)){
					foreach($pumps['pumps'] as $pump){
						
				?>
                  <tr>
                    
                    <td><?php echo $pump->name;?></td>
                    <td><?php echo $pump->username;?></td>                    
                    <td><?php echo $pump->mobile;?></td>
					<td><a name='edit' href="<?php echo site_url('PumpsController/edit/'.$id=$pump->id); ?>"><button title="Edit"  name="Edit" id="Edit" class="btn btn-primary"> Edit</button></a></td>                                              
					                                           
                   <td><button title="Delete" class="btn btn-danger" name="Delete" id="deleterecord" value="<?php echo $pump->id; ?>" onclick="deleterecord(this.value)"> Delete</button></td> 
                   <td><button title="sendSMS" class="btn btn-primary" name="sendSMS" id="sendSMS" value="<?php echo $pump->mobile; ?>" onclick="sendSMS(this.value)">Send SMS & EMAIL</button></td> 
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
function sendSMS(value)
{
if(confirm("Sure to send Reminder SMS for Activation of Pump ?") == true)
{
$.ajax({
type: 'post',
url: '<?php echo base_url();?>index.php/PumpsController/sendSMStoPump',
data: 'mobileno=' + value,
success: function(data)
{
alert('Reminder SMS for Pump Activation, sent Succesfully to Pump Owner.');
}
});
}
}
</script>

<script>
function deleterecord(value)
{
if(confirm("Sure to delete record !!!") == true)
{
$.ajax({
type: 'post',
url: '<?php echo base_url();?>index.php/PumpsController/deleterecord',
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