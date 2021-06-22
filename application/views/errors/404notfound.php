<!DOCTYPE html>
<html>
<head>
	<title>404 Page Not Found</title>

	<style type="text/css">
		body{
			background-image: url("<?php echo base_url();?>assets/img/not_found/wallpaper-not-found.jpg");
			
			background-position:left;
			text-align: center;
			color: #fff;	
		}
		.number{
			font-size: 50px;
		}
		.pnf{
			font-size: 35px;
		}
		.back{
			width: 130px;
			height: 30px;
		}
	</style>
</head>
<body>
	<br><br><br><br><br>
	<span class="number">404</span> <br><br>
	<span class="pnf">PAGE NOT FOUND</span> <br><br>
	<a href="<?php echo base_url();?>"><button class="back">GO BACK</button></a>
</body>
</html>