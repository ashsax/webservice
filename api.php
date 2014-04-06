<?php
	function get_objects() {
		// Create database connection
		$dbhost = "localhost";
		$dbuser = "ash";
		$dbpass = "secret";
		$dbname = "objects";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		// Test if connection works
		if (mysqli_connect_errno()) {
			$value = "error";
		}
		
		// Perform database query
		$query  = "SELECT * FROM objs";
		$query_result = mysqli_query($connection, $query);
		if (!$query_result) {
			$value = "error";
		}
		
		// Use returned data (if any)
		$objects = array();
		while ($object = mysqli_fetch_assoc($query_result)) {
			$value[] = $object;
		}
		
		// Free result and close connection to database
		mysqli_free_result($query_result);
		mysqli_close($connection);
		return $value;
	}
	
	function set_object() {
		$objects = get_objects();
		// Create database connection
		$dbhost = "localhost";
		$dbuser = "ash";
		$dbpass = "secret";
		$dbname = "objects";
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		// Test if connection works
		if (mysqli_connect_errno()) {
			$value = "error";
		}
		
		// detect form submission
		if (isset($_POST['submit']) && $objects != "error") {
			if (isset($_POST["new_color"]) && !empty($_POST["new_color"]) &&
			isset($_POST['id']) && !empty($_POST['id'])) {
				$id = $_POST['id'];
				$new_color = $_POST["new_color"];
				if (($id >= $objects[0]['id'] && $id <= end($objects)['id']) && 
				($new_color == "red" || $new_color == "blue" || 
				$new_color == "green")) {
					$query  = "UPDATE objs SET ";
					$query .= "color = '{$new_color}' ";
					$query .= "WHERE id = {$id}";
					$query_result = mysqli_query($connection, $query);
					
					if ($query_result && mysqli_affected_rows($connection) == 1) {
						$value = "Successfully updated color of object {$id} to '{$new_color}'";
					}
					else $value = "error";
				}
				else $value = "error";
			}
			else $value = "error";
		}
		else $value = "error";
		mysqli_close($connection);
		return $value;
	}
	
	if (isset($_POST['submit'])) {
		$result = set_object();
	}
	else {
		$result = get_objects();
	}
	exit(json_encode($result));
?>