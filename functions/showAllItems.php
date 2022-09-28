<!DOCTYPE HTML>
<head>
<style>
	table.items, th.items, td.items {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th.items, td.items {
		height: 20px;
		max-height: 20px;
	}
	.dark {
		background-color: rgba(140, 140, 140, 1);
	}
	.light {
		background-color: rgba(180, 180, 180, 1);
	}
	.numeric {
		text-align: center;
	}
	.flex-container {
		display: flex;
		flex-direction: row;
	}
	.flex-container > table {
		margin: 10px;
		padding: 20px;
	}
	.button {
		display:inline-block;
		width: 100%;
		height: 100%;
	}
</style>
</head>
<body>
	<?php 
		include 'C:\xampp\htdocs\scmTools\header.php';
		$servername = "34.85.150.9";
		$username = "root";
		$password = "Dutches..1";
		
		// Create connection
		$conn = new mysqli($servername, $username, $password);
		
		// Check connection
		if ($conn -> connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		//echo "Connected successfully";
		
		$itemsArray = array();
		
		
		$conn->query("USE inventoryLog");
		$query = "SELECT _id, item, inshop, assigned, available, ordered, retained FROM inventory";
		$result = $conn->query($query);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($itemsArray, array($row["_id"], $row["item"], $row["inshop"], $row["assigned"], $row["available"], $row["ordered"], $row["retained"]));//pushes columns to the array as arrays
			}
		} else {
			echo "0 results";
		}
		
		echo "<div class = \"flex-container\"><table class = \"items\"><tr class = \"items\">
		<th class = \"light items\" style = \"width:25px\">ID</th>
		<th class = \"light items\" style = \"width:300px\">Items</th>
		<th class = \"dark items\" style = \"width:60px\">In Shop</th>
		<th class = \"light items\" style = \"width:60px\">Assigned</th>
		<th class = \"dark items\" style = \"width:60px\">Available</th>
		<th class = \"light items\" style = \"width:60px\">Ordered</th>
		<th class = \"dark items\" style = \"width:60px\">Retained</th>
		</tr>";//setup the table header
		
		$style = 0;
		$index = 0;
		
		foreach ($itemsArray as $row){
			if($index == 80) {
				echo "</table>";
				echo "<div class = \"flex-container\"><table class = \"items\"><tr class = \"items\">
					<th class = \"light items\" style = \"width:25px\">ID</th>
					<th class = \"light items\" style = \"width:300px\">Items</th>
					<th class = \"dark items\" style = \"width:60px\">In Shop</th>
					<th class = \"light items\" style = \"width:60px\">Assigned</th>
					<th class = \"dark items\" style = \"width:60px\">Available</th>
					<th class = \"light items\" style = \"width:60px\">Ordered</th>
					<th class = \"dark items\" style = \"width:60px\">Retained</th>
					</tr>";
				$index = 0;
			}
			if ($style == 0) {
				echo "<tr class = \"items\">" . 
					"<td class = \"light numeric items\">" . $row[0] . 
					"</td><td class = \"dark items\">" . $row[1] .
					"</td><td class = \"light numeric items\">" . $row[2] .
					"</td><td class = \"dark numeric items\">" . $row[3] .
					"</td><td class = \"light numeric items\">" . $row[2]-$row[6] .
					"</td><td class = \"dark numeric items\">" . $row[5] .
					"</td><td class = \"light numeric items\">" . $row[6] . "</td></tr>";
				$style = 1;
			}else if ($style == 1) {
				echo "<tr class = \"items\">" . 
					"<td class = \"light numeric items\">" . $row[0] . 
					"</td><td class = \"light items\">" . $row[1] .
					"</td><td class = \"dark numeric items\">" . $row[2] .
					"</td><td class = \"light numeric items\">" . $row[3] .
					"</td><td class = \"dark numeric items\">" . $row[2]-$row[6] .
					"</td><td class = \"light numeric items\">" . $row[5] .
					"</td><td class = \"dark numeric items\">" . $row[6] . "</td></tr>";
				$style = 0;
			}
			$index++;
		}
		
		echo "</table></div>";
		
		$conn->close();
	?>
</body>