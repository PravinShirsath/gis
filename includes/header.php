<header class="app-header"><a class="app-header__logo" href="<?php echo base_url();?>index.php/Welcome" style="font-size: 20px;">LPG Distributors Association</a>
      <!-- Sidebar toggle button <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>-->
      <!-- Navbar Right Menu-->
      <ul class="app-nav">        
        <!-- User Menu-->
        <li class="dropdown">
			<a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
				
			<span><?php  echo $uname=$this->session->userdata('name');  ?> </span>
			<span><strong>(<?php   $role=$this->session->userdata('role');  echo $personName=$this->session->userdata('personName');   ?>)</strong></span>
			<i class="fa fa-user fa-lg"></i></a>
			  <ul class="dropdown-menu settings-menu dropdown-menu-right">
				<li><a class="dropdown-item" href="<?php echo base_url();?>index.php/LoginController/changepassword"><i class="fa fa-cog fa-lg"></i> Change Password</a></li>
				<?php
				if($this->session->userdata('role')=='Pumps'){
				?>
				<li><a class="dropdown-item" href="<?php echo base_url();?>index.php/PumpsController/edit"><i class="fa fa-user fa-lg"></i> Profile</a></li>
				<?php } ?>
				<li><a class="dropdown-item" href="<?php echo base_url();?>index.php/LoginController/do_logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
			  </ul>
        </li>
      </ul>
	  
</header>