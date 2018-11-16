
<div>
  <div class="sth-strip">
  <div class="sth-fotter-text">
  <!-- <div style="text-align: right;margin-right: 20px;margin-top: 10px;"> -->
    <a href="http://www.skytechhub.in" target="_blank">
      <span style="color: #0114f3">Sky Tech Hub</span> 
      <span style="color:#fff">© 2018.  All rights reserved.</span>
    </a>
  </div>
  </div>
  <div class="sth-strip-left">
  <div class="sth-fotter-text">
  <!-- <div style="text-align: right;margin-right: 20px;margin-top: 10px;"> -->
    <a href="http://www.skytechhub.in" target="_blank" style="">
      <span style="color: #fff">Helpline Number :</span> 
      <span style="color:#fff">96 07 01 66 44</span>
    </a>
  </div>
  </div>  
</div>   
    <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo base_url();?>assets/js/plugins/pace.min.js"></script>	
	
    <!-- Page specific javascripts-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/chart.js"></script>
	
    <script type="text/javascript">
      var data = {
      	labels: ["January", "February", "March", "April", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Complete"
      	},
      	{
      		value: 50,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "In-Progress"
      	}
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
	  $('head').append($("<meta name=viewport content=width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1>"));
    </script>
	 <script type="text/javascript" src="<?php echo base_url();?>assets/js/parsley.min.js"></script>
  </body>
</html>