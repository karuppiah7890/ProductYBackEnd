<?php

	require 'connect.inc.php';

	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");

	header('Content-Type: application/json');

	$response = array(
						'Mystatus' => 'No Data Error'
					);

	if(!empty($_GET['mobile']))
	{
		$mobile = mysqli_escape_string($conn,$_GET['mobile']);

		$query = "select phno from login where phno='".$mobile."';";

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