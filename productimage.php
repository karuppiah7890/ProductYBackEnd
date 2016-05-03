<?php

require 'connect.inc.php';
header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");

header('Content-Type: image/jpeg');

	if(!empty($_GET['id']))
	{
		$path = '/home/ubuntu/uploads/productimages/'.$_GET['id'].'.jpg';

		readfile($path);

	}


?>