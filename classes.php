<?php

class Blogger
{

// private $connnect; private $servername ,

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
			$query1="INSERT INTO blogger_info(blogger_username,blogger_password,blogger_firstname,blogger_creation_date,blogger_is_active) VALUES('$email','$password','$firstname','$date',0)";
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
	public function is_permitted($username){
		$query1="SELECT blogger_is_active from blogger_info where blogger_username='$username'";
		$result1=$this->conn->query($query1);
		if($result1)
		{
			$row=$result1->fetch_assoc();
			return $row["blogger_is_active"];
		}
		else{
			return false;
		}
	}
	public function publish($username,$title,$category,$desc)
	{
		$query1="SELECT blogger_id from blogger_info where blogger_username='$username'";
		$result1=$this->conn->query($query1);
		if($result1)
		{
			$row1 = $result1->fetch_assoc();
			$id = (int)$row1["blogger_id"];
		}
		else{
			return "No blogger id found";
		}
		$date=date("Y-m-d");
		$query2= "INSERT INTO blog_master(blogger_id,blog_title,blog_desc,blog_category,blog_author,blog_is_active,creation_Date) VALUES($id,'$title','$desc','$category','$username',1,'$date')";
		if($this->conn->query($query2))
		{
			return true;
		}
		else{
			return false;
		}
	}
}
class Admin{
	function __construct($conn){
		$this->conn=$conn;
	}
	public function is_login($username,$password){
			if($username === "admin" && $password === "vatsal")
			{
				return true;
			}
			else{
				return false;
			}
	}
	public function get_bloggers(){
		$query1="SELECT blogger_firstname,blogger_username,blogger_is_active from blogger_info";
		$result=$this->conn->query($query1);
		if($result)
		{
			// $bloggers = $this->conn->fetch_all($result,MYSQL_ASSOC);
			// return $bloggers;
			$i=0;
			$bloggers = array();
			while ($row = $result->fetch_array(MYSQLI_NUM)) {
				$j=0;
				// 3 for 3 fields username,firstname,is_active 
				while ($j < 3){ 
				$bloggers[$i][$j]=$row[$j];
				$j=$j+1;
				}
				$i=$i+1;
			}
			return $bloggers;

		}
		else
		{
			return false;
		}

	}
	public function permission($username,$active){
		$query1 = "SELECT blogger_is_active from blogger_info where blogger_username='$username'";
		$result = $this->conn->query($query1);
		if($result){
			$query2= "UPDATE blogger_info SET blogger_is_active='$active' where blogger_username='$username'";
			if($result2=$this->conn->query($query2))
			{
				return true;
			}
			else{
				return false;
			}

		}
		else{
				return "Something went wrong";
			}	
	}
	public function admin_logout()
	{
	 	unset($_SESSION['admin']);
	 	session_destroy();
	 	header('Location:index.html');
	 	
	 }
}

?>