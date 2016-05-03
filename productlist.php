<?php

    require 'connect.inc.php';
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    header('Content-Type: application/json');

    $response = array(
                      'Mystatus' => 'No Data Error',
                      'product' => array(),
                      'prodcount' => null
                      );
     $product= array(
                      'id' => null,
                      'name' => null,
                      'volume'=>null,
                      'price' => null
                    );

     $count=0;
     $query = "select * from product;";

		if(($query_run = mysqli_query($conn,$query)))
		{
                  $response['Mystatus']="connected to sql";
                    while($row=mysqli_fetch_assoc($query_run))
                    {
                     $product['id']=$row['pid'];
                     $product['name']=$row['name'];
                     $product['volume']=$row['volume'];
                     $product['price']=$row['price'];
                     $response['product'][$count]=$product;
                     $response['Mystatus']="Success";
                     $count++;
                    }

                    $response['prodcount']=$count;

               }
     echo json_encode($response);


?>