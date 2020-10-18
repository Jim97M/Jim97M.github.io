<?php
//Start the database connection here
//
$conn = new PDO('mysql:host=localhost;dbname=login_system', 'root', '');
if ($conn->connect_error) {
	die("Failed To Connect!" . $conn->connect_error);
}
if (isset($_POST['query'])) {
	$inpText = $_POST['query'];
	$query = "SELECT name FROM tbl_users WHERE name LIKE '%inpText%'";
	$result = $conn->query($query);

	if ($result->num_rows>0) {
		while ($row=$result->fetch_assoc()) {
			echo "<a href='#' class='list-group-item list-group-item-action'>".$row['name']."</a>";
		}
	}else{
		echo "<p class='list-group-item border-1'>No Record</p>";
	}
}

?>