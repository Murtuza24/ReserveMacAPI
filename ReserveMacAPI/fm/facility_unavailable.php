<?php
	include '../connection.php';
?>

<?php
	header("Content-Type:application/json");
    if(isset($_GET['facilitycode'], $_GET['avail'])){
        $facility=$_GET['facilitycode'];
        $availability = $_GET['avail'];
        $sql = "update facility set availability=$availability where facilitycode='$facility'";
        $result = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con)==1){
         	$content = "SUCCESS";
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