<!--Admin Tools-->
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
		background-color: rgba(160, 160, 160, 1);
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
	.add > div {
		width: 100%;
		height: 100%;
		background-color: #555;
	}
	.updatebutton{
		background-color: #4CAF50;
		border: 10px solid #404040;
		color: black;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 18px;
		cursor: pointer;
	}
	.updatebutton:hover {
		background-color: #4CCF50;
	}
</style>
</head>
<body>
	<?php 
		include 'C:\xampp\htdocs\scmTools\header.php';
		
		/////////////////////////////////////////////////Connect to db////////////////////////////////////////////////////
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
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////Get all items from the table////////////////////////////////////////////
		$itemsArray = array();
		$conn->query("USE inventoryLog");
		$query = "SELECT * FROM inventory";
		$result = $conn->query($query);
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$rowArray = array();
				foreach($row as $index => $value){
					array_push($rowArray, $value);
				}
				array_push($itemsArray, $rowArray);//pushes columns to the array as arrays
			}
		} else {
			echo "0 results";
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////Get column names from table//////////////////////////////////////////
		$columnsArray = array();
		
		//$conn->query("SET GLOBAL innodb_stats_on_metadata=0");//Not needed after version 5.6.6, as this is default?
		$conn->query("USE INFORMATION_SCHEMA");
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'inventory'";
		$result = $conn->query($query);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($columnsArray, $row);//This should push the names into the array
			}
		} else {
			echo "0 results";
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////Fill JS arrays with PHP information////////////////////////////////////////
		$columnsArray = array_values($columnsArray);
		$itemsArray = array_values($itemsArray);
		echo "<script type=\"text/javascript\">
		var pageDiv = document.createElement(\"div\");
		pageDiv.style.display = \"flex\";
		pageDiv.style.flexDirection = \"vertical\";
		pageDiv.style.backgroundColor = \"green\";
		pageDiv.style.width = \"100%\";
		
		var tableDiv = document.createElement(\"div\");
		tableDiv.style.display = \"flex\";
		tableDiv.style.flexDirection = \"vertical\";
		tableDiv.style.backgroundColor = \"green\";
		tableDiv.style.width = \"100%\";
		
		var tableData = new Array();
		var headerRow = new Array();
		var temparray = new Array();
		
		function buildArray(){";
		//for ($i = 0; $i < count($columnsArray, 0); $i=$i+1) {
		foreach($columnsArray as $key => $value){
			echo "headerRow.push(\"" . $value['COLUMN_NAME'] . "\"); ";
		}
		echo "tableData.push(headerRow); ";
		
		for ($i = 0; $i < count($itemsArray, 0); $i=$i+1) {
			$array = $itemsArray[$i];
			$array = array_values($array);
			echo "temparray = new Array(); ";
			for($j = 0; $j < count($array, 0); $j=$j+1){
				echo "temparray.push(\"" . $array[$j] . "\"); ";
			}
			echo "tableData.push(temparray); ";
		}
		
		echo "}buildArray(); ";
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////Build Visual Tables from Data////////////////////////////////////////////
		
		echo "
		for (let i = 0; i < tableData.length; i++){
			var row = newRow();
			var  newButton = newAddButton();
			for (let j = 0; j < tableData[i].length; j++){
				createElement(row, tableData[i][j]);
			}
			tableDiv.appendChild(row);
			tableDiv.appendChild(newButton);
		}
		function createElement(parent, text){
			var aDiv = document.createElement(\"div\");
			aDiv.innerText = text;
			aDiv.style.color = \"yellow\";
			aDiv.style.width = \"100%\";
			aDiv.style.margin = \"2px\";
			aDiv.style.padding = \"3px\";
			aDiv.style.backgroundColor = \"rgba(40, 100, 130, 1)\";
			parent.appendChild(aDiv);
		}
		function newRow(){
			var row = document.createElement(\"div\");
			row.style.display = \"flex\";
			row.style.flexDirection = \"horizontal\";
			return row;
		}
		function newAddButton () {
			var bDiv = document.createElement(\"div\");
			bDiv.style.display = \"flex\";
			bDiv.style.height = \"100%\";
			bDiv.style.width = \"40px\";
			bDiv.style.flexDirection = \"horizontal\";
			var addButton = document.createElement(\"button\");
			addButton.type = \"button\";
			addButton.style.height = \"20px\";
			addButton.style.width = \"20px\";
			addButton.style.backgroundColor = \"#555555\";
			addButton.style.color = \"yellow\"
			bDiv.appendChild (addButton);
			return bDiv;
			
		}
		document.body.appendChild(tableDiv);
		</script>";

		
		$conn->close();
		//include 'C:\xampp\htdocs\scmTools\footer.php';
	?>
	
<div style="text-align: center;"><button class="updatebutton">APPLY UPDATED INFORMATION</button></div>

<!--<button onclick="@()"style="color:yellow; background-color: #555555;"><strong>+<strong></button>
<button onclick="@()"style="color:yellow; background-color: #555555;"><strong>~<strong></button>-->
	
	
</body>