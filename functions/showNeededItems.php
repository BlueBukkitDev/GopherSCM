	
<!DOCTYPE HTML>
<head>
	<style>
	table.items, th.items, td.items {
		border: 1px solid black;
		border-collapse: collapse;
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
	<script>
		function getInShop(item) {
			console.log("Result: <?php getInShop(" + item + "); ?>");
		}
	</script>
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
		$itemsQuery = "SELECT item, retained-inshop FROM inventory WHERE retained-inshop > 0";
		$itemsResult = $conn->query($itemsQuery);
		
		echo "<div class = \"flex-container\"><table class = \"items\"><tr class = \"items\"><th class = \"light items\" style = \"width:300px\">Item</th><th class = \"dark items\" style = \"width:60px\">Needed</th></tr>";
		
		if ($itemsResult->num_rows > 0) {
			while($row = $itemsResult->fetch_assoc()) {
				array_push($itemsArray, array($row["item"], $row["retained-inshop"]));
			}
		}
		
		$style = 0;
		$index = 0;
		
		foreach ($itemsArray as $row){
			if($index == 40) {
				echo "</table>";
				echo "<table class = \"items\"><tr><th class = \"light items\" style = \"width:300px\">Item</th><th class = \"dark items\" style = \"width:60px\">Needed</th></tr>";
				$index == 0;
			}
			if ($style == 0) {
				echo "<tr class = \"items\"><td class = \"dark items\">" . $row[0] .
				"</td><td class = \"light numeric items\">" . $row[1] . "</td></tr>";
				$style = 1;
			}else if ($style == 1) {
				echo "<tr class = \"items\"><td class = \"light items\">" . $row[0] . 
				"</td><td class = \"dark numeric items\">" . $row[1] . "</td></tr>";
				$style = 0;
			}
			$index++;
		}
		
		echo "</table></div>";
		
		
		/*function debug($data) {
			$output = $data;
			if (is_array($output)) {
				$output = implode(',', $output);
			}
			
			echo "<script>console.log('Debug: " . $output . "' );</script>";
		}*/
		
		function getInShop($item) {
			$servername = "34.85.150.9";
			$username = "root";
			$password = "Dutches..1";
			$conn = new mysqli($servername, $username, $password);
		
			if ($conn -> connect_error) {
				die("Connection failed: " . $conn->connect_error);
				return;
			}
			$conn->query("USE inventoryLog");
			$result = $conn->query("SELECT inshop FROM inventory WHERE item = \"" . $item . "\"");
			$rows = array();
			while ($row = $result->fetch_assoc()) {
				$rows[] = array_map("utf8_encode", $row);
			}
			return $rows;
		}
		
		function getNeeded(&$conn, $item) {
			$servername = "34.85.150.9";
			$username = "root";
			$password = "Dutches..1";
			$conn = new mysqli($servername, $username, $password);
					
			if ($conn -> connect_error) {
				die("Connection failed: " . $conn->connect_error);
				return;
			}
			$conn->query("USE inventoryLog");
			$result = $conn->query("SELECT retained FROM inventory WHERE item = \"" . $item . "\"");
			return ($result->fetch_assoc())*1;
		}
		//$conn->close();
	?>
</body>