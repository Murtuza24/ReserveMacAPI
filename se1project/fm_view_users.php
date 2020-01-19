<?php
	include 'connection.php';
?>

<?php
	header("Content-Type:application/json");
    $sql = "SELECT * from user_login";
    $result = mysqli_query($con,$sql);
         if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_all($result);
                echo($row);
                $content = $row;
 	               $response_code = 200;
 	               $response_desc = 'OK';
 	               response($content,$response_code,$response_desc);
 	               mysqli_close($con);
             } else{
 	                response(NULL, 200,"No Record Found");
            }
    
	
	function response($response_code,$response_desc){
      	$response['response_code'] = $response_code;
     	$response['response_desc'] = $response_desc;
     	

     	$json_response = json_encode($response);
     	echo $json_response;
    }
	
?>
