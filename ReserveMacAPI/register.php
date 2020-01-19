
<?php
	include 'connection.php';
?>

<?php
	header("Content-Type:application/x-www-form-urlencoded");
// 	if(isset($_POST['username']))
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		//print_r ($_GET);
		$fname=$_POST['firstname'];
		$lname=$_POST['lastname'];
		$email=$_POST['email'];
		$mobileNumber=$_POST['contactno'];
		$role=$_POST['role'];
		$utaID=$_POST['utaid'];
		$userName=$_POST['username'];
		$password=$_POST['password'];
		$streetAddress=$_POST['streetaddress'];
		$zipcode=$_POST['zipcode'];
		
		
      	$sql = "INSERT INTO `user_login`(`username`, `password`, `firstname`, `lastname`, `utaid`, `role`, `contactno`, `streetaddress`, `zipcode`, `noshow`, `revoked`, `email`) VALUES
        ('$userName','$password', '$fname', '$lname', '$utaID', '$role', '$mobileNumber', '$streetAddress', '$zipcode', 0, 0, '$email')";
    //   	$result = mysqli_query($con,$sql);
		if (mysqli_query($con, $sql)) {
 			//$row = mysqli_fetch_array($result);
 			$content = "TRUE";
 			$response_code = 200;
 			$response_desc = 'Record Inserted';
 			response($content, $response_code,$response_desc);
 			mysqli_close($con);
 		}else{
 			response("FALSE", 400,"Record not updated".mysqli_error($con));
 		}
	}else{
 		response("FALSE", 400,"Invalid Request");
 	}
	
	function response($content, $response_code,$response_desc){
	    $response['content'] = $content;
     	$response['response_code'] = $response_code;
     	$response['response_desc'] = $response_desc;

     	$json_response = json_encode($response);
     	echo $json_response;
    }
	
?>
