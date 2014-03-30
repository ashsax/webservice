<?php

	// process client request (VIA URL)
	
	if (!empty($_GET['name']) {
		//
		$name=$_GET['name'];
		$price=get_price($name);
		
		if (empty($price)) {
			// book not found
		}
		else {
			// respond with book price
		}
	}
	else {
		// throw invalid request
	}
	
	function deliver_response($status,$status_message,$data) {
		header ("HTTP/1.1 $status $status_message");
		
		$response['status'] = $status;
		$response['status_message'] = $status_message;
		$response['data'] = $data;
		
		$json_response=json_encode($response);
		echo $json_response;
	}
?>