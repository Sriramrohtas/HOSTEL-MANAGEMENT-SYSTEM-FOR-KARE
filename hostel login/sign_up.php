<?php
    // session_start();
	$Register_number = $_POST['Register_number'];
	$Password = $_POST['Password'];
	if(isset($user_type)){$user_type = $_POST['user_type'];}
	 
	// Database connection
	$conn = new mysqli('localhost','root','','login');
	if($conn->connect_error)
	{
		die("Connection Failed : ". $conn->connect_error);
	} else 
	{
		$stmt = $conn->prepare("select * from student where Register_number = ?");
		$stmt->bind_param("s", $Register_number);
		$stmt->execute();
		$stmt_result = $stmt->get_result();
		if($stmt_result->num_rows > 0) 
	{
			$data = $stmt_result->fetch_assoc();
			if($data['user_type'] == 'admin')
		{
 				
			if($data['Password'] === $Password)
			{
				include("Admin_dashboard\adim_dash.html");
			}
				 
		}
		   elseif($data['user_type'] == 'user')
		{
			if($data['Password'] === $Password)
			{    
				include("user_dashboard\student_dash.html");
			}
		} 
		else
		{
			echo "Invalid Register number or password";
		}
		
	}
	    
			  
	}
	 

 
		
?>