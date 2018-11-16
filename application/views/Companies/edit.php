<?php include('includes/topbar.php');?>
<?php include('includes/header.php');?>
<?php //include('includes/sidebar.php');?>
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
			<h4><i class="fa fa-edit"></i>Edit Company</h4>
			</div>
	<div class="tile">
		<div class="tile-body">
		<form class="form-horizontal" action="<?php echo base_url();?>index.php/CompaniesController/store" method="post">
			<div class="form-group row">
			<label class="control-label col-md-2">Edit Company</label>
			<div class="col-md-4">
			<input class="form-control" name="name" type="text" value="<?php ?>" placeholder="Enter Company">
			</div>
			<label class="control-label col-md-2">eMail</label>
			<div class="col-md-4">
			<input class="form-control" name="eMail" type="email" placeholder="Enter eMail">
			</div>
			</div>
			<div class="form-group row">
			<label class="control-label col-md-2">MobileNO</label>
			<div class="col-md-4">
			<input class="form-control" name="MobileNo" type="text" placeholder="Enter Mobile Number">
			</div>
			</div>
			<div class="form-group row">
			<div class="col-md-8 col-md-offset-3">
			</div>
			</div>
		
		<div class="tile-footer">
		<div class="row">
			<div class="col-md-8 col-md-offset-3">
			<button class="btn btn-primary" type="submit">
			<i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;
			<a class="btn btn-secondary" href="#">
			<i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
			</div>
		</div>
		</div>
	</form>
		</div>	
	</div>
	</div>
	<div class="clearix"></div>
	</div>
</main>
<?php include('includes/footer.php');?>