<?php
	
	$locally = 1;


	if($locally==1)
	{
		$server = "localhost";
		$name = "root";
		$pass = "root";
		$db_name = "producty";
	}
	
	else
	{
		$server = "gbp-db.cc7qtlawsjcp.ap-southeast-1.rds.amazonaws.com";
		$name = "";
		$pass = "";
		$db_name = "";
	}
	
	$conn = mysqli_connect($server,$name,$pass,$db_name);

	if ($conn==null)
	{
		die("Error Occured. Failed to connect to MySQL : " . mysqli_connect_error());
	}
	
?>