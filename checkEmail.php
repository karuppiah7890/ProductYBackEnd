<?php

	require 'connect.inc.php';

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');
	header("Access-Control-Allow-Headers: X-Requested-With");

	header('Content-Type: application/json');

	$response = array(
						'Mystatus' => 'No Data Error'
					);

	if(!empty($_GET['email']))
	{
		$email = mysqli_escape_string($conn,$_GET['email']);

		$query = "select email from customer where email='".$email."';";

		if(($query_run = mysqli_query($conn,$query)))
		{
			if(mysqli_num_rows($query_run)==0)
			$response['Mystatus'] = 'Success';
			
			else
			$response['Mystatus'] = 'Unavailable';	
		}
		else
		{
			$response['Mystatus'] = 'Query Run Error';
		}	

	}

	echo json_encode($response);

?>