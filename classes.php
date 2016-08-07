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
	 	header('Location:index.php');
	 	
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


	public function get_blogger_id($username)
	{
		$query1="SELECT blogger_id from blogger_info where blogger_username='$username'";
		$result1=$this->conn->query($query1);
		if($result1)
		{
			$row1 = $result1->fetch_assoc();
			$id = (int)$row1["blogger_id"];
			return $id;
		}
		else{
			return false;
		}
	}


	public function publish($username,$title,$category,$desc)
	{
		$id = $this->get_blogger_id($username);
		if ($id == false)
		{
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


	public function get_blog($username)
	{
		$id = $this->get_blogger_id($username);
		if ($id == false)
		{
			return "No blogger id found";
		}
		$query1 = "SELECT blog_id,blog_title,blog_desc,blog_category,creation_date,updated_date from blog_master where blogger_id='$id'";
		$result= $this->conn->query($query1);
		if($result){
			$i=0;
			$blogs = array();
			while ($row = $result->fetch_array(MYSQLI_NUM)) {
				$j=0;
				// 5 for 5 fields id,title,desc,category,date, 
				while ($j < 6){ 
				$blogs[$i][$j]=$row[$j];
				$j=$j+1;
				}
				$i=$i+1;
			}
			return $blogs;

		}
		else{
			return false;
		}

	}
	public function get_blog_update($blog_id)
	{
		$query1= "SELECT blog_id,blogger_id,blog_title,blog_desc,blog_category,blog_author from blog_master";
		$result = $this->conn->query($query1);
		if($result)
		{
			$row = $result->fetch_assoc();
			return $row;
		}
		else{
			return false;
		}
	}
	public function update($blog_id,$title,$category,$desc)
	{
		$date=date("Y-m-d");
		$query1 = "UPDATE blog_master SET blog_title='$title',blog_category='$category',blog_desc='$desc',updated_date = '$date' WHERE blog_id='$blog_id'";
		if($this->conn->query($query1))
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
	 	header('Location:index.php');
	 	
	 }
}
class Viewer{
	function __construct($conn){
		$this->conn=$conn;
	}
	public function get_all_blogs($word_limit,$blog_id)//id for getting whole blog
	{
		if($blog_id === 'all'){
		$query1 ="SELECT blog_id,blogger_id,blog_title,blog_desc,blog_category,blog_author,creation_date,updated_date from blog_master";
		}
		else{
			$query1 = "SELECT blog_id,blogger_id,blog_title,blog_desc,blog_category,blog_author,creation_date,updated_date from blog_master WHERE blog_id = $blog_id"; 
		}
		$result1= $this->conn->query($query1);

		if($result1)
		{
			$i=0;
			$blogs = array();
			while ($row = $result1->fetch_array(MYSQLI_NUM)) {
				$j=0;
				// 6 for 6 fields  
				while ($j < 8){ 
					if($j == 3 && $word_limit != '' && $blog_id != '*')
					{
						$blogs[$i][$j]= $this->limit_words($row[$j],$word_limit); 
					}
					else{
						$blogs[$i][$j]=$row[$j];
					}
				if($j == 1)//for blogger id 
				{
					$query2="SELECT blogger_firstname,blogger_username from blogger_info where blogger_id ='$row[1]'";
					$result2 = $this->conn->query($query2);
					if($result2)
					{
						$row2=$result2->fetch_assoc();
						$blogs[$i][9]=$row2['blogger_username'];
						$blogs[$i][8]=$row2['blogger_firstname'];
					}
				}
				$j=$j+1;
				}

				$i=$i+1;
			}
			return $blogs;
		}
		else
		{
			return false;
		}
	}

	public function get_blogger($username)
	{
		$query1="SELECT blogger_firstname from blogger_info where blogger_username='$username'";
		$result1=$this->conn->query($query1);
		if($result1)
		{
			$row1 = $result1->fetch_assoc();
			$firstname = $row1["blogger_firstname"];
			return $firstname;
		}
		else{
			return false;
		}
	}

	public function profile($username)
	{
		$profile = new Blogger($this->conn);
		$blogs =$profile->get_blog($username);
		if($blogs != false)
		{
			return $blogs;
		}
		else{
			return false;
		}

	}
	public function limit_words($string,$word_limit)
	{
		$words = explode(" ", $string);
		return implode(" ", array_slice($words,0,$word_limit+1));
	}

}

?>