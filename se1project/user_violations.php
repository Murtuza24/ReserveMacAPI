<?php
	include 'connection.php';
?>

<?php
	header("Content-Type:application/json");
    if(isset($_GET['username'])){
        $username=$_GET['username'];
        $sql = "SELECT username,violation,viodetails,facilitycode 
                from `reservations` 
                where username='$username' and violation=1";
        $result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0){
		    while($row = mysqli_fetch_array($result)) {
                  $data[] = $row; 
                  }
 			$row = mysqli_fetch_all($result);
 			echo($row);
         	$content = $data;
 			$response_code = 200;
 			$response_desc = 'OK';
 			response($content,$response_code,$response_desc);
 			mysqli_close($con);
 		}else{
 			response(NULL, 200,"No Record Found");
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
