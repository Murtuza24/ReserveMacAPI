<?php
	include 'connection.php';
?>

<?php
	header("Content-Type:application/json");
    if(isset($_GET['username'] , $_GET['password']))
	{
		$username=$_GET['username'];
		
      	$password=$_GET['password'];
		
		$sql = "SELECT * FROM user_login WHERE username='$username' AND password='$password'";
				//$result = mysql_query($sql);
      	$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0){
 			$row = mysqli_fetch_array($result);
         	echo($row);
         	$content = $row;
 			$response_code = 200;
 			$response_desc = 'OK';
 			response($content,$response_code,$response_desc);
 			mysqli_close($con);
 		}else{
 			//response(NULL, 200,"No Record Found");
 		}
	}else{
 		response(NULL, 400,"Invalid Request");
 	}
	
	function response( $content, $response_code,$response_desc){
		$response['content'] = $content;
      	$response['response_code'] = $response_code;
     	$response['response_desc'] = $response_desc;
     	

     	$json_response = json_encode($response);
     	echo $json_response;
    }
	
?>
