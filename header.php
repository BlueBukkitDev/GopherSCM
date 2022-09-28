<!--header.php-->
<!DOCTYPE HTML>
<head>
	<style>
	.menubutton {
		background-color: #4CAF50;
		border: 2px solid black;
		border-radius: 5px;
		color: black;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
		width: 220px;
		transition-duration: 0.1s;
	}
	.menubuttonThis {
		background-color: #1C9F20;
		border: 2px solid black;
		border-radius: 5px;
		color: black;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
		width: 220px;
		transition-duration: 0.1s;
	}
	.menubutton:hover {
		background-color: #4CCF50;
	}
	.header {
		width: 80%;
		padding: 30px;
	}
	.center {
		margin-left: auto;
		margin-right: auto;
	}
	body {
		background-color: #0f2030;
	}
</style>
</head>
<body>
<div style = "height: 200px">
	<?php
		echo "<div class = \"header center\">
			<table class = \"center\" style = \"border: none\">
			<tr>";
		for ($x = 0; $x <= 6; $x++) {
			$classString = "menubutton";
			if($x == 0){//$id=$_REQUEST['id'];
				if($_GET['page'] == "main" || $_GET['page'] == null){
					$classString = "menubuttonThis";
				}
				echo "<td><button type = \"button\" class=\"" . $classString . 
				"\" onclick=\"window.location.href = 
				'http://192.168.1.139/scmTools/main.php?page=main';\">HOME</button></td>";
			}else if($x == 1){
				if($_GET['page'] == "viewneeded"){
					$classString = "menubuttonThis";
				}
				echo "<td><button type = \"button\" class=\"" . $classString . 
				"\" onclick=\"window.location.href = 
				'http://192.168.1.139/scmTools/functions/showNeededItems.php?page=viewneeded';\">View Needed Items</button></td>";
			}else if($x == 2){
				if($_GET['page'] == "viewall"){
					$classString = "menubuttonThis";
				}
				echo "<td><button type = \"button\" class=\"" . $classString . 
				"\" onclick=\"window.location.href = 
				'http://192.168.1.139/scmTools/functions/showAllItems.php?page=viewall';\">View All Items</button></td>";
			}else if($x == 3){
				if($_GET['page'] == "usage"){
					$classString = "menubuttonThis";
				}
				echo "<td><button type = \"button\" class=\"" . $classString . 
				"\" onclick=\"window.location.href = 
				'http://192.168.1.139/scmTools/functions/reportUsage.php?page=usage';\">Report Usage</button></td>";
			}else if($x == 4){
				if($_GET['page'] == "shipment"){
					$classString = "menubuttonThis";
				}
				echo "<td><button type = \"button\" class=\"" . $classString . 
				"\" onclick=\"window.location.href = 
				'http://192.168.1.139/scmTools/functions/reportShipment.php?page=shipment';\">Report Shipment</button></td>";
			}else if($x == 5){
				if($_GET['page'] == "admin"){
					$classString = "menubuttonThis";
				}
				echo "<td><button type = \"button\" class=\"" . $classString . 
				"\" onclick=\"window.location.href = 
				'http://192.168.1.139/scmTools/functions/adminTools.php?page=admin';\">Admin Tools</button></td>";
			}
		}
	?>
</div>
</body>