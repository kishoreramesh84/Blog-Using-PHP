<?php 

	include("app/controllers/users.php");
	session_destroy();
	header("location:index.php");
?>