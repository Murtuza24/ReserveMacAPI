<?php
	include '../connection.php';
?>

<?php
	header("Content-Type:application/json");
    if(isset($_GET['username'],$_GET['noshow'])){
        $username=$_GET['username'];
        $noshow=$_GET['noshow'];
        $sql = "update user_login set noshow=$noshow where username='$username'";
        $result = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con)==1){
 			$response_code = 200;
 			$response_desc = 'OK';
 			response($response_code,$response_desc);
 			mysqli_close($con);
 		}else{
 			response(200,"Failed");
 		}
	}else{
 		response(400,"Invalid Request");
 	}
	
	function response($response_code,$response_desc){
      	$response['response_code'] = $response_code;
     	$response['response_desc'] = $response_desc;
     	

     	$json_response = json_encode($response);
     	echo $json_response;
    }
	
?>
