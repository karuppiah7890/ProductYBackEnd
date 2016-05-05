<?php

	require 'connect.inc.php';

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');
	header("Access-Control-Allow-Headers: X-Requested-With");

	header('Content-Type: application/json');

	$post = null;

	function isEmpty()
	{
		global $post;
		
		$names = array('mobile','password');

		$post = json_decode(file_get_contents("php://input"),true);

		foreach ($names as $key => $value) {
			if(empty($post[$value]))
				return 1;
		}

		return 0;
	}

	$response = array(
						'Mystatus' => 'No Data Error',
						'id' => null
					);

	if(!isEmpty())
	{
		$response['Mystatus'] = "Data Not Empty";

		$mobile = mysqli_escape_string($conn,$post['mobile']);
		$password = mysqli_escape_string($conn,$post['password']);

		$loginQuery = "select id from login where phno='".$mobile."' and password='".$password."';";

		if(($query_run = mysqli_query($conn,$loginQuery)))
		{
			if(mysqli_num_rows($query_run)==1)
			{
				$row = mysqli_fetch_assoc($query_run);
				$response['id'] = $row['id'];
				$response['Mystatus'] = "Success";
			}

			else
			$response['Mystatus'] = "Wrong Mobile Number / Password";
		}

		else
		$response['Mystatus'] = "Query Run Error";

	}

	echo json_encode($response);

?>