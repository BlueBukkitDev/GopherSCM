	
<!DOCTYPE HTML>
<head>
	<?php 
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
		$sql = "SELECT item FROM inventory";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($itemsArray, $row["item"]);
				//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
			}
		} else {
			echo "0 results";
		}
		
		$index = 0;
		
		foreach ($itemsArray as $item){
			$index++;
			echo "Item #$index:". $item . "<br>";
		}
		
		$conn->close();
	?>
</head>