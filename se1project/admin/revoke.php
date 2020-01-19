<?php
	include '../connection.php';
?>

<?php
	header("Content-Type:application/json");
    if(isset($_GET['username'],$_GET['role'])){
        $username=$_GET['username'];
        $role=$_GET['role'];
        $sql = "update user_login set role=$role where username='$username'";
        $result = mysqli_query($con,$sql);
		if(mysqli_query($conn, $sql)){
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