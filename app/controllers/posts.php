<?php 
	include("../database/connect.php");
	include("users.php");
	global $conn;
	
	$sql="select * from topics";
	$result=mysqli_query($conn,$sql);
	$get_topics=mysqli_fetch_all($result,MYSQLI_ASSOC);

	$sql="select * from posts";
	$result=mysqli_query($conn,$sql);
	$get_posts=mysqli_fetch_all($result,MYSQLI_ASSOC);


	$errorspo=array();
	$put='';
	$show_title='';
	$show_body='';
	$show_image='';
	$show_topic_id='';
	$original_id='';
	if(isset($_GET['id']))
	{
		$id_op=$_GET['id'];
		$selectone=mysqli_query($conn,"select * from posts where title='$id_op'");
		$one_row=mysqli_fetch_assoc($selectone);	
		$show_title=$one_row['title'];
		$show_body=$one_row['body'];
		$show_image=$one_row['image'];
		$show_topic_id=$one_row['name'];
		$original_id=$one_row['id'];
	}
	if(isset($_POST['add-post']))
	{
		$sql="select * from posts";
		$result=mysqli_query($conn,$sql);
		$get_post=mysqli_fetch_all($result,MYSQLI_ASSOC);
		$id=sizeof($get_post)+1;
		$title=$_POST['title'];
		$body=htmlentities($_POST['body']);
		if(empty($_FILES['image']['name']))
		{
			array_push($errorspo, "Post image is required");
		}
		else
		{
			$imgname= $_FILES['image']['name'];
			$dest="assets/images/".basename($imgname);
            $extension = substr($imgname,strlen($imgname)-4,strlen($imgname));
            // allowed extensions
            $allowed_extensions = array(".jpg","jpeg",".png",".gif");
            // Validation for allowed extensions .in_array() function searches an array for a specific value.
            if(in_array($extension,$allowed_extensions))
            {
                $checkresult=move_uploaded_file($_FILES['image']['tmp_name'], $dest);
                if($checkresult)
                {
                    $_POST['image']=$imgname;
                }
                else
                {
                    array_push($errorspo,"Failed to upload");
                }
            }
            else
            {
                array_push($errorspo,"Upload only image file");
            }
		}
		//$img=$_POST['image'];
		if(empty($title))
		{
			array_push($errorspo,"Title is required");
		}
		// if(empty($img))
		// {
		// 	array_push($errors, "Any image is required");
		// }
		if(empty($body))
		{
			array_push($errorspo, "Body should not be empty");
		}
		$check=mysqli_query($conn,"select * from posts where title='$title'");
		$rc=mysqli_num_rows($check);
		if($rc>0)
		{
			array_push($errorspo,"Please give different title");
		}
		if(empty($_POST['topic_id']))
		{
			array_push($errorspo,"choose topic");
		}
		if(sizeof($errorspo)==0)
		{
			$to_pub=1;
			$nm=$_POST['topic_id'];
			$img=$_POST['image'];
			$ma='';
			if(isset($_SESSION))
			{
				$gh=$_SESSION['username'];
				$qu=mysqli_query($conn,"select email from users where username='$gh'");
				$dt=mysqli_fetch_assoc($qu);
				$ma=$dt['email'];
			}
			
			$qu="insert into posts(id,email,name,title,image,body,published,created_at) values($id,'$ma','$nm','$title','$img','$body',$to_pub,NOW())";
			if(mysqli_query($conn,$qu))
			{
				header("location:index.php");
			}
			else
			{
				echo "check query";
			}
		}
		
	}

	// if(isset($_POST['update-btn']))
	// {
	// 	$title=$_POST['title'];
	// 	$body=htmlentities($_POST['body']);
	// 	if(empty($_FILES['image']['name']))
	// 	{
	// 		array_push($errorspo, "Post image is required");
	// 	}
	// 	else
	// 	{
	// 		$imgname= time().'_'.$_FILES['image']['name'];
	// 		$dest='../../assets/images/'.$imgname;
	// 		$checkresult=move_uploaded_file($_FILES['image']['tmp_name'], $dest);
	// 		if($checkresult)
	// 		{
	// 			$_POST['image']=$imgname;
	// 		}
	// 		else
	// 		{
	// 			array_push($errorspo,"Failed to upload");
	// 		}
	// 	}
	// 	$img=$_POST['image'];
	// 	if(empty($title))
	// 	{
	// 		array_push($errorspo,"Title is required");
	// 	}
	// 	if(empty($img))
	// 	{
	// 		array_push($errorspo, "Any image is required");
	// 	}
	// 	if(empty($body))
	// 	{
	// 		array_push($errorspo, "Body should not be empty");
	// 	}
	// 	if(empty($_POST['topic_id']))
	// 	{
	// 		array_push($errorspo,"choose topic");
	// 	}
	// 	if(sizeof($errorspo)==0)
	// 	{
	// 		$got=$_POST['id'];
	// 		$to_pub=1
	// 		$nm=$_POST['topic_id'];
	// 		$qu="update posts set title='$title',name='$nm',image='$img',body='$body' where id=$got";
	// 		if(mysqli_query($conn,$qu))
	// 		{
	// 			header("location:index.php");
	// 		}
	// 		else
	// 		{
	// 			echo "check query";
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$put=$_POST['body'];
	// 	}
	// }
	if(isset($_GET['del_id']))
	{
		$key=$_GET['del_id'];
	 	$qu="delete from posts where id=$key";
	 	if(mysqli_query($conn,$qu))
	 	{
	 		header("location:index.php");
	 	}
	 	else
	 	{
	 		echo "check query";
	 	}
	}
?>
