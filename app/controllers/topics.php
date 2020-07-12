<?php 

include '../database/connect.php';
// $show=array();
global $conn;
 $name='';
 $description='';
//  $all=mysqli_query($conn,"select * from topics");
//  while($row=mysqli_fetch_assoc($all))
//  {
//  	array_push($show, $row);
//  }
 if(isset($_POST['add-btn']))
 {
 	$title=$_POST['title'];
 	$des=$_POST['description'];
 	$sql="INSERT INTO TOPICS (name,description) VALUES('$title','$des')";
 	if(mysqli_query($conn,$sql))
 	{
 			header("location:index.php");
 	}
 	else 
 	{
 		echo "check query";
 	}
 }
 if(isset($_GET['id']))
 {
 	$name=$_GET['id'];
 }
 if(isset($_GET['del_id']))
 {
 	$key=$_GET['del_id'];
 	$qu="delete from topics where name='$key'";
 	if(mysqli_query($conn,$qu))
 	{
 		header("location:index.php");
 	}
 	else
 	{
 		echo "check query";
 	}
 }
 if(isset($_POST['update-btn']))
 {
 	$title=$_POST['title'];
 	$des=$_POST['description'];
 	$qu="update topics set description='$des' where name='$title'";
 	if(mysqli_query($conn,$qu))
 	{
 		header("location:index.php");
 	}
 	else
 	{
 		
 		echo "check query";
 	}
 }