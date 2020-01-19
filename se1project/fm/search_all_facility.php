<?php
	include '../connection.php';
?>

<?php
    header("Content-Type:application/json");
    if(isset($_GET['name']))//,$_GET['date'],$_GET['time']))
    {
            $name=$_GET['name'];
            // $date=$_GET['date'];
            // $time=$_GET['time'];
            $sql = "SELECT facilitycode,name,type,intervalforfacility, deposit,availability, description     FROM facility where facilitycode like '$name%'";
            $result = mysqli_query($con,$sql);
            if(mysqli_num_rows($result)>0){
                 while($row = mysqli_fetch_array($result)) {
                 $data[] = $row; 
                 }
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