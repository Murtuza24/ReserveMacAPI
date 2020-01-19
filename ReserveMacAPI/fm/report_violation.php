<?php
	include '../connection.php';
?>

<?php
    header("Content-Type:application/json");
    if(isset($_GET['reservationid'],$_GET['viodetails'])){
        $reservationid=$_GET['reservationid'];
        $viodetails=$_GET['viodetails'];
        $sql = "UPDATE reservations SET viodetails='$viodetails' WHERE reservationid='$reservationid'";
        mysqli_query($con,$sql);
        if(mysqli_affected_rows($con)>0){
            $response_code = 200;
            $response_desc = 'OK';
            response("TRUE",$response_code,$response_desc);
            mysqli_close($con);
         } else{
             response("FALSE", 200,"Record Not Updated");
        }
    }else{
 		response("FALSE", 400,"Invalid Request");
 	}
    
   
    function response( $content, $response_code,$response_desc){
		$response['content'] = $content;
      	$response['response_code'] = $response_code;
     	$response['response_desc'] = $response_desc;
     	

     	$json_response = json_encode($response);
     	echo $json_response;
    }
	
?>