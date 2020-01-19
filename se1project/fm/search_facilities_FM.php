<?php
	include '../connection.php';
?>

<?php
    header("Content-Type:application/json");
    if(isset($_GET['facilitycode'],$_GET['date'],$_GET['time']))
    {
        $facilitycode=$_GET['facilitycode'];
        $date=$_GET['date'];
        $time=$_GET['time'];
        $sql = "select facilitycode as FacilityName,type as Type,CONCAT(intervalforfacility,' hour') as Duration ,CONCAT('$',deposit) as Deposit from facility where availability=1 and facilitycode like '$facilitycode%' and facilitycode not in (select DISTINCT(r.facilitycode) from reservations r where r.resstatus=1 and r.start >=  CAST('$date $time' as datetime) and r.facilitycode LIKE '$facilitycode%')";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result)>0){
              while($row = mysqli_fetch_array($result)) {
                  $data[] = $row; 
                  }
        $row = mysqli_fetch_all($result);
        $content = $data;
        $response_code = 200;
        $response_desc = 'OK';
        response($content,$response_code,$response_desc);
        mysqli_close($con);
        } else{
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