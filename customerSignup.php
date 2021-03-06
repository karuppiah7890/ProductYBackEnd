<?php

	require 'connect.inc.php';

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');
	header("Access-Control-Allow-Headers: X-Requested-With");

	header('Content-Type: application/json');

	function isZeroRows($conn,$query)
	{
		if(($query_run = mysqli_query($conn,$query)))
		{
			if(mysqli_num_rows($query_run)==0)
			return 1;
			
			else
			return 0;
		}
		else
		return -1;
	}

	$post = null;

	function isEmpty()
	{
		global $post;
		
		$names = array('firstname','lastname','email','mobile','password','repassword');

		$post = json_decode(file_get_contents("php://input"),true);

		foreach ($names as $key => $value) {
			if(empty($post[$value]))
				return 1;
		}

		return 0;
	}

	$response = array(
						'Mystatus' => 'No Data Error'
					);

	if(!isEmpty())
	{
		$response['Mystatus'] = "Data Not Empty";

		$firstname = mysqli_escape_string($conn,$post['firstname']);
		$lastname = mysqli_escape_string($conn,$post['lastname']);
		$email = mysqli_escape_string($conn,$post['email']);
		$mobile = mysqli_escape_string($conn,$post['mobile']);
		$password = mysqli_escape_string($conn,$post['password']);
		$repassword = mysqli_escape_string($conn,$post['repassword']);

		if($password!=$repassword)
		{
			$response['Mystatus'] = "Passwords don't match";
			echo json_encode($response);
			die();
		}

		$emailQuery = "select email from customer where email='".$email."';";
		$mobileQuery = "select phno from login where phno='".$mobile."';";

		$result1 = isZeroRows($conn,$emailQuery);
		$result2 = isZeroRows($conn,$mobileQuery);

		if($result1==1 && $result2==1)
		{

			$loginInsertQuery = 
			"insert into login values(null,'$mobile','$password','customer');";

			if(($query_run = mysqli_query($conn,$loginInsertQuery)))
			{
				$response['Mystatus'] = "Inserted into login";

				$loginId = mysqli_insert_id($conn);

				$customerInsertQuery = "insert into customer values($loginId,'$firstname','$lastname','$email','false');";

				if(($query_run = mysqli_query($conn,$customerInsertQuery)))
				$response['Mystatus'] = "Success";

				else
				$response['Mystatus'] = "Login insert done. Error while inserting into customer";		
				
			}

			else
			$response['Mystatus'] = "Error while inserting into login";
		}

		else if($result1==-1 || $result2 ==-1)
		$response['Mystatus'] = "Email/Mobile Available Query Run Error";

		else
		$response['Mystatus'] = "Already Registered";
		

	}

	echo json_encode($response);

?>