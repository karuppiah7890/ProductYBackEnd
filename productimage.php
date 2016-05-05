<?php

	require 'connect.inc.php';
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');
	header("Access-Control-Allow-Headers: X-Requested-With");

	header('Content-Type: image/jpeg');

	$location = 2;		// 1 - Bharath computer; 2 - Karups computer; 3 - server

	if(!empty($_GET['id']))
	{
		if($location==1)
			$path = "";

		else if($location==2)
			$path = '/home/karuppiah/productyuploads/productimages/'.$_GET['id'].'.jpg';

		else if($location==3)
			$path = '/home/ubuntu/uploads/productimages/'.$_GET['id'].'.jpg';

		readfile($path);
	}


?>