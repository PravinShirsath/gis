<html>
<?php 
$uid=$this->session->userdata('userid');
$username=$this->session->userdata('username');
$password=$this->session->userdata('password');

$role=$this->session->userdata('role');
if(isset($uid))
{
?>
  <?php include('includes/topbar.php');  ?>
 
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Pump Association</h1>
      </div>
      <div class="login-box" style="min-height:500px;">
        <form class="login-form" action="<?php echo base_url();?>index.php/LoginController/changepass" method="POST">
		 <?php //if(! is_null($msg)) echo $msg;?>     
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Change Password</h3>
          <div class="form-group">
            <label class="control-label">USERNAME</label>
            <input class="form-control" name="username" readonly type="text" value="<?php echo $this->session->userdata('username');?>" placeholder="Email" autofocus>
          </div>
		  
          <div class="form-group">
            <label class="control-label">ENTER NEW PASSWORD</label>
            <input class="form-control" name="newpassword" type="password" id="password" value="" placeholder="Password">
            
		      	<input type="hidden"   id='oldpw'  value='<?php echo $this->session->userdata('password');?>' >
		      	<input type="hidden"   id='userid'  value='<?php echo $this->session->userdata('password');?>'>
      
          </div>
          <div class="form-group">
            <label class="control-label">CONFIRM PASSWORD</label>           
            <input class="form-control" name="confirmPassword" type="password" id="confirm_password" value="" placeholder="Confirm Password">
		      </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input type="checkbox" onclick="myFunction();"><span class="label-text">Show Password</span>
                </label>
              </div>
             
            </div>
          </div>
          <div class="form-group btn-container">
            <button type="button" class="btn btn-primary btn-block" name="changepass" id="changepass"><i class="fa fa-sign-in fa-lg fa-fw"></i>SAVE</button>
            <span id='message'></span>
          </div>
        </form>    
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo base_url();?>assets/js/plugins/pace.min.js"></script>
  <script type="text/javascript">
  
  $('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    var b = document.getElementById("changepass");
    b.type="submit";
    $('#message').html('Matching').css('color', 'green');    
  } else 
    $('#message').html('Not Matching').css('color', 'red');  
     
 });
 
	$('.login-content [data-toggle="flip"]').click(function() {
	$('.login-box').toggleClass('flipped');
	return false;
	});
	function myFunction() {
	var x = document.getElementById("password");
  var y = document.getElementById("confirm_password");
	if (x.type == "password") {
	x.type = "text";
  y.type = "text";
	} else {
	x.type = "password";
  y.type = "password";
	}
	}
	</script>   
  </body>
<?php } ?>

</html>