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

		$names = array('id');

		$post = json_decode(file_get_contents("php://input"),true);

        
		foreach ($names as $key => $value) {
			if(empty($post[$value]))
				return 1;
		}

		return 0;
	}

		$response = array(
						'Mystatus' => 'No Data Error',
						'id' => null,
						'FirstName'=> null,
						'LastName'=> null,
						'phno'=> null,
						'email'=> null
						);
		
         if(!isEmpty())
		{
         	
         	$response['Mystatus'] = "Data Not Empty";

			$id = mysqli_escape_string($conn,$_GET['id']);
			
            
			$loginQuery = "select phno from login where id='".$id."';";

			if(($query_run = mysqli_query($conn,$loginQuery)))
			{
				if(mysqli_num_rows($query_run)==1)
				{
					$row = mysqli_fetch_assoc($query_run);
					$response['id'] = $id;
					$response['phno'] = $row['phno'];
					$response['Mystatus'] = "Successlogin";
                    $loginQuery = "select firstname,lastname,email from customer where id='".$id."';";
                    if(($query_run = mysqli_query($conn,$loginQuery)))
                   	{
						if(mysqli_num_rows($query_run)==1)
						{
							$row = mysqli_fetch_assoc($query_run);
                         	$response['FirstName'] = $row['firstname'];
                         	$response['LastName'] = $row['lastname'];
                         	$response['email'] = $row['email'];
                         	$response['Mystatus'] = "success";
						}                   		
                   	}					
				}

				else
				$response['Mystatus'] = "Wrong id";
			}
		}

		echo json_encode($response);
?>