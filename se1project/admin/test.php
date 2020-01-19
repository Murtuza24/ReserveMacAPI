<?php
	include '../connection.php';
?>

<?php
	header("Content-Type:application/x-www-form-urlencoded");
// 	if(isset($_POST['username']))
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		//print_r ($_GET);
		$password=$_POST['password'];
		$role=$_POST['role'];
		$utaID=$_POST['utaid'];
		//$role=$_POST['role'];
		$fname=$_POST['firstname'];
		$lname=$_POST['lastname'];
		$email=$_POST['email'];
		$mobileNumber=$_POST['contactno'];
 		$userName=$_POST['username'];
		$streetAddress=$_POST['streetaddress'];
		$zipcode=$_POST['zipcode'];
		
		
       	$sql ="UPDATE user_login set  firstname='$fname', lastname='$lname', contactno='$mobileNumber', streetaddress='$streetAddress', role='$role',zipcode='$zipcode', email='$email' where username='$userName'";
       
       	$result = mysqli_query($con,$sql);
		if (mysqli_query($con, $sql)) {
 			//$row = mysqli_fetch_array($result);
 			
 			$sql2 = "SELECT * FROM user_login WHERE username='$userName'";
				//$result = mysql_query($sql);
      	    $result2 = mysqli_query($con,$sql2); 
 			
 			if(mysqli_num_rows($result2)>0){
 			    $row = mysqli_fetch_array($result2);
         	    echo($row);
         	    $content = $row;
 			    $response_code = 200;
 			    $response_desc = 'Record Updated and Returned';
 			    response($content,$response_code,$response_desc);
 			    mysqli_close($con);
 		    }else{
 			    response("FALSE", 400, "Record updated but not returned".mysqli_error($con));
 			    mysqli_close($con);
 		    }
 			
 			
 		}else{
 			response("FALSE", 400,"Record not updated".mysqli_error($con));
 			mysqli_close($con);
 		}
	}else{
 		response("FALSE", 400,"Invalid Request");
 		mysqli_close($con);
 	}
	
	function response($content, $response_code,$response_desc){
	    $response['content'] = $content;
     	$response['response_code'] = $response_code;
     	$response['response_desc'] = $response_desc;

     	$json_response = json_encode($response);
     	echo $json_response;
    }
	
?>