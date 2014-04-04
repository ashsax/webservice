<?php
	// 1. Create database connection
	$dbhost = "localhost";
	$dbuser = "ash";
	$dbpass = "secret";
	$dbname = "objects";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	// Test if connection works
	if (mysqli_connect_errno()) {
		die ("Database connection failed. " . 
			mysqli_connect_error() . " (" . mysqli_connect_errorno() . ")");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
	<head>
		<title>Objects</title>
	</head>
	<body style="font-family:Futura; font-size:14px">
		<p>To change the color of an object,</p><p>enter its ID and the new color below</p>
		<form action="index.php" method="post">
			id: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="id" value="" /><br/>
			new color: <input type="text" name="new_color" value=""/><br/>
			<input type="submit" name="submit" value="update" />
		</form>
		<?php
/* 		print_r($_POST); */
		?>
		<?php
		// detect form submission
		if (isset($_POST['submit'])) {
/* 			echo "form was submitted"; */
			if (isset($_POST["id"])) {
				$id = $_POST["id"];
			}
			else $id = "";
			if (isset($_POST["new_color"])) {
				$new_color = $_POST["new_color"];
			}
			else $new_color = "";
/* 			echo $id . " " . $new_color; */
			$query  = "UPDATE objs SET ";
			$query .= "color = '{$new_color}' ";
			$query .= "WHERE id = {$id}";
			$result = mysqli_query($connection, $query);
			
			if ($result && mysqli_affected_rows($connection) == 1) {
				echo "Successfully updated object {$id}" . "'s color to '{$new_color}'";
			}
			else {
				echo "Database query failed. <br>User may not have changed object's color to a different color. <br>";
				echo mysqli_error($connection);
			}
		}
		
		// 2. Perform database query
		$query  = "SELECT * FROM objs";
		$result = mysqli_query($connection, $query);
		if (!$result) {
			die("Database query failed.");
		}
		
		// 3. Use returned data (if any)
		$objects = array();
		while ($object = mysqli_fetch_assoc($result)) {
			$objects[] = $object;
		}
/* 		var_dump($objects); */
		?>
		<h1 style="color:red">
			red objects
			<p></p>
		</h1>
		<?php
		foreach($objects as $obj) {
			if ($obj['color'] == "red") {
				?>
				<p style="color:red"> <?php echo "id: " . $obj['id']; ?> </p>
				<div style="width:100px; height:100px; background-color:red"></div>
				<?php
			}
		}
		?>
		<h1 style="color:blue">
			blue objects
			<p></p>
		</h1>
		<?php
		foreach($objects as $obj) {
			if ($obj['color'] == "blue") {
				?>
				<p style="color:red"> <?php echo "id: " . $obj['id']; ?> </p>
				<div style="width:100px; height:100px; background-color:blue"></div>
				<?php
			}
		}
		?>
		<h1 style="color:green">
			green objects
			<p></p>
		</h1>
		<?php
		foreach($objects as $obj) {
			if ($obj['color'] == "green") {
				?>
				<p style="color:red"> <?php echo "id: " . $obj['id']; ?> </p>
				<div style="width:100px; height:100px; background-color:green"></div>
				<?php
			}
		}
		mysqli_free_result($result);
		?>
	</body>
</html>

<?php
	// 5. Close database connection
	mysqli_close($connection);
?>
