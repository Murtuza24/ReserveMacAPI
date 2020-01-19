<?php
	include '../connection.php';
?>

<?php
	header("Content-Type:application/json");
    if(isset($_GET['facilitycode'],$_GET['date'],$_GET['time'])){
        $name=$_GET['facilitycode'];
        $date = $_GET['date'];
        $time = $_GET['time'];
        $sql = "select facilitycode,name,description,deposit, CAST('$time' as time) as start,DATE_ADD(CAST('$time' as time),INTERVAL intervalforfacility*60 MINUTE) as end,'$date' as date,type from facility WHERE availability=1 and facilitycode LIKE '$name%' and  facilitycode not in (select r.facilitycode from reservations r INNER JOIN facility f ON r.facilitycode=f.facilitycode where r.resstatus=1 and r.facilitycode LIKE '$name%' AND ((CAST('$date $time' as datetime) BETWEEN r.start and r.end) OR (DATE_ADD(CAST('$date $time' as datetime),INTERVAL f.intervalforfacility*60 MINUTE) BETWEEN r.start and r.end)))";
        $result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0){
		    //$row = mysqli_fetch_array($result);
         	 while($row = mysqli_fetch_array($result)) {
                 // store data in an array
                $data[] = $row; 
                }  
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
