<?php 
	include("connect.php");
	// echo "db.php da   ";
	function selectAll($table)
	{
		global $conn;
		$sql = " select * from $table";
			$result=mysqli_query($conn,$sql);
			$show=mysqli_fetch_all($result,MYSQLI_ASSOC);
			return $show;
	}
	function searchPosts($term)
	{
		global $conn;
		$match='%'.$term.'%';
		$sql="select p.*,u.username from posts as p join users as u on p.email=u.email and 
		p.title like '$match'";
		$result=mysqli_query($conn,$sql);
		$show=mysqli_fetch_all($result,MYSQLI_ASSOC);
		return $show;
	}
	function getPostByTopic($name)
	{
		global $conn;
		$rr=mysqli_query($conn,"select p.*,u.username from posts as p join users as u on p.email=u.email where name='$name'");
		$sh=mysqli_fetch_all($rr,MYSQLI_ASSOC);
		return $sh;
	}
?>