<?php

class Blogger
{

	function __construct($conn){
		$this->conn=$conn;
	}
	public function is_login($email,$password)
	{
		
		$query1="SELECT blogger_username,blogger_password from blogger_info where blogger_username='$email' and blogger_password='$password'";
		$result=$this->conn->query($query1);
		if($result->num_rows > 0)
		{
			echo "in login method";
			return true;
		}
		else
		{
			return false;
		}
	}
	public function blogger_logout()
	{
	 	unset($_SESSION['username']);
	 	session_destroy();
	 	header('Location:index.html');
	 	
	 }
	public function is_signup($firstname,$email,$password){

		$date=date("Y-m-d");
		

		$query2="SELECT blogger_username from blogger_info where blogger_username='$email'";
		$result2= $this->conn->query($query2);
		if($result2->num_rows === 0)
		{
			$query1="INSERT INTO blogger_info(blogger_username,blogger_password,blogger_firstname,blogger_creation_date,blogger_is_active) VALUES('$email','$password','$firstname','$date',1)";
		if($this->conn->query($query1))
		{
			return true;
		}
		else
		{
			return "Soory something went wrong";
		}	
	}
	else{
		return "Username already exists";
	}
		
}
}

?>