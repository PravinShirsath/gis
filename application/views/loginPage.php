<html>
  <?php include('includes/topbar.php');  ?>
   <link href="<?php echo base_url();?>assets/css/parsley.css" type="text/css" rel="stylesheet"/>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>LPG Association</h1>
      </div>
      <div class="login-box">
        <form class="login-form" action="<?php echo base_url();?>index.php/LoginController/process" method="POST">
		 <?php if(! is_null($msg)) echo $msg;?>     
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
          <div class="form-group">
            <label class="control-label">USERNAME</label>
            <input class="form-control" name="username" type="text" value="<?php if(isset($_GET['username'])){echo $_GET['username'];}?>" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" name="password" type="password" id="password" value="<?php if(isset($_GET['username'])){echo 'welcome';}?>" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input type="checkbox" onclick="myFunction();"><span class="label-text">Show Password</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
        </form>
        <form class="forget-form" method="POST" action="<?php echo base_url();?>index.php/LoginController/forgetpw" data-parsley-validate data-toggle="validator">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>		    
          <div class="form-group">
            <label class="control-label">ENTER YOUR MOBILE NUMBER</label>
            <input class="form-control" name="mobile" type="text" placeholder="Mobile Number" required data-parsley-type="number"
                                    data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
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
	$('.login-content [data-toggle="flip"]').click(function() {
	$('.login-box').toggleClass('flipped');
	return false;
	});
	function myFunction() {
	var x = document.getElementById("password");
	if (x.type == "password") {
	x.type = "text";
	} else {
	x.type = "password";
	}
	}
	</script> 
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/parsley.min.js"></script>	
  </body>
</html>