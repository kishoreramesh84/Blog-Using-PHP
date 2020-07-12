<?php
	


	$host='sql210.epizy.com';
    $user='epiz_25964457';
    $pass='xMvWYXFnm9f4';
    $db_name='epiz_25964457_post_dotcom_db';

	$conn = mysqli_connect($host, $user, $pass,$db_name);

	$name='';
	$email='';
	$pass='';
	$repass='';
	$errors=array();

	$sql="select * from users";
	$result=mysqli_query($conn,$sql);
	$to_display=mysqli_fetch_all($result,MYSQLI_ASSOC);


	if(!isset($_SESSION))
	{
		session_start();
	}
	if(isset($_GET['del_id']))
	 {
	 	$key=$_GET['del_id'];
	 	$qu="delete from users where email='$key'";
	 	if(mysqli_query($conn,$qu))
	 	{
	 		header("location:index.php");
	 	}
	 	else
	 	{
	 		echo "check query";
	 	}
	 }
	if(isset($_POST['register-btn']))
	{
		$total="select * from users";
		$result=mysqli_query($conn,$total);
		$rows=mysqli_num_rows($result);
		mysqli_free_result($result);
		$id=$rows+1;
		$name=$_POST['username'];
		$email=$_POST['usermail'];
		$admin=0;

		if(empty($name))
		{
			array_push($errors,"Username is required");
		}
		if(empty($email))
		{
			array_push($errors,"Email is required");
		}
		if(empty($_POST['userpass']))
		{
			array_push($errors,"Password is required");
		}
		if($_POST['userpass'] !== $_POST['userpasscheck'])
		{
			array_push($errors,"Password is not match");
		}
		$get="select * from users where email='$email'";
		$result=mysqli_query($conn,$get);
		$rc=mysqli_num_rows($result);
		mysqli_free_result($result);
		if($rc>0)
		{
			array_push($errors,"Email is already exists");
		}
		if(sizeof($errors) > 0)
		{
			$pass=$_POST['userpass'];
			$repass=$_POST['userpasscheck'];
		}
		else
		{
			$pass=$_POST['userpass'];
			$_POST['userpass']=password_hash($_POST['userpass'], PASSWORD_DEFAULT);
			$pass1=$_POST['userpass'];
			$qu="insert into users(id,admin,username,email,password) values($id,0,'$name','$email','$pass1')";
			if(mysqli_query($conn,$qu))
			{
				$_SESSION['id']=$id;
				$_SESSION['username']=$name;
				$_SESSION['admin']=$admin;
				$_SESSION['message']="You are logged in";
				$_SESSION['type']='success';
				$_SESSION['mail']=$email;
				header("location:index.php");
				exit();
			}
			else 
			{
				echo "check query";
			}
		}
	}



	if(isset($_POST['login-btn']))
	{
		if(empty($_POST['usermail']))
		{
			array_push($errors,"Email is required");
		}
		if(empty($_POST['userpass']))
		{
			array_push($errors,"Password is required");
		}
		$kis=$_POST['usermail'];
		
		$gt="select * from users";
		$rr=mysqli_query($conn,$gt);
		$rows=mysqli_fetch_all($rr,MYSQLI_ASSOC);

		if(sizeof($rows)==0)
		{
			array_push($errors,"Username not Found");
		}
		if(sizeof($errors) > 0)
		{
			$pass=$_POST['userpass'];
		}
		else
		{
			$email=$kis;
			$get="select * from users where email='$kis'";
			$result=mysqli_query($conn,$get);
			$data=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$hash=$data['password'];
			$kispass=$_POST['userpass'];
			$_SESSION['mail']=$kis;
			if(password_verify($kispass,$hash))
			{
				//echo "in";
				$_SESSION['id']=$data['id'];
				$_SESSION['username']=$data['username'];
				$_SESSION['admin']=$data['admin'];
				$_SESSION['mail']=$kis;
				$_SESSION['message']="You are logged in";
				$_SESSION['type']='success';
				header("location:index.php");
				exit();
			}
			else
			{

				array_push($errors, "Wrong Password");
			}
			if(sizeof($errors)>0)
			{
				$pass=$_POST['userpass'];
			}
		}
	}


	if(isset($_POST['create-admin']))
	{
		$sql="select * from users";
		$result=mysqli_query($conn,$sql);
		$tocreate_id=mysqli_fetch_all($result,MYSQLI_ASSOC);
		$id=sizeof($tocreate_id);
		$id += 1;
		$name=$_POST['username'];
		$email=$_POST['usermail'];
		if(empty($name))
		{
			array_push($errors,"Username is required");
		}
		if(empty($email))
		{
			array_push($errors,"Email is required");
		}
		if(empty($_POST['userpass']))
		{
			array_push($errors,"Password is required");
		}
		if($_POST['userpass'] !== $_POST['userpasscheck'])
		{
			array_push($errors,"Password is not match");
		}
		$get="select * from users where email='$email'";
		$result=mysqli_query($conn,$get);
		$rc=mysqli_num_rows($result);
		mysqli_free_result($result);
		if($rc>0)
		{
			array_push($errors,"Email is already exists");
		}
		if(sizeof($errors) > 0)
		{
			$pass=$_POST['userpass'];
			$repass=$_POST['userpasscheck'];
		}
		else
		{
			$_POST['userpass']=password_hash($_POST['userpass'], PASSWORD_DEFAULT);
			$pass=$_POST['userpass'];
			$qu="insert into users(id,admin,username,email,password) values($id,1,'$name','$email','$pass')";
			if(mysqli_query($conn,$qu))
			{
				$_SESSION['id']=$id;
				$_SESSION['username']=$name;
				$_SESSION['admin']=$admin;
				$_SESSION['message']="You are logged in";
				$_SESSION['type']='success';
				header("location:index.php");
				exit();
			}
			else 
			{
				echo "check query";
			}
		}

	}

?>