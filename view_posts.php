<?php include("app/controllers/users.php") ?>
<?php include("app/controllers/topics.php") ?>
<?php include("app/controllers/posts.php") ?>
<?php include 'app/database/connect.php' ?>
<?php include 'app/database/db.php' ?>
<?php 
	global $conn;
	$em=$_SESSION['mail'];
    // print_r($em);
	$sql="select * from posts where email='$em'";
	$result=mysqli_query($conn,$sql);
	$get_post=mysqli_fetch_all($result,MYSQLI_ASSOC);
	// print_r($get_post);
	// die();
    $var=sizeof($get_post);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>
</head>
<style>
#head1{
    text-align:center;
}
</style>
<body>
    <?php include("app/includes/header.php"); ?>
	<div class="ui container">
    <div class="header"><h1 id="head1">Your Posts</h1></div>
    <?php if($var==0):?>
    <h3>No Posts Found</h3>
    <?php else:?>
	<table class="ui large table">
	  <thead>
	    <tr>
	      <th>S.No</th>
	      <th>E-mail address</th>
	      <th>Title</th>
          <th colspan="2">Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($get_post as $key => $pos): ?>
	    <tr>
	      <td><?php echo $key+1 ?></td>
	      <td><?php echo $pos['email'] ?></td>
	      <td><?php echo $pos['title'] ?></td>
          <td><a href="post.php?id=<?php echo $pos['id'];?>">View</a></td>
          <td><a href="newheader.php?del_id=<?php echo $pos['id']?>"><span class="text-danger">Delete</span></a></td>
	    </tr>
	    <?php endforeach; ?>
	  </tbody>
	</table>
    <?php endif;?>
	</div>
</body>
<?php include('footer.php');?>
</html>