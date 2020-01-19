<?php
	include '../connection.php';
?>
<?php
	header("Content-Type:application/json");
    if(isset($_GET['facilitycode'],$_GET['date'],$_GET['start'],$_GET['reservationid'])){
        $facilitycode=$_GET['facilitycode'];
        $date = $_GET['date'];
        $start = $_GET['start'];
        $sql = "select DATE_ADD(CAST('$start' as time),INTERVAL intervalforfacility*60 MINUTE) as end from facility where facilitycode='$facilitycode'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        $end = $row['end'];
        
        $reservationid = $_GET['reservationid'];
        $sql = "UPDATE reservations set start=CAST('$date $start' as datetime),end=CAST('$date $end' as datetime),facilitycode='$facilitycode' where reservationid=$reservationid";
        $result = mysqli_query($con,$sql);
        $content = $result;
 		$response_code = 200;
 		$response_desc = 'OK';
 		response($content,$response_code,$response_desc);
 		mysqli_close($con);
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
