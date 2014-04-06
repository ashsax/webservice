<html lang="en">
	<head>
		<title>Objects</title>
	</head>
	<body style="font-family:Futura; font-size:14px">
		<p>To change the color of an object,</p><p>enter its ID and the new color below.</p>
		<form action="index.php" method="post">
			id: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="id" value="" /><br/>
			new color: <input type="text" name="new_color" value=""/><br/>
			<input type="submit" name="submit" value="update" />
		</form>
		
		<?php
			if (isset($_POST['submit'])) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'http://localhost/~ash/webservice/api.php');
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$post_status = curl_exec($ch);
				curl_close($ch);
				$post_status = json_decode($post_status, true);
				echo $post_status . "<br>";
/* 				echo var_export($post_status, TRUE) . "<br>"; */
			}
			$objects = file_get_contents('http://localhost/~ash/webservice/api.php');
			$objects = json_decode($objects, true);
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
		?>
	</body>
</html>