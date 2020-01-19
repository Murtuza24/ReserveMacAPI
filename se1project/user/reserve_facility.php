
<?php
	include '../connection.php';
?>

<?php
	header("Content-Type:application/json");
    if(isset($_GET['facilitycode'],$_GET['date'],$_GET['start'],$_GET['end'],$_GET['user'],$_GET['facilitytype'])){
        $facilityCode=$_GET['facilitycode'];
        $date = $_GET['date'];
        $start = $_GET['start'];
        $end = $_GET['end'];
        $userName = $_GET['user'];
        $facilityType = $_GET['facilitytype'];
        $allow = false;
        
        $sql = "select noshow as CNT from user_login where username='$userName'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row["CNT"]>=3){
            response(NULL, 200,"No Show");
            return;
        }
        if (strcmp($facilityType,'Indoor')==0){
            $sql = "select count(*) as CNT from reservations r INNER JOIN facility f ON f.facilitycode=r.facilitycode where r.username='$userName' and r.resstatus=1 and f.type='$facilityType'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            if($row["CNT"]<2 and strtotime($start)<strtotime($end)){
                $allow=true;
            }
        }
        else{
            $sql = "select count(*) as CNT from reservations r where r.username='$userName' and r.resstatus=1";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            if($row["CNT"]<4 and strtotime($start)<strtotime($end)){
                $allow=true;
            }            
        }
        if ($allow==true){
            $sql = "INSERT INTO reservations(start,end,violation,viodetails,resstatus,username,facilitycode) value(CAST('$date $start' as datetime),CAST('$date $end' as datetime),0,'',1,'$userName','$facilityCode')";
            $result = mysqli_query($con,$sql);
            $content = NULL;
     		$response_code = 200;
     		$response_desc = 'OK';
     		response($content,$response_code,$response_desc);
     		mysqli_close($con);
        }
 		else{
 		response(NULL, 200,"Unable to Make Reservation");
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
