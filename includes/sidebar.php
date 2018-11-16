<?php
$role=$this->session->userdata('role');  
?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">      
<ul class="app-menu">
	<li><a class="app-menu__item active" href="<?php echo base_url();?>index.php/Welcome"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
	<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview">
	<i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Forms</span><i class="treeview-indicator fa fa-angle-right"></i></a>
	<ul class="treeview-menu">
	<?php if($role == 'SuperAdmin')
	{
	?>
	<li><a class="treeview-item" href="<?php echo base_url();?>index.php/CompaniesController/create"><i class="icon fa fa-circle-o"></i>Fuel Companies</a></li>
	<li><a class="treeview-item" href="<?php echo base_url();?>index.php/RegionsController/create"><i class="icon fa fa-circle-o"></i>Regions</a></li>
	<li><a class="treeview-item" href="<?php echo base_url();?>index.php/CitiesController/create"><i class="icon fa fa-circle-o"></i>Cities</a></li>
	<li><a class="treeview-item" href="<?php echo base_url();?>index.php/AssociationController/create"><i class="icon fa fa-circle-o"></i>Association Name</a></li>
	<?php } ?>
	<?php if($role == 'Association')
	{
	?>
	<li><a class="treeview-item" href="<?php echo base_url();?>index.php/PumpsController/create"><i class="icon fa fa-circle-o"></i>Petrol Pumps</a></li>
	<li><a class="treeview-item" href="<?php echo base_url();?>index.php/BlockTransporterController/create"><i class="icon fa fa-circle-o"></i>Update Defaulter Transporter</a></li>
	<?php } ?>
	<?php if($role == 'Pumps')
	{
	?>
	<li><a class="treeview-item" href="<?php echo base_url();?>index.php/BlockTransporterController/create"><i class="icon fa fa-circle-o"></i>Update Defaulter Transporter</a></li>
	<?php } ?>
	</ul>
	</li>	 
</ul>
</aside>
