<?php
	include 'connection.php';
?>

<?php
    header("Content-Type:application/json");
    $sql = "SELECT * FROM user_login";
				//$result = mysql_query($sql);
      	$result = mysqli_query($con,$sql);
      	$row = mysqli_fetch_all($result);
     	echo($row);
     	$content = $row;
 		$response_code = 200;
 		$response_desc = 'OK';
 		response($content,$response_code,$response_desc);
 		mysqli_close($con);

   
    	function response( $content, $response_code,$response_desc){
		$response['content'] = $content;
      	$response['response_code'] = $response_code;
     	$response['response_desc'] = $response_desc;
     	

     	$json_response = json_encode($response);
     	echo $json_response;
    }
	
?>